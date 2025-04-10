<div class="col-12 col-md-{{ $col }} mb-4">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>
    <textarea @if (isset($rows)) rows="{{ $rows }}" @else rows="4" @endif tabindex="0" type="text"
        class="form-control data-input" id="input_{{ $key }}" x-init="tribute_input_{{ $key }}.attach($el)"
        wire:model.defer='dataEditorFields.{{ $key }}.value'>
    </textarea>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
     <div class="text-dark small mt-1">
        {!! $description !!}
    </div>
    <script>
        @php
            $values = [];
            foreach ($opt as $k => $v) {
                $values[] = [
                    'key' => $v,
                    'value' => $k,
                ];
            }
        @endphp
        var tribute_input_{{ $key }} = new Tribute({
            values: @json($values),
            trigger: ':',
        });

    </script>
</div>
