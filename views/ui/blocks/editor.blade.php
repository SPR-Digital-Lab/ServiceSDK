@if (isset($this) && isset($this->__editorDialog) && $this->__editorDialog)
    @component($this->__editorDialog['dialog'])
        @slot('title', $this->__editorDialog['title'])
        @slot('description', $this->__editorDialog['description'])
        @slot('submit', $this->__editorDialog['validator'])
        @slot('actions')
            <button class="btn btn-sm btn-success text-uppercase fw-bold d-flex align-items-center px-3" type="submit">
                <small wire:loading.attr="hidden" wire:target="{{ $this->__editorDialog['validator'] }}" class='py-1'>confirm</small>
                <div wire:loading="" wire:target="{{ $this->__editorDialog['validator'] }}"
                    class="spinner-border spinner-border-sm mx-2 my-1" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
            <button x-init='EscapeButton($el)' wire:click="clearEditorDialog" 
                class="btn btn-sm btn-light text-uppercase fw-bold d-flex align-items-center px-3" type="button">
                <small wire:loading.attr="hidden" wire:target="clearEditorDialog" class="py-1">cancel</small>
                <div wire:loading="" wire:target="clearEditorDialog" class="spinner-border spinner-border-sm mx-2 my-1"
                    role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        @endslot
        @foreach ($this->__editorDialog['fields'] as $f)
            @if ($loop->first)
                @php
                    $f['focus'] = true;
                @endphp
            @endif
            @include('glide.fields.' . $f['type'], $f)
        @endforeach
    @endcomponent
@endif
