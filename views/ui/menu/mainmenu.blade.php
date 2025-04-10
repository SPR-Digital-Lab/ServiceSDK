<div class="h-100 d-flex flex-column">
    <div class="flex-shrink-0 py-2 mt-1">
        @foreach ($menu->menu as $item)
            {{-- @if ($item->menu->where('visible', true)->count())
                <div x-data="{ hover: false }" @mouseover="hover=true" @mouseleave="hover=false" class="mx-2 mt-2 mb-1">
                    <div class="px-2 pt-1 text-uppercase">
                        <small
                            class="@if ($item->isActive()) fw-bold text-primary @else text-muted @endif animated"
                            :class="hover ? 'fw-bold' : ''">
                            {{ $item->name }}
                        </small>
                    </div>
                    <hr class="@if ($item->isActive()) text-primary @else @endif m-0 my-1">
                    <div class="mb-3">
                        @foreach ($item->menu as $item)
                            <div class="@if ($item->isActive()) px-2 py-1 @endif">
                                <a href="{{ $item->link }}"
                                    class="btn btn-sm fw-bold w-100 d-flex align-items-lg-center @if ($item->isActive()) px-3 btn-primary rounded-3  @else px-4 rounded-0 btn-outline-light text-muted @endif border-0 py-1 text-start"
                                    type="button">
                                    <i class="fs-6 {{ $item->icon }}"></i>
                                    <small class="px-2 py-1 text-uppercase">
                                        {{ $item->name }}
                                    </small>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if ($loop->iteration > 0)
                @endif
                <div class="@if ($item->isActive()) fw-bold @endif my-1 px-2">
                    <a href="{{ $item->link }}" x-data="{ hover: false }"
                        class="btn btn-sm fw-bold w-100 d-flex align-items-lg-center @if ($item->isActive()) px-3 btn-primary rounded-3  @else px-3 rounded-0 btn-outline-light text-muted rounded-3 @endif border-0 py-2 text-start"
                        type="button" :class="hover ? 'shadow-sm' : ''">
                        <i class="fs-6 {{ $item->icon }}"></i>
                        <div class="px-3 py-1 text-uppercase">
                            <small class="">
                                {{ $item->name }}
                            </small>
                        </div>
                    </a>
                </div>
            @endif --}}

            @if ($item->visible)
                <div class="@if ($item->isActive()) fw-bold @endif my-1 px-2">
                    <a href="{{ $item->link }}" x-data="{ hover: false }"
                        class="btn btn-sm fw-bold w-100 d-flex align-items-lg-center @if ($item->isActive()) px-3 btn-primary rounded-3  @else px-3 rounded-0 btn-outline-light text-muted rounded-3 @endif border-0 py-2 text-start"
                        type="button" :class="hover ? 'shadow-sm' : ''">
                        <i class="fs-6 {{ $item->icon }}"></i>
                        <div class="px-3 py-1 text-uppercase">
                            <small class="">
                                {{ $item->name }}
                            </small>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
    </div>
    <div class="flex-grow-1">
    </div>
</div>
