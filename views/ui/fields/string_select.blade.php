<div class="col-12 col-md-{{ $col }} mb-4" wire:key="field_{{ $key }}" x-init="console.log($wire.dataEditorFields)"
    x-data="{ edit: $wire.entangle('dataEditorFields.{{ $key }}.flags.edit').defer }">
    <label class="form-label data-label fw-bold text-muted d-flex align-items-end gap-2 justify-content-between"
        for="input_{{ $key }}">
        <span>{{ $label ?? $key }}</span>
        <button @click="edit=!edit;$refs.{{ $key }}_input_.focus();" type="button" class="btn btn-sm btn-light text-muted" wire:key="abtn_{{$key}}_{{$rid}}">
            <i :key="{{ $key }}_input_{{$rid}}" x-show="!edit" class="bi bi-pencil-fill"></i>
            <i :key="{{ $key }}_select_{{$rid}}" x-show="edit" class="bi bi-check-all"></i>
        </button>
    </label>

    <input x-ref='{{ $key }}_input_' :key="{{ $key }}_input_{{$rid}}" x-show="edit" tabindex="0" type="text" class="form-control data-input"
        id="input_{{ $key }}" wire:key='di_{{ $key }}_{{ $rid }}'
        wire:model.defer='dataEditorFields.{{ $key }}.value'
        @error($key) x-init="GraceFullInputErrorFocus($el)" @enderror>
    <select x-ref='{{ $key }}_input_' :key="{{ $key }}_select_{{$rid}}" x-show="!edit" tabindex="0" class="form-select data-input"
        id="input_{{ $key }}" wire:model.defer='dataEditorFields.{{ $key }}.value'>
        @foreach ($opt as $op => $opk)
            <option value="{{ $opk }}">{{ $opk }}</option>
        @endforeach
    </select>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
    <div class="text-dark small mt-1">
        {{ $description }}
    </div>
</div>
