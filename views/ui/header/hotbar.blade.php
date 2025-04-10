{{-- <div class="row d-flex w-50 mb-3 ms-3 gap-1 rounded border-0 px-2 py-1 text-white"> --}}
{{-- <div class="btn-group btn-primary btn btn-group-sm text-nowrap gap-3" role="group" aria-label="Basic example"> --}}
<div class="d-md-flex d-none btn-group btn-group-sm gap-2" role="group" aria-label="Basic example">
    @foreach ($hotbars as $item)
        <div class="btn-primary btn p-0 rounded-1">
            @include('glide.header.contextmenubutton', ['item' => $item, 'isHot' => true])
        </div>
    @endforeach
</div>

<style>
    .hotbar>* {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
</style>
{{-- </div> --}}
