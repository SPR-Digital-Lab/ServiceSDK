@if (isset($this) && isset($this->__confirmation) && $this->__confirmation)
    @component('sdk:ui.blocks.dialog')
        @slot('title', $this->__confirmation['title'])
        @slot('description', $this->__confirmation['description'])
        @slot('submit', $this->__confirmation['success'])
        @slot('actions')
            <button class="btn btn-sm btn-success text-uppercase fw-bold d-flex"
                type="submit">
                <small wire:loading.attr="hidden" wire:target="{{$this->__confirmation['success']}}">confirm</small>
                <div wire:loading="" wire:target="{{$this->__confirmation['success']}}" class="spinner-border spinner-border-sm mx-2 my-1"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
            <button wire:click="clearConfirmation" class="btn btn-sm btn-light text-uppercase fw-bold d-flex"
                type="button">
                <small wire:loading.attr="hidden" wire:target="clearConfirmation">cancel</small>
                <div wire:loading="" wire:target="clearConfirmation" class="spinner-border spinner-border-sm mx-2 my-1"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        @endslot
    @endcomponent
@endif
