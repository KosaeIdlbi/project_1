<div class="d-flex ms-auto" role="search">
    <form>
        <div class="input-group input-group-sm">
            <input wire:model.live.debounce.500ms='search' list="products" class="form-control rounded-end-pill"
                type="search" placeholder="بحث..." aria-label="Search">
            <datalist id="products">
                @foreach ($results as $result)
                    <option value="{{ $result->name }}">{{ $result->name }}</option>
                @endforeach
            </datalist>
            <a href={{ route('user.ViewProducts', [
                'CatigoryName' => 'all',
                'BrandName' => 'all',
                'ProductName' => $search ? $search : 'none',
                'TagName' => 'all',
                'Newests' => 'none',
                'Offers' => 'none',
                'Special' => 'none',
            ]) }}
                class="btn btn-outline-secondary rounded-start-pill" type="button">
                <i class="bi bi-search"></i>
            </a>
        </div>
    </form>
</div>
