<div>
    <div wire:poll.1s>
        @if ($minutes)
            try agin after {{ $minutes }} : {{ $secondes }}
        @else
        @endif
    </div>
</div>
