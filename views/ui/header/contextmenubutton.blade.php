@php
    if (!isset($isHot)) {
        $isHot = false;
    }
@endphp
@if ($item->visible)
    @if ($item->meta('wire:click'))
        <button wire:loading.attr='disabled' wire:click="{{ $item->meta('wire:click') }}"
            class="list-group-item list-group-item-action small btn-sm px-3 py-2"
            @if ($item->meta('keycode')) x-init="window.handle_menu_key_{{ $item->meta('keycode') }}(()=>{menu=true}, $el,'{{ $item->meta('keycode') }}')" @endif>
            <div class="d-flex justify-content-start align-items-center w-100 text-uppercase small fw-bold">
                {{-- <small> --}}
                {{ $item->name }}
                {{-- </small> --}}
                <div class="spinner-border spinner-border-sm mx-1" role="status" wire:loading
                    wire:target='{{ $item->meta('wire:click') }}'>
                    <span class="visually-hidden">Loading...</span>
                </div>
                @if ($item->meta('keycode'))
                    <script>
                        window.handle_menu_key_{{ $item->meta('keycode') }} = (d, el, code) => {
                            $(document).on('keypress', (e) => {
                                // console.log(e.key, e.ctrlKey);
                                if (e.key == code && e.ctrlKey) {
                                    console.log(e.key, e.ctrlKey);
                                    d();
                                    el.click();
                                }
                            });
                        }
                    </script>
                    <div wire:target='{{ $item->meta('wire:click') }}' wire:loading.class='d-none'
                        class="text-capitalize d-block small fw-bold ps-2">
                        - ctrl {{ $item->meta('keycode') }}
                    </div>
                @endif
            </div>
        </button>
    @elseif($item->meta('@click'))
        <button wire:loading.attr='disabled' x-on:click="{{ $item->meta('@click') }}"
            class="list-group-item list-group-item-action small btn-sm px-3 py-2"
            @if ($item->meta('keycode')) x-init="window.handle_menu_key_{{ $item->meta('keycode') }}(()=>{menu=true}, $el,'{{ $item->meta('keycode') }}')" @endif>
            <div class="d-flex justify-content-start align-items-center w-100 text-uppercase small fw-bold">
                {{-- <small> --}}
                {{ $item->name }}
                {{-- </small> --}}
                @if ($item->meta('keycode'))
                    <script>
                        window.handle_menu_key_{{ $item->meta('keycode') }} = (d, el, code) => {
                            $(document).on('keypress', (e) => {
                                // console.log(e.key, e.ctrlKey);
                                if (e.key == code && e.ctrlKey) {
                                    console.log(e.key, e.ctrlKey);
                                    d();
                                    el.click();
                                }
                            });
                        }
                    </script>
                    <div wire:target='{{ $item->meta('wire:click') }}' wire:loading.class='d-none'
                        class="text-capitalize d-block small fw-bold ps-2">
                        - ctrl {{ $item->meta('keycode') }}
                    </div>
                @endif
            </div>
        </button>
    @else
        <a href="{{ $item->link }}"
            class="list-group-item list-group-item-action text-uppercase small fw-bold  px-3 py-2">
            <small>{{ $item->name }}</small>
        </a>
    @endif
@endif
