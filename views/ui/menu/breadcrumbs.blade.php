<div class="d-flex justify-content-end text-uppercase fw-bold flex-row-reverse">
    @php
        $m = $menu;
        $first = true;
    @endphp
    @while ($m->parent)
        @if ($first)
            <div class="px-2">
                {{ $m->name }}
            </div>
            @php
                $first = false;
            @endphp
        @else
            <a href="{{ route('navigate', ['inner' => $m->getUUID()]) }}" class="px-2 text-muted">
                {{ $m->name }}
            </a>
        @endif
        /
        @php
            $m = $m->parent;
        @endphp
    @endwhile
    <a href="{{ route('navigate', ['inner' => $m->getUUID()]) }}" class="pe-2  text-muted">
        {{ $m->name }}
    </a>
</div>
