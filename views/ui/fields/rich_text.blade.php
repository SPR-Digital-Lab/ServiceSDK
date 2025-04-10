<div class="col-12 col-md-{{ $col }} mb-4 d-flex flex-column">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>
    <div wire:key="input_{{ $key }}_{{$rid}}" id="input_{{ $key }}"
        x-data="{ tc: $wire.entangle('dataEditorFields.{{ $key }}.value').defer }"
         x-init="RichTextEditor($el, (c) => { tc = c })">
        {!! @$dataEditorFields[$key]['value'] !!}
    </div>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
     <div class="text-dark small mt-1">
        {{ $description }}
    </div>
</div>
