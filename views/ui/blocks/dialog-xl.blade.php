<div wire:key='{{ isset($wkey) ? $wkey : uniqid() }}' id="spark_dialog"
    class="position-fixed d-flex justify-content-center align-items-center bottom-0 end-0 start-0 top-0 p-3"
    style="z-index: 9999;backdrop-filter: blur(2px);background-color: #00000061;">
    <form @isset($submit)
    wire:submit.prevent='{{ $submit }}' novalidate
    @endisset
        class="col-12 col-sm-8 col-md-6 col-xl-6 small overflow-auto rounded bg-white shadow" style="max-height: 75%">
        <div class="p-3 p-md-4">
            @isset($title)
                <h5 class="mb-2">
                    {{ $title }}
                </h5>
            @endisset
            @isset($description)
                <p class="mb-3">
                    {!! $description !!}
                </p>
            @endisset
            @isset($slot)
                {{ $slot }}
            @endisset
            @isset($actions)
                <div class="d-flex justify-content-end mt-3 gap-2">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </form>
</div>
