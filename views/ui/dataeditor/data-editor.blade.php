<div class="h-100">
    {{-- Because she competes with no one, no one can compete with her. --}}
    @include('glide.header.dash')
    @component('glide.blocks.paper', ['my' => 0])
        <form wire:submit.prevent='save' class="px-2 pt-4" novalidate>
            <div class="row mb-4">
                @if (!empty($title))
                    <div class="col-12 text-muted fw-bold small text-uppercase py-2">
                        {{ $title }}
                    </div>
                @endif
                @foreach ($dataEditorFields as $f)
                    @include('glide.fields.' . $f['type'], $f)
                @endforeach
                <div class="col-12 mt-3 d-flex gap-2">
                    @if ($cancelButton)
                        <button wire:key='bcancel_{{ $rid }}' type="button" wire:click='cancel'
                            class="btn btn-dark text-uppercase d-flex align-items-center animated justify-content-center border-0 px-3 py-2">
                            <small class="small fw-bold">{{ $cancelButton }}</small>
                            <div wire:loading="" wire:target="cancel"
                                class="spinner-border spinner-border-sm mx-1 flex-shrink-0" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    @endif
                    <button wire:key='bsub_{{ $rid }}' type="submit"
                        class="btn btn-primary text-uppercase d-flex align-items-center animated justify-content-center border-0 px-5 py-2">
                        <small class="small fw-bold">{{ $saveButton }}</small>
                        <div wire:loading="" wire:target="save" class="spinner-border spinner-border-sm mx-1 flex-shrink-0"
                            role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>

                </div>
            </div>
        </form>
    @endcomponent

    {{-- {{json_encode($dataEditorFields)}} --}}
</div>
