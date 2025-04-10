<div class="col-12 col-md-{{ $col }} mb-4">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>
    <input tabindex="0" type="number" class="form-control data-input" id="input_{{ $key }}"
        wire:model.defer='dataEditorFields.{{ $key }}.value' @if (isset($focus) && $focus) x-init="$el.focus()" @endif>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
     <div class="text-dark small mt-1">
        {{ $description }}
    </div>
</div>
