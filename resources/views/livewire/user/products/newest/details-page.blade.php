<div>
    <link rel="stylesheet" href={{ asset('assets/css/products/newest-details.css') }}>
    @if (!$product->deleted_at && !$product->special && !$product->has_offer && $product->is_newest)
        <div class="container py-5" style="scroll-margin-top: 80px;">

            <!-- فتات الخبز -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('user.home') }}> الرئيسية </a></li>&nbsp;/&nbsp;
                    <li class="breadcrumb-item"><a
                            href={{ route('user.ViewProducts', [
                                'CatigoryName' => 'all',
                                'BrandName' => 'all',
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 1,
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                            class="text-success">وصل حديثاً </a></li>&nbsp;
                    <li class="breadcrumb-item" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
            <div class="row g-5">

                <!-- القسم الأيمن: معرض الصور -->
                <div class="col-lg-6">
                    <div class="main-image-container">
                        <div class="new-badge"><i class="bi bi-lightning-fill"></i> وصل حديثاً</div>
                        @if ($product->imgs->isNotEmpty())
                            <img src={{ asset('products/imgs/' . $product->imgs[0]->path) }} id="mainProductImage"
                                class="main-image" alt="صورة المنتج">
                        @endif
                    </div>
                    <!-- الصور المصغرة -->
                    <div class="thumbnail-list">
                        @foreach ($product->imgs as $img)
                            <img src={{ asset('products/imgs/' . $img->path) }} class="thumbnail"
                                onclick="changeImage(this)" alt="صورة ">
                        @endforeach
                    </div>
                </div>

                <!-- القسم الأيسر: المعلومات -->
                <div class="col-lg-6">
                    <h1 class="fw-bold mb-3 display-6 text-dark">{{ $product->name }}</h1>
                    <div class="basic-info-section mb-4">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href={{ route('user.ViewProducts', [
                                'CatigoryName' => $product->catigory->name,
                                'BrandName' => 'all',
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                                class="info-chip category-chip">
                                <i class="bi bi-folder me-1"></i> {{ $product->catigory->name }}
                            </a>
                            <a href={{ route('user.ViewProducts', [
                                'CatigoryName' => 'all',
                                'BrandName' => $product->brand->name,
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                                class="info-chip brand-chip">
                                <i class="bi bi-tag me-1"></i> {{ $product->brand->name }}
                            </a>
                            <a href={{ route('user.ViewProducts', [
                                'CatigoryName' => 'all',
                                'BrandName' => 'all',
                                'TagName' => $product->tag->name,
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                                class="info-chip tag-chip">
                                <i class="bi bi-hash me-1"></i> {{ $product->tag->name }}
                            </a>
                        </div>
                    </div>

                    <!-- منطقة السعر -->
                    <div class="new-price-area d-flex align-items-center gap-3">
                        <div class="new-price">{{ $product->price }} ل.س</div>
                    </div>

                    <!-- حالة التوفر (بدون إطار البطاقة) -->
                    <div class="stock-info-section">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
                            <span class="fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">حالة
                                التوفر:</span>

                            @if (
                                $product->available &&
                                    $product->quantity > 0 &&
                                    $product->tag?->available &&
                                    $product->catigory?->available &&
                                    $product->brand?->available)
                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>
                                    متوفر</span>
                            @else
                                <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> غير
                                    متوفر</span>
                            @endif
                        </div>
                    </div>

                    <!-- الكمية وزر الشراء -->
                    <div class="d-flex gap-3 mb-4">
                        @if ($IsCartItem)
                            <button wire:click.prevent='removeFromCart'
                                class="btn btn-outline-success flex-grow-1">إزالة من السلة</button>
                        @else
                            @if (
                                $product->available &&
                                    $product->quantity > 0 &&
                                    $product->tag?->available &&
                                    $product->catigory?->available &&
                                    $product->brand?->available)
                                <button wire:click.prevent='addToCart' class="btn btn-buy-new flex-grow-1">
                                    إضافة للسلة <i class="bi bi-cart-plus me-2"></i>
                                </button>
                            @endif
                        @endif
                        @if ($IsFavItem)
                            <button wire:click.prevent='removeFromFav' wire:loading.attr='disabled'
                                class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        @else
                            <button wire:click.prevent='addToFav'wire:loading.attr='disabled'
                                class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                <i class="bi bi-heart"></i>
                            </button>
                        @endif
                    </div>

                    <!-- التبويبات -->
                    <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#desc-tab" type="button">الوصف</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#specs-tab"
                                type="button">المواصفات</button></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="desc-tab">
                            <p class="text-muted">{{ $product->desc }}</p>
                        </div>
                        <div class="tab-pane fade" id="specs-tab">
                            <ul class="list-group list-group-flush">
                                @foreach ($product->specifications as $specifications)
                                    <li class="list-group-item d-flex justify-content-between"><span
                                            class="text-muted">{{ $specifications->name }}</span><span
                                            class="fw-bold">{{ $specifications->desc }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            function changeImage(thumbnail) {
                const mainImage = document.getElementById('mainProductImage');
                mainImage.src = thumbnail.src;
                document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
                thumbnail.classList.add('active');
            }
        </script>
    @else
        <div class="container py-5" style="scroll-margin-top: 80px;">

            <!-- فتات الخبز -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href={{ route('user.home') }}> الرئيسية </a></li>&nbsp;/&nbsp;
                    <li class="breadcrumb-item" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <div class="row g-5">

                <!-- القسم الأيمن: معرض الصور -->
                <div class="col-lg-6">
                    <div class="main-image-container">
                        @if ($product->imgs->isNotEmpty())
                            <img src={{ asset('products/imgs/' . $product->imgs[0]->path) }} id="mainProductImage"
                                class="main-image" alt="صورة المنتج">
                        @endif
                    </div>
                    <!-- الصور المصغرة -->
                    <div class="thumbnail-list">
                        @foreach ($product->imgs as $img)
                            <img src={{ asset('products/imgs/' . $img->path) }} class="thumbnail"
                                onclick="changeImage(this)" alt="صورة ">
                        @endforeach
                    </div>
                </div>

                <!-- القسم الأيسر: المعلومات -->
                <div class="col-lg-6">

                    <h1 class="fw-bold mb-2 display-5 text-dark">{{ $product->name }}</h1>
                    <div class="basic-info-section mb-4">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <a href={{ route('user.ViewProducts', [
                                'CatigoryName' => $product->catigory->name,
                                'BrandName' => 'all',
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                                class="info-chip category-chip">
                                <i class="bi bi-folder me-1"></i> {{ $product->catigory->name }}
                            </a>
                            <a href={{ route('user.ViewProducts', [
                                'CatigoryName' => 'all',
                                'BrandName' => $product->brand->name,
                                'TagName' => 'all',
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                                class="info-chip brand-chip">
                                <i class="bi bi-tag me-1"></i> {{ $product->brand->name }}
                            </a>
                            <a href={{ route('user.ViewProducts', [
                                'CatigoryName' => 'all',
                                'BrandName' => 'all',
                                'TagName' => $product->tag->name,
                                'ProductName' => 'none',
                                'Newests' => 'none',
                                'Offers' => 'none',
                                'Special' => 'none',
                            ]) }}
                                class="info-chip tag-chip">
                                <i class="bi bi-hash me-1"></i> {{ $product->tag->name }}
                            </a>
                        </div>
                    </div>

                    <!-- منطقة السعر ) -->
                    <div class="normal-price-area">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="normal-price">{{ $product->price }} ل.س</div>
                        </div>
                    </div>



                    <!-- حالة التوفر (بدون إطار البطاقة) -->
                    <div class="stock-info-section">
                        <div class="d-flex justify-content-between align-items-center pb-2 mb-2 border-bottom">
                            <span class="fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">حالة
                                التوفر:</span>

                            @if (
                                $product->available &&
                                    $product->quantity > 0 &&
                                    $product->tag->available &&
                                    $product->catigory->available &&
                                    $product->brand->available)
                                <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>
                                    متوفر</span>
                            @else
                                <span class="text-danger fw-bold"><i class="bi bi-x-circle-fill me-1"></i> غير
                                    متوفر</span>
                            @endif
                        </div>
                    </div>

                    <!-- الكمية وزر الشراء (تمت إضافة العداد) -->
                    <div class="d-flex gap-3 mb-5">

                        @if ($IsCartItem)
                            <button wire:click.prevent='removeFromCart'
                                class="btn btn-outline-primary flex-grow-1">إزالة من السلة</button>
                        @else
                            @if (
                                $product->available &&
                                    $product->quantity > 0 &&
                                    $product->tag->available &&
                                    $product->catigory->available &&
                                    $product->brand->available)
                                <button wire:click.prevent='addToCart' class="btn-buy-normal">
                                    إضافة للسلة <i class="bi bi-cart-plus me-2"></i>
                                </button>
                            @endif
                        @endif

                        @if ($IsFavItem)
                            <button wire:click.prevent='removeFromFav'
                                class="btn btn-outline-danger d-flex align-items-center justify-content-center"
                                style="width: 50px;">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                        @else
                            <button wire:click.prevent='addToFav'
                                class="btn btn-outline-danger d-flex align-items-center justify-content-center"
                                style="width: 50px;">
                                <i class="bi bi-heart"></i>
                            </button>
                        @endif
                    </div>

                    <!-- التبويبات -->
                    <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#desc-tab" type="button">الوصف</button></li>
                        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#specs-tab" type="button">المواصفات</button></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="desc-tab">
                            <p class="text-muted">{{ $product->desc }}</p>
                        </div>
                        <div class="tab-pane fade" id="specs-tab">
                            <ul class="list-group list-group-flush">
                                @foreach ($product->specifications as $specifications)
                                    <li class="list-group-item d-flex justify-content-between"><span
                                            class="text-muted">{{ $specifications->name }}</span><span
                                            class="fw-bold">{{ $specifications->desc }}</span></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <script>
            function changeImage(thumbnail) {
                const mainImage = document.getElementById('mainProductImage');
                mainImage.src = thumbnail.src;
                document.querySelectorAll('.thumbnail').forEach(thumb => thumb.classList.remove('active'));
                thumbnail.classList.add('active');
            }
        </script>
    @endif
</div>
