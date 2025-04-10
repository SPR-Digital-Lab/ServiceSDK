<div class="col-12 col-md-{{ $col }} mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
            {{ $label ?? $key }}
        </label>
        <div wire:loading="" wire:target="dataEditorFiles.{{ $key }}"
            class="spinner-border spinner-border-sm flex-shrink-0" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    @if (@$dataEditorFiles[$key])
        <div class="d-flex justify-content-between align-items-center">
            <div class="pe-2">
                {{ $dataEditorFiles[$key]->getClientOriginalName() }}
            </div>
            <button type="button" wire:click="removeDataFile('{{ $key }}')"
                class="btn btn-light d-flex align-items-center text-uppercase fw-bold small btn-sm border">
                <span class="small fw-bold px-2">
                    <i class="bi bi-trash-fill"></i>
                </span>
            </button>
        </div>
    @else
        <input tabindex="0" type="file" class="form-control data-input" id="input_{{ $key }}"
            wire:key='di_{{ $key }}_{{ $rid }}' wire:model.defer='dataEditorFiles.{{ $key }}'
            @if (isset($focus) && $focus) x-init="$el.focus()" @endif>
    @endif
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
     <div class="text-dark small mt-1">
        {!! $description !!}
    </div>
</div>
