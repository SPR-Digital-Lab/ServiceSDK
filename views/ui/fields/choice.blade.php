<div class="col-12 col-md-{{ $col }} mb-4" x-data="window.io_choice_{{ $key }}($wire)"
    wire:key="field_{{ $key }}_{{ $rid }}">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>
    <script>
        window.io_choice_{{ $key }} = ($wire) => {
            return {
                el: null,
                value: $wire.entangle('dataEditorFields.{{ $key }}.value').defer,
                start($el) {
                    console.log('cj',$el);
                    this.el = new Choices($el);
                    @if ($value)
                    this.el.setChoiceByValue('{{$value}}')
                    @endif
                    $el.addEventListener(
                        'choice',
                        (event) => {
                            this.value = event.detail.choice.value;
                        },
                        false,
                    );
                }
            }
        }
    </script>
    {{-- <input x-ref="input_{{ $key }}_ref" wire:model.defer='dataEditorFields.{{ $key }}.value'> --}}
    <select tabindex="0" class="form-select data-input" id="input_{{ $key }}"
        x-init="start($el)" wire:key="select_{{ $key }}_{{ $rid }}">
        <option value="">Choose an option</option>
        @foreach ($opt as $i => $op)
            <option value="{{ $i }}">{{ $op }}</option>
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
