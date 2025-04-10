<div class="mt-4 rounded bg-white shadow-sm">
    <div class="d-flex justify-content-between align-items-center px-2 py-2 shadow-sm">
        <div class="text-dark fw-bold text-uppercase small px-2">
            <i></i>
            <span class="px-1">
                {{ $menu->getName() }}
                @if ($menu->getDescription())
                    <br>
                    <small class="fw-normal">{{ $menu->getDescription() }}</small>
                @endif
            </span>
        </div>
        <div class="d-flex gap-2">
            <a class="text-dark btn btn-sm btn-outline-light" href="#">
                <i class="bi bi-question-lg"></i>
            </a>
            <a class="text-dark btn btn-sm btn-outline-light" href="#">
                <i class="bi bi-three-dots-vertical"></i>
            </a>
        </div>
    </div>
    @foreach ($menu->menu as $menu)
        <div class="border-bottom mx-1 px-3 py-3">
            <div class="d-flex align-items-center justify-content-between py-2">
                <div class="mt-1 px-1">
                    <span class="fw-bold text-uppercase">{{ $menu->getName() }}</span>
                    <br>
                    <span class="text-muted">
                        {{ $menu->getDescription() }}
                    </span>
                </div>
                <div class="px-2">
                    <i class="{{ $menu->getIcon() }} fs-5" :class="hover ? 'text-primary' : ''"></i>
                </div>
            </div>
            <div class="row col-lg-10">
                @foreach ($menu->menu as $menu)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2">
                        <a href="#" class="d-block text-dark text-decoration-none p-3"
                            x-data="{ hover: false }" @mouseover="hover=true" @mouseout="hover=false"
                            :class="hover ? 'shadow bg-white rounded' : 'bg-light'">
                            <div class="d-flex justify-content-between">
                                <i class="{{ $menu->getIcon() }} fs-4"
                                    :class="hover ? 'text-primary' : ''"></i>
                                <small class="fw-bold">
                                    {{ $menu->meta('notifications') }}
                                </small>
                            </div>

                            <div class="fw-bold mb-1 mt-2">
                                {{ $menu->getName() }}
                            </div>
                             <div class="text-dark small mt-1">
                                {{ $menu->getDescription() }}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
