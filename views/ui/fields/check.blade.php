<div class="col-12 col-md-{{ $col }} mb-4 py-2">
    <div class="form-check d-flex align-items-center">
        <input style="width: 1rem;height: 1rem;" class="form-check-input" type="checkbox" wire:model.defer='dataEditorFields.{{ $key }}.value'
            id="di_{{ $key }}_{{ $rid }}" wire:key='di_{{ $key }}_{{ $rid }}'>
        <label class="form-check-label pt-1 px-1 " for="di_{{ $key }}_{{ $rid }}">
            {{ @$label ?? @$key }} <br>
        </label>
    </div>
    <div class="form-text small">
        {{ @$description }}
    </div>
</div>
