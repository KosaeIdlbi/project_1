<div>
    @if ($user->img)
        <img src={{ asset('users/imgs/' . $user->img->path) }} class="rounded-circle" alt="user" style="width: 30px">
    @else
        <img src={{ asset('assets/img/img11.jpg') }} class="rounded-circle" alt="user" style="width: 30px">
    @endif
    <span class="fw-bold text-dark small d-none d-lg-inline">{{ $user->name }}</span>
</div>
