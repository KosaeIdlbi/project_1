<div>
    <div wire:poll.1s>
        @if ($rest_time)
            try agin after {{ $rest_time }}
        @else
        @endif
    </div>
</div>
