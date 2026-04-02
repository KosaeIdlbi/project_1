<div>
    <span class="logged-name">{{ $admin->name }}<span class="hidden-md-down"></span></span>
    @if ($admin->img)
        <img src={{ asset('users/imgs/' . $admin->img->path) }} class="wd-32 rounded-circle" alt="">
    @else
        <img src={{ asset('assets/img/img11.jpg') }} class="wd-32 rounded-circle" alt="">
    @endif
</div>
