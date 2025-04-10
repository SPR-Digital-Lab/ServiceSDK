<div class="col-12 col-md-{{ $col }} my-2 border-bottom py-2">
    <div class=" d-flex justify-content-between">
        <div class="flex-grow-1 pe-2">
            <b>{{ @$label ?? @$key }} </b><br>
            {{ @$description }}
        </div>
        <input tabindex="0" type="text" class="form-control form-control-sm data-input w-25"
            id="input_{{ $key }}" wire:key='di_{{ $key }}_{{ $rid }}'
            wire:model.defer='dataEditorFields.{{ $key }}.value'
            @if (isset($focus) && $focus) x-init="$el.focus()" @endif>
    </div>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
</div>
