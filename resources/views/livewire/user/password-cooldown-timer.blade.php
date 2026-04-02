<div>
    <div wire:poll.1s>
        @if ($minutes)
            حاول مجددا بعد {{ $secondes }} : {{ $minutes }}
        @else
        @endif
    </div>
</div>
