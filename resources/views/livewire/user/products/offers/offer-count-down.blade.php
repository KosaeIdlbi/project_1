<div class="countdown-box">
    <div wire:poll.1s.visible='countDown'></div>
    <div class="time-unit">
        <div class="time-val">{{ $days }}</div>
        <div class="time-label">يوم</div>
    </div>
    <div class="time-unit">
        <div class="time-val">{{ $hours }}</div>
        <div class="time-label">ساعة</div>
    </div>
    <div class="time-unit">
        <div class="time-val">{{ $minutes }}</div>
        <div class="time-label">دقيقة</div>
    </div>
    <div class="time-unit">
        <div class="time-val">{{ $secondes }}</div>
        <div class="time-label">ثانية</div>
    </div>
</div>
