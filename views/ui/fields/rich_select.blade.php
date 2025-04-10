<div class="col-12 col-md-{{ $col }} mb-4">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>


    <select tabindex="0" class="form-select data-input" id="input_{{ $key }}"
        wire:model.defer='dataEditorFields.{{ $key }}.value'>
        @if (isAssoc($opt))
            @foreach ($opt as $k => $op)
                <option value="{{ $k }}">{{ $op }}</option>
            @endforeach
        @else
            @foreach ($opt as $op => $opk)
                <option value="{{ $opk }}">{{ $opk }}</option>
            @endforeach
        @endif
    </select>

    <br><br>

    <textarea @if(isset($rows)) rows="{{ $rows }}" @else rows="4" @endif tabindex="0" type="text"
        class="form-control data-input" id="input_{{ $key }}"
        wire:model.defer='dataEditorFields.{{ $key }}.value'>
    </textarea>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
     <div class="text-dark small mt-1">
        {{ $description }}
    </div>
</div>
