<div
    class="px-4 d-flex justify-content-between sticky-top align-items-center flex-shrink-0 bg-white px-2 py-2 shadow-sm">
    <div class="d-flex justify-content-lg-start align-items-center">
        <a href="{{route('dashboard')}}" class="btn btn-light text-primary btn-sm fw-bold d-flex small align-items-center rounded-sm">
            {{-- <i class="bi bi-lightning-charge-fill animate__animated animate__delay animate__jello"></i> --}}
            <i class="bi bi-fire animate__animated animate__delay animate__jello"></i>
            {{-- <i class="bi bi-list"></i> --}}
            {{-- <img src="{{asset('draw/menu.svg')}}" class="text-white" style="width:1.3rem" /> --}}
        </a>
    </div>
    {{-- <img src="{{asset('logo_White.png')}}" width="135px" /> --}}
    <div class="flex-grow-1 text-primary d-flex align-items-center small text-uppercase overflow-hidden px-2">
        <div class="fw-bold d-none d-sm-block pe-3 ps-1">{{ env('APP_NAME') }}</div>
        {{-- {{ dd(active_menu()->getActiveChild()) }} --}}
        @if (active_menu())
            <div class="border-muted text-muted small border-start mx-2 border-2 px-2">
                @if (active_menu()->getActiveChild()->parent && active_menu()->getActiveChild()->parent->code == 'main-menu')
                    <b class="px-1">
                        {{ active_menu()->getActiveChild()->name }}
                    </b>
                @else
                    @if (active_menu()->getActiveChild()->parent)
                        <a href="{{ active_menu()->getActiveChild()->parent->link }}"
                            class="text-decoration-none px-1">{{ active_menu()->getActiveChild()->parent->name }}</a>/
                        <b class="px-1">
                            {{ active_menu()->getActiveChild()->name }}
                        </b>
                    @else
                        <b class="px-1">
                            {{ active_menu()->getActiveChild()->name }}
                        </b>
                    @endif
                @endif
            </div>
        @endif

    </div>
    <div class="d-flex justify-content-end align-items-center position-relative gap-2">
        {{-- <a href="{{route('support')}}" class="btn btn-light btn-sm fs-6 text-muted rounded-sm">
            <i class="bi bi-life-preserver"></i>
        </a> --}}
    </div>
</div>
