@php
    $rid = uniqid('comp');
@endphp

@if (isset($this) && $header)
    @php
        $header = $this->header;
        $header_menu = $this->contextMenu();
    @endphp
@elseif(!isset($this))
    @php
        $header_menu = null;
    @endphp
@endif
<div class="bg-white shadow-sm border-bottom" x-data="{ errors: false }">
    <div class="gap-2 d-flex flex-md-row flex-column justify-content-between align-items-stretch align-items-md-end">
        <div class="p-3 flex-grow-1 p-md-4">
            <div x-data="{ menu: false }" class="d-flex justify-content-between align-items-start position-relative">
                <div>
                    <h1 class="mb-0 fs-1 text-capitalize">
                        @isset($header['title'])
                            {{ $header['title'] }}
                            @section('title', $header['title'])
                        @endisset
                    </h1>
                </div>
                <div class="gap-1 d-flex">
                    @if ($errors->any())
                        <button @click="errors=!errors" type="button" class="border btn btn-light text-danger btn-sm">
                            <i class="bi bi-exclamation-circle-fill"></i>
                        </button>
                        <div @click.outside="errors=false" x-show="errors" style="z-index: 99;" x-cloak
                            wire:key='errors_diag_{{ $rid }}'
                            class="top-0 p-2 m-4 bg-white shadow position-absolute border-start border-danger rounded-1 border-5 end-0">
                            <div class="list-group list-group-flush">
                                @foreach ($errors->all() as $i => $error)
                                    <span class="list-group-item list-group-item-action small">
                                        {{ $i + 1 }}. {{ $error }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if ($header_menu && @$header_menu->menu && @$header_menu->menu->count())
                        <button @click="menu=true"
                            class="border btn btn-light text-primary text-uppercase fw-bold small btn-sm">
                            <span class="d-none d-md-inline">Menu</span>
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <div @click.outside="menu=false" x-cloak x-show="menu" x-cloak style="z-index: 99"
                            wire:key='menu_diag_{{ $rid }}'
                            class="top-0 p-2 m-4 bg-white shadow position-absolute rounded-1 border-5 border-start border-primary end-0">
                            <div class="list-group list-group-flush">
                                @foreach ($header_menu->menu as $item)
                                    @if ($item->visible)
                                        <a href="{{ $item->link }}"
                                            class="list-group-item list-group-item-action small">
                                            {{ $item->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="flex-wrap">
                @isset($header['info'])
                    <small class="text-muted text-uppercase fw-bold">
                        {{ $header['info'] }}
                    </small><br>
                @endisset
                @isset($header['success'])
                    <small class="text-success fw-bold text-uppercase">
                        {{ $header['success'] }}
                    </small><br>
                @endisset
                @isset($header['danger'])
                    <small class="text-danger fw-bold text-uppercase">
                        {{ $header['danger'] }}
                    </small><br>
                @endisset
                @if ($errors->any())
                    <small class="text-danger fw-bold text-uppercase">
                        There are {{ $errors->count() }} errors in this page.
                    </small><br>
                @endif
            </div>
        </div>
    </div>
</div>



<div x-cloak x-data="{ showx: true, show: true }" :class="showx ? 'd-flex' : 'd-none'" x-init="setTimeout(() => { show = false }, 5000);
setTimeout(() => { showx = false }, 5500)"
    class="top-0 pt-3 position-fixed col-10 col-md-4 justify-content-end flex-column end-0 pe-3" style="z-index: 9999"
    wire:key='alert_{{ $rid }}'>
    @foreach (session('alerts', []) as $alert)
        <div :class="show ? 'd-flex animate__bounceInRight' : 'd-flex animate__bounceOutRight'"
            class="w-auto px-3 py-2 mt-2 bg-white rounded shadow align-items-center animate__animated">
            @if ($alert['type'] == 'ok')
                <i class="mx-1 bi bi-bell-fill text-success"></i>
            @elseif ($alert['type'] == 'error')
                <i class="mx-1 bi bi-exclamation-circle-fill text-danger"></i>
            @endif
            <div class="px-2 toast-body small">
                {{ $alert['message'] }}
            </div>
        </div>
    @endforeach
</div>
