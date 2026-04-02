<div>
    <style>
        /* البطاقة (كما في الرد السابق) */
        .cart-item-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
            margin-bottom: 15px;
        }

        .cart-image-wrapper {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            flex-shrink: 0;
        }

        .cart-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* عداد الكمية */
        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            overflow: hidden;
            width: 110px;
        }

        .quantity-btn {
            background: #f8fafc;
            border: none;
            padding: 8px 12px;
            font-weight: bold;
            font-size: 1.2rem;
            cursor: pointer;
            color: #475569;
            transition: background 0.2s;
        }

        .quantity-btn:hover {
            background: #e2e8f0;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            border-right: 1px solid #cbd5e1;
            border-left: 1px solid #cbd5e1;
            font-weight: bold;
            font-size: 1rem;
            outline: none;
            background: #fff;
        }

        /* شارات الحالة المضمنة (Inline) */
        .stock-status-inline {
            margin-bottom: 10px;
        }

        .status-badge-inline {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .success-badge {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .danger-badge {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
    </style>
    <div class="cart-item-card">
        @if ($cart_item->imgs->isNotEmpty())
            <img src={{ asset('products/imgs/' . $cart_item->imgs[0]->path) }} class="product-img-cart ms-4 me-3"
                alt="Product">
        @endif

        <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
                <h6 class="fw-bold mb-1">{{ $cart_item->name }}</h6>
                <button wire:click.prevent='remove' class="btn text-danger p-0 small ms-2 mt-2" title="حذف"><i
                        class="bi bi-trash"></i></button>
            </div>
            <p class="text-muted small mb-2">{{ $cart_item->desc }}</p>
            <div class="fw-bold text-primary">{{ $price }} ل.س</div>
        </div>
        <div class="stock-status-inline">

            @if (
                !$cart_item->available ||
                    !$cart_item->quantity > 0 ||
                    !$cart_item->tag->available ||
                    !$cart_item->catigory->available ||
                    !$cart_item->brand->available)
                <span class="status-badge-inline danger-badge">
                    <i class="bi bi-x-circle-fill me-1"></i> غير متوفر
                </span>
            @endif
        </div>
        <div class="d-flex flex-column align-items-end justify-content-between h-100 ms-3">
            <div class="quantity-control">
                <button wire:click.prevent='sub' class="quantity-btn">-</button>
                <input wire:model='quantity' type="text" class="quantity-input" readonly min="1">
                <button wire:click.prevent='add' class="quantity-btn">+</button>
            </div>
            <div class="fw-bold mt-2">{{ $total }} ل.س</div>
        </div>

    </div>
</div>
