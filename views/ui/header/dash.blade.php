@php
    $rid = uniqid('comp');
@endphp

@include('sdk::ui.blocks.confirmation')
@include('sdk::ui.blocks.editor')

@if (isset($smartBackOverride) && $smartBackOverride)
    <script></script>
@endif

<script wire:key='__unsaved_data_warning_{{ $rid }}'>
    @if ($errors->any() || collect(session('alerts', []))->where('type', 'error')->count())
        window.__unsaved_data_warning = true;
    @else
        window.__unsaved_data_warning = false;
    @endif

    window.__unsaved_data_warning_latch = 5;

    window.__rid = "{{ $rid }}";

    $(document).ready(function() {
        $(":input").each((i, e) => {
            e = $(e);
            if (e.attr('id'))
                console.log("registered input", e.attr('id'));
            // $(e).attr("focusid",i)
        })
        $(":input").keydown(function(e) {
            window.__unsaved_data_warning = true;
            window.__unsaved_data_warning_latch = 5;
            let elm = $(e.currentTarget);
            if (elm.attr('id')) {
                console.log("remebering focus", elm.attr('id'));
                window.__last_changed_input = elm.attr('id');
            }
        });
        // $(":input").click(function(e) {
        //     window.__unsaved_data_warning = true;
        //     window.__unsaved_data_warning_latch = 5;
        //     let elm = $(e.currentTarget);
        //     if (elm.attr('id')) {
        //         console.log("remebering focus", elm.attr('id'));
        //         window.__last_changed_input = elm.attr('id');
        //     }
        // });
        let pageErrors = @json($errors->all());
        if (window.__last_changed_input && pageErrors.length == 0) {
            setTimeout(() => {
                let elm = document.getElementById(window.__last_changed_input);
                elm.focus();
                console.log("restoring focus", window.__last_changed_input)
            }, 100);
        }
    });
    window.onbeforeunload = () => {
        if (window.__unsaved_data_warning && window.__unsaved_data_warning_latch > 0) {
            window.__unsaved_data_warning_latch = window.__unsaved_data_warning_latch - 1;
            return "You have unsaved changes on this page. Do you want to leave this page and discard your changes or stay on this page?";
        }
    }

    window.document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('message.received', (message, component) => {
            if (message.response.effects.redirect)
                window.__unsaved_data_warning = false;
            // console.log('lw',)
        })
    });

    window.GraceFullInputErrorFocus = function(element) {
        if (window.gracefull_error_element && window.__rid == "{{ $rid }}") return;
        window.gracefull_error_element = element;
        element.focus();
    }
</script>

@if (isset($this) && $__header)
    @php
        $__header = $this->__header;
        $__header_menu = $this->contextMenu();
        $hotbars = $__header_menu->hot();
        $layout = @$layout;
    @endphp
@elseif(!isset($this))
    @php
        $__header_menu = null;
        $hotbars = collect();
        $layout = null;
        if (isset($header)) {
            $__header = $header;
        }
    @endphp
@endif
@if (isset($__header['title']) && $__header['title'])
    <div class="text-dark border-bottom bg-white p-2 @if ($layout != 'glide.layouts.guest') shadow-sm sticky-top @endif"
        style="z-index: 999">
        <div x-data="{ menu: false, errors: true }" wire:key="header_dash_{{ time() }}"
            class="d-flex justify-content-between align-items-center position-relative">
            <div class="px-2">
                @if (isset($__header['danger']) && $__header['danger'])
                    <div class="small fw-bold text-uppercase text-danger">
                        <i class="bi bi-circle-fill me-1"></i> {!! $__header['danger'] !!}
                    </div>
                @elseif(isset($__header['success']) && $__header['success'])
                    <div class="small fw-bold text-uppercase text-success">
                        <i class="bi bi-circle-fill me-1"></i> {!! $__header['success'] !!}
                    </div>
                @elseif(isset($__header['hint']) && $__header['hint'])
                    <div class="small fw-bold text-uppercase text-secondary">
                        <i class="bi bi-lightning-charge-fill me-1"></i> {!! $__header['hint'] !!}
                    </div>
                @endif
            </div>
            <div class="d-flex gap-1">
                <div hidden class="align-items-center p-2" wire:loading.class='d-flex'>
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="position-relative" wire:key="header_error_base{{ time() }}">
                        <button @click="errors=!errors" type="button"
                            class="d-flex align-items-center btn btn-outline-light text-danger btn-sm p-1">
                            {{-- <i class="bi bi-exclamation-circle-fill"></i> --}}
                            <svg viewBox="0 0 16 16" fill="none" class="m-1" xmlns="http://www.w3.org/2000/svg"
                                width="20px" height="20px" stroke="#ff0000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M7.493 0.015 C 7.442 0.021,7.268 0.039,7.107 0.055 C 5.234 0.242,3.347 1.208,2.071 2.634 C 0.660 4.211,-0.057 6.168,0.009 8.253 C 0.124 11.854,2.599 14.903,6.110 15.771 C 8.169 16.280,10.433 15.917,12.227 14.791 C 14.017 13.666,15.270 11.933,15.771 9.887 C 15.943 9.186,15.983 8.829,15.983 8.000 C 15.983 7.171,15.943 6.814,15.771 6.113 C 14.979 2.878,12.315 0.498,9.000 0.064 C 8.716 0.027,7.683 -0.006,7.493 0.015 M8.853 1.563 C 9.967 1.707,11.010 2.136,11.944 2.834 C 12.273 3.080,12.920 3.727,13.166 4.056 C 13.727 4.807,14.142 5.690,14.330 6.535 C 14.544 7.500,14.544 8.500,14.330 9.465 C 13.916 11.326,12.605 12.978,10.867 13.828 C 10.239 14.135,9.591 14.336,8.880 14.444 C 8.456 14.509,7.544 14.509,7.120 14.444 C 5.172 14.148,3.528 13.085,2.493 11.451 C 2.279 11.114,1.999 10.526,1.859 10.119 C 1.618 9.422,1.514 8.781,1.514 8.000 C 1.514 6.961,1.715 6.075,2.160 5.160 C 2.500 4.462,2.846 3.980,3.413 3.413 C 3.980 2.846,4.462 2.500,5.160 2.160 C 6.313 1.599,7.567 1.397,8.853 1.563 M7.706 4.290 C 7.482 4.363,7.355 4.491,7.293 4.705 C 7.257 4.827,7.253 5.106,7.259 6.816 C 7.267 8.786,7.267 8.787,7.325 8.896 C 7.398 9.033,7.538 9.157,7.671 9.204 C 7.803 9.250,8.197 9.250,8.329 9.204 C 8.462 9.157,8.602 9.033,8.675 8.896 C 8.733 8.787,8.733 8.786,8.741 6.816 C 8.749 4.664,8.749 4.662,8.596 4.481 C 8.472 4.333,8.339 4.284,8.040 4.276 C 7.893 4.272,7.743 4.278,7.706 4.290 M7.786 10.530 C 7.597 10.592,7.410 10.753,7.319 10.932 C 7.249 11.072,7.237 11.325,7.294 11.495 C 7.388 11.780,7.697 12.000,8.000 12.000 C 8.303 12.000,8.612 11.780,8.706 11.495 C 8.763 11.325,8.751 11.072,8.681 10.932 C 8.616 10.804,8.460 10.646,8.333 10.580 C 8.217 10.520,7.904 10.491,7.786 10.530 "
                                        stroke="none" fill-rule="evenodd" fill="#f00f0f"></path>
                                </g>
                            </svg>
                        </button>
                        <div @click.outside="errors=false" x-show="errors" style="z-index: 99;width: 15rem;" x-cloak
                            class="position-absolute border-start border-danger rounded-1 border-5 end-0 top-0 m-4 bg-white p-2 shadow">
                            <div class="list-group list-group-flush">
                                @foreach ($errors->all() as $i => $error)
                                    <span class="list-group-item list-group-item-action small">
                                        {{ $i + 1 }}. {{ $error }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <button wire:click='refresh'
                    class="btn btn-outline-light d-flex align-items-center text-dark text-uppercase fw-bold">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                @if (isset($__header_menu) && $__header_menu && @$__header_menu->menu && @$__header_menu->menu->count())
                    <button @click="menu=true"
                        class="btn btn-outline-light d-flex align-items-center text-dark text-uppercase fw-bold small btn-sm">
                        <span class="d-none d-md-inline small fw-bold ps-2">OPTIONS</span>
                        {{-- <i class="bi bi-three-dots-vertical"></i> --}}
                        {{-- <i class="bi bi-arrows-expand"></i> --}}
                        <svg fill="#2e2e2e" viewBox="0 0 1024 1024" height="28px" width="28px"
                            xmlns="http://www.w3.org/2000/svg" stroke="#2e2e2e">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M620.6 562.3l36.2 36.2L512 743.3 367.2 598.5l36.2-36.2L512 670.9l108.6-108.6zM512 353.1l108.6 108.6 36.2-36.2L512 280.7 367.2 425.5l36.2 36.2L512 353.1z">
                                </path>
                            </g>
                        </svg>
                    </button>
                    <div @click.outside="menu=false" x-cloak x-show="menu" x-cloak style="z-index: 99"
                        wire:key='menu_diag_{{ $rid }}'
                        class="position-absolute rounded-1 border-5 border-start border-primary end-0 top-0 m-4 bg-white p-2 shadow">
                        <div class="list-group list-group-flush text-start">
                            @foreach ($__header_menu->menu as $item)
                                @include('glide.header.contextmenubutton', ['item' => $item])
                            @endforeach
                        </div>
                    </div>
                @else
                    <button disabled
                        class="btn btn-outline-light d-flex align-items-center text-dark text-uppercase fw-bold small btn-sm">
                        <span class="d-none d-md-inline small fw-bold ps-2">OPTIONS</span>
                        {{-- <i class="bi bi-three-dots-vertical"></i> --}}
                        {{-- <i class="bi bi-arrows-expand"></i> --}}
                        <svg fill="#2e2e2e" viewBox="0 0 1024 1024" height="28px" width="28px"
                            xmlns="http://www.w3.org/2000/svg" stroke="#2e2e2e">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M620.6 562.3l36.2 36.2L512 743.3 367.2 598.5l36.2-36.2L512 670.9l108.6-108.6zM512 353.1l108.6 108.6 36.2-36.2L512 280.7 367.2 425.5l36.2 36.2L512 353.1z">
                                </path>
                            </g>
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>


    <div
        class="d-flex flex-md-row flex-column justify-content-between align-items-stretch align-items-md-end gap-2 border-b p-4">
        <div class="px-2">
            <div class="d-flex">
                @if (isset($__header['back']) && $__header['back'])
                    <a href="{{ $__header['back'] }}"
                        class="btn btn-dark d-flex align-items-center text-uppercase fw-bold small btn-sm">
                        <span class="small fw-bold px-2">Back</span>
                    </a>
                @endif
            </div>
            <h5 class="fs-2 mb-0 mt-2">
                {{ $__header['title'] }}
                @section('title', $__header['title'])
            </h5>
            @if (isset($__header['info']) && $__header['info'])
                <div class="d-flex small flex-wrap pt-1">
                    <small class="text-muted fw-bold text-uppercase">
                        {!! $__header['info'] !!}
                    </small>
                </div>
            @endif
        </div>
        <div class="d-flex flex-shrink-0 gap-2 px-1">
            @if (isset($__header['counters']) && is_array($__header['counters']))
                @foreach ($__header['counters'] as $k => $counter)
                    @if (@$counter['type'] == 'qr')
                        <button
                            wire:click="_printMiniVoucher('{{ $counter['code'] }}','{{ $counter['label'] }}','{{ $counter['description'] }}')"
                            class="btn p-1 flex-grow-1 rounded bg-white text-end shadow-sm">
                            <img
                                src="https://sprdigitallab.com/spr_qr/generate_qr2.php?data={{ $counter['code'] }}&foreground_color=ffffff&background_color=000000&size=4&margin=1">
                        </button>
                    @else
                        <div
                            class="text-{{ @$counter['type'] ?? 'info' }} flex-grow-1 rounded bg-white p-3 text-end shadow-sm">
                            <div class="fs-1 fw-bold mb-0">
                                {{ $counter['count'] }}
                            </div>
                            <div class="small fw-bold text-uppercase">
                                <small>
                                    {{ $counter['label'] }}
                                </small>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endif
@if (isset($hotbars) && count($hotbars))
    <div class="px-4">
        <div class="d-flex text-nowrap px-2">
            @include('glide.header.hotbar')
        </div>
    </div>
@endif

<div x-cloak x-data="{ showx: true, show: true }" :class="showx ? 'd-flex' : 'd-none'" x-init="setTimeout(() => { show = false }, 5000);
setTimeout(() => { showx = false }, 5500)"
    class="position-fixed col-10 col-md-4 justify-content-end flex-column end-0 top-0 pe-3 pt-3" style="z-index: 9999"
    wire:key='alert_{{ $rid }}'>
    @foreach (session('alerts', []) as $alert)
        <div :class="show ? 'd-flex animate__bounceInRight' : 'd-flex animate__bounceOutRight'"
            class="align-items-center animate__animated mt-2 w-auto rounded bg-white px-3 py-2 shadow">
            @if ($alert['type'] == 'ok')
                <i class="bi bi-bell-fill text-success mx-1"></i>
            @elseif ($alert['type'] == 'error')
                <i class="bi bi-exclamation-circle-fill text-danger mx-1"></i>
            @endif
            <div class="toast-body small px-2">
                {!! $alert['message'] !!}
            </div>
        </div>
    @endforeach
</div>


@if (session()->has('redirect-new-tab'))
    <script wire:key='redirect-new-tab-{{ uniqid('re-') }}'>
        var page = "{{ session()->get('redirect-new-tab') }}";
        var myWindow = window.open(page, "_blank", "scrollbars=yes,width=600,height=500");
        myWindow.focus();
    </script>
@endif


<script>
    window.supportWindow = function(_url, callback) {
        var url = new URL(_url)
        url.searchParams.set('window', 'support');
        console.dir(url);
        var sw = window.open(url.href, url.pathname, "scrollbars=yes,width=600,height=500");
        sw.supportCallback = function(carry) {
            console.log("[supportWindow] Calling support callback", carry);
            callback(carry);
            sw.close();
        };
        sw.focus();
    }
</script>


@if (session()->has('supportCallback'))
    <script wire:key='supportCallback-{{ uniqid('re-') }}'>
        if (window.supportCallback) {
            window.supportCallback("{{ session()->get('supportCallback') }}");
        }
    </script>
@endif
