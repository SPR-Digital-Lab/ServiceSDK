<div class="col-12 mb-2 d-flex justify-content-between">
    <div class="border-primary border-start border-5 px-4 flex-grow-1 bg-primary-subtle text-primary-emphasis py-3">
        <i class="bi bi-exclamation-circle-fill"></i>
        <label class="text-uppercase px-1 fs-6 fw-bold mb-0 mt-2" for="input_{{ $key }}">
            {{ $label ?? $key }}
        </label>
        <div class="small mt-1">
            {!! $description !!}
        </div>
    </div>

    {{-- <a href="{{ $dataEditorFields[$key]['value'] }}"
        class="btn btn-dark d-flex align-items-center text-uppercase fw-bold small btn-sm">
        <span class="small fw-bold px-2">Go</span>
    </a> --}}
</div>
