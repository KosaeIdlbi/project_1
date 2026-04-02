<div>
    <a href={{ route('user.cart') }}
        class="btn btn-primary position-relative px-3 rounded-pill d-flex align-items-center gap-2 shadow-sm">
        <i class="bi bi-cart3 fs-5"></i>
        <!-- تفاصيل السلة -->
        <div class="d-flex flex-column align-items-start lh-1 d-none d-sm-flex">
            <span class="small fw-bold" style="font-size: 0.7rem;">السلة</span>
            <span class="small fw-bold" style="font-size: 0.8rem;">{{ $total }} ل.س</span>
        </div>
        <span
            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark border border-white"
            style="font-size: 0.65rem;">
            {{ $count }}
        </span>
    </a>
</div>
