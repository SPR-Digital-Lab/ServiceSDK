<div class="col-12 col-md-{{ $col }} mb-4 px-3 py-1 shadow-sm rounded border">
    {{-- @isset($label) --}}
    <div class="text-dark text-uppercase mt-2 d-flex align-items-center">
        {{-- <i class="bi {{ @$icon ?? 'bi bi-star-fill' }} text-primary"></i> --}}
        <b class="small text-primary">
            {{ $label ?? $key }}
        </b>
    </div>
    <div class="text-dark small">
        {{ $description }}
    </div>
    {{-- @endisset --}}
    @isset($opt)
        @if (count($opt) == 0)
            @include('glide.blocks.empty')
        @endif
        @foreach ($opt as $k => $v)
            <div
                class="@if (!$loop->last) border-bottom @endif d-flex justify-content-between align-items-center py-2 px-1">
                <div class="small text-uppercase text-muted fw-bold pe-2 flex-shrink-0">
                    {!! str_replace('_', ' ', $k) !!}
                </div>

                @if (is_array($v))
                    <div class="fw-bold text-end flex-grow-1 border-start">
                        @include('glide.spark.basic_details', ['data' => $v])
                    </div>
                @elseif ($v)
                    <div class="fw-bold small text-end flex-grow-1">
                        {!! $v !!}
                    </div>
                @else
                    <div class="fw-bold small text-end flex-grow-1">
                        <i class="text-muted">Not Provided</i>
                    </div>
                @endif

            </div>
        @endforeach
    @endisset
    @error($key)
        <div class="form-text text-danger fw-bold text-uppercase px-1 mt-1">
            {{ $message }}
        </div>
    @enderror
</div>
