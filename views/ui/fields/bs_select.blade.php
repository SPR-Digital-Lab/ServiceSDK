<div class="col-12 col-md-{{ $col }} mb-4" id="input_{{ $key }}_base"
    wire:key="input_{{ $key }}_{{ $rid }}_base">
    <div class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </div>
    @if (@$flags['explicit'])
        <style>
            .bootstrap-select .dropdown-toggle .filter-option {
                white-space: pre-line !important;
            }
        </style>
    @endif
    <select tabindex="0" id="input_{{ $key }}" data-width="auto" class="w-100 btn p-0 border"
        @if (@$flags['multiple']) multiple @if (!@$flags['explicit']) data-selected-text-format="count > 1" @endif
        @endif
        wire:model.defer='dataEditorFields.{{ $key }}.value'
        wire:key="input_{{ $key }}_{{ $rid }}" x-init="$('#input_{{ $key }}').selectpicker({ liveSearch: true, @if (@$flags['explicit']) multipleSeparator: '\n', @endif dropupAuto: false, width: '100%', style: 'btn-light px-3 py-2' });">
        @if (@$flags['grouped'])
            {{ dd(collect($opt)->groupBy('groupBy')) }}
        @else
            @foreach ($opt as $k => $op)
                <option title="{{ @$op['title'] ?? @$op['label'] }}" data-subtext="{!! @$op['description'] !!}"
                    value="{{ $k }}">
                    {{ @$op['label'] }}</option>
            @endforeach

        @endif
    </select>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
    <div class="text-dark small mt-1">
        {!! $description !!}
    </div>
    <style>
        .dropdown-menu.show {
            width: 100% !important;
        }
    </style>
</div>
