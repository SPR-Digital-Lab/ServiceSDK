<div class="px-{{@$pxmd??"3"}} my-{{@$my??"4"}} bg-{{@$bg??"white"}}">
    @php
        $rid = uniqid("render_");
    @endphp
    <div class="px-{{@$px??"2"}} px-md-{{@$pxmd??"3"}} py-1">
        @isset($title)
            <div class="pt-2 mb-0 col-12 form-text fw-bold text-uppercase d-flex align-items-center">
                <div class="flex-shrink-0 pe-2 text-dark">{{ $title }}</div>
                <hr class="my-1 w-100">
            </div>
        @endisset
        {{ $slot }}
    </div>
</div>
