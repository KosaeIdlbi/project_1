<div>
    <a href={{ route('user.fav') }} class="btn btn-light position-relative rounded-circle border-0 p-2"
        style="width: 40px; height: 40px;" title="المفضلة">
        <i class="bi bi-heart fs-5 text-danger"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-white"
            style="font-size: 0.65rem;">
            {{ $count }}
        </span>
    </a>
</div>
