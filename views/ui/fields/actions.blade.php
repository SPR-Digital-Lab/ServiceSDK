<div class="col-12 col-md-{{ $col }} mb-4">
    <label class="form-label data-label fw-bold text-muted" for="input_{{ $key }}">
        {{ $label ?? $key }}
    </label>
    <div class="d-flex gap-2 flex-wrap">
        @foreach ($opt as $b => $l)
            <button wire:click={{ $l }}
                class="btn btn-sm btn-light border text-uppercase fw-bold d-flex align-items-center px-3" type="button">
                <small class='py-1'>{{ $b }}</small>
                <div wire:loading="" wire:target="{{ $l }}" class="spinner-border spinner-border-sm mx-2 my-1"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        @endforeach
    </div>
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase">
            {{ $message }}
        </div>
    @enderror
    <div class="text-dark small mt-1">
        {{ $description }}
    </div>
</div>
