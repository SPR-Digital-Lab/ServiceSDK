<div class="sticky-top align-items-center bg-primary flex-shrink-0 px-2 py-2 shadow-sm">
    <div class="d-flex justify-content-between py-1">
        <div class="d-flex justify-content-lg-start align-items-center">
            @if (false)
                <a href="{{ route('dashboard') }}"
                    class="btn btn-primary btn-sm fw-bold d-flex align-items-center rounded-sm">
                    {{-- <i class="bi bi-lightning-charge-fill animate__animated animate__delay animate__jello"></i> --}}
                    <i class="bi bi-fire animate__animated animate__delay animate__jello"></i>
                    {{-- <i class="bi bi-list"></i> --}}
                    {{-- <img src="{{asset('draw/menu.svg')}}" class="text-white" style="width:1.3rem" /> --}}
                </a>
            @endif

            <button @click="runtime.sidebar.visible=!runtime.sidebar.visible"
                class="btn btn-primary btn-sm fs-6 fw-bold d-flex align-items-center rounded-sm">
                {{-- <i class="bi bi-lightning-charge-fill animate__animated animate__delay animate__jello"></i> --}}
                {{-- <i class="bi bi-list fw-bold animate__animated animate__delay animate__jello"></i> --}}
                {{--  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" height="25px" width="25px"
                    stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>  --}}
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" height="20px" width="20px"
                    stroke="#ffffff">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M5 7H19" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M5 12L19 12" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M5 17L19 17" stroke="#ffffff" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </g>
                </svg>
                {{-- <i class="bi bi-list"></i> --}}
                {{-- <img src="{{asset('draw/menu.svg')}}" class="text-white" style="width:1.3rem" /> --}}
            </button>

        </div>
        {{-- <img src="{{asset('logo_White.png')}}" width="135px" /> --}}
        <div class="flex-grow-1 text-primary d-flex align-items-center text-uppercase overflow-hidden">
            <div class="fw-bold d-none d-sm-block pe-3 ps-1 text-white">{{ env('APP_NAME') }}</div>
            {{-- {{ dd(active_menu()->getActiveChild()) }} --}}
            @if (active_menu())
                <div class="border-muted small border-start mx-2 border-2 px-2 text-white">
                    @if (active_menu()->getActiveChild()->parent && active_menu()->getActiveChild()->parent->code == 'main-menu')
                        <b class="small px-1">
                            {{ active_menu()->getActiveChild()->name }}
                        </b>
                    @else
                        @if (active_menu()->getActiveChild()->parent)
                            {{-- @if (active_menu()->getActiveChild()->parent->visibil) --}}

                            {{-- @endif --}}
                            {{-- <a href="{{ route('navigate', ['inner' => active_menu()->getActiveChild()->parent->getUUID()]) }}" --}}
                            <a href="{{ active_menu()->getActiveChild()->parent->link }}"
                                class="text-decoration-none small px-1 text-white">
                                <i class="bi bi-caret-left-fill"></i>
                                {{ active_menu()->getActiveChild()->parent->name }}
                            </a>
                            <span class="d-none d-sm-inline">/</span>
                            <b class="d-none d-sm-inline small px-1">
                                {{ active_menu()->getActiveChild()->name }}
                            </b>
                        @else
                            <b class="small px-1">
                                {{ active_menu()->getActiveChild()->name }}
                            </b>
                        @endif
                    @endif
                </div>
            @endif

        </div>
        <div class="d-flex justify-content-end align-items-center position-relative gap-2" x-data="{ upop: false }">
            <form action="{{route('search')}}" method="get" class="input-group">
                {{-- <label class="input-group-text" for="inputGroupSelect01">
                    <i class="bi bi-search-heart-fill"></i>
                </label> --}}
                <input type="text" name="query" class="form-control form-control-sm fw-bold"
                    placeholder="TYPE & ENTER">
            </form>
            <a href="{{ route('settings.dashboard') }}"
                class="btn btn-primary btn-sm fs-6 d-none d-sm-inline rounded-sm text-white">
                <i class="bi bi-gear-fill"></i>
            </a>
            @if (auth('cipher')->user())
                <button @click="upop=true" class="btn btn-primary btn-sm fs-6 rounded-sm text-white">
                    <i class="bi bi-person-fill"></i>
                </button>
                <div x-show="upop" @click.outside="upop=false" x-cloak
                    class="position-absolute end-0 top-0 me-4 mt-4 pe-2 pt-1">
                    <div class="rounded bg-white shadow" style="width:16rem;">
                        <div class="text-nowrap border-bottom px-3 py-2 pe-5">
                            <div class="fw-bold text-capitalize fs-6 m-0">
                                {{ auth('cipher')->user()->name }}
                            </div>

                            @if (auth('cipher')->user()->admin)
                                <div class="text-success text-uppercase fw-bold small">
                                    <i class="bi bi-award-fill"></i>
                                    <small>
                                        {{ auth('cipher')->user()->username }}
                                    </small>
                                </div>
                            @else
                                <div class="text-muted text-uppercase fw-bold small">
                                    <i class="bi bi-award-fill text-success"></i>
                                    <small>
                                        {{ auth('cipher')->user()->username }}
                                    </small>
                                </div>
                            @endif

                            <div class="text-primary text-uppercase fw-bold small d-flex mt-1 flex-wrap">
                                <i class="bi bi-bookmark-star-fill"></i>
                                @if (count(auth('cipher')->user()->groups) == 0)
                                    <small class="text-muted px-1">
                                        Not in any groups.
                                    </small>
                                @endif
                                @foreach (auth('cipher')->user()->groups as $grp)
                                    <small class="px-1 rounded-sm">
                                        {{ $grp['name'] }}
                                    </small>
                                @endforeach
                            </div>
                        </div>
                        <ul class="list-group list-group-flush small text-star">
                            <a href="{{ route('logout') }}"
                                class="btn btn-dark btn-sm list-group-item list-group-item-action text-uppercase fw-bold small">
                                <small>
                                    <i class="bi bi-door-open-fill"></i>
                                    Logout
                                </small>
                            </a>
                        </ul>
                    </div>
                </div>
                {{-- <div class="modal fade position-fixed" id="uModal" tabindex="-1" aria-labelledby="uModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="uModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif
            <a href="{{ route('settings.support') }}" class="btn btn-primary btn-sm fs-6 rounded-sm text-white">
                <i class="bi bi-life-preserver"></i>
            </a>
        </div>
    </div>
</div>
