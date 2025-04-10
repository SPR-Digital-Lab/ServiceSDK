{{-- <div class="d-flex justify-content-center align-items-center m-3 p-3 text-center">
    <div class="text-muted small text-uppercase">
        Oops! this seems to be empty.
        @isset($view)
            {{ $view }}
        @endisset
    </div>
</div> --}}

@include('sdk:ui.blocks.notice',['message'=>" Oops! this seems to be empty."])
