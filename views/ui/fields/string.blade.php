<div class="col-12 col-md-{{ $col }} mb-4">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>
    <input tabindex="0" type="text" class="form-control data-input" id="input_{{ $key }}"
        wire:key='di_{{ $key }}_{{ $rid }}'
        wire:model.defer='dataEditorFields.{{ $key }}.value'
        @error($key) x-init="GraceFullInputErrorFocus($el)" @enderror>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
     <div class="text-dark small mt-1">
        {{ $description }}
    </div>
</div>
