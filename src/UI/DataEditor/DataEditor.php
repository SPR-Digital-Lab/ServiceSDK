<?php

namespace SPR\ServiceSDK\UI\DataEditor;


use Livewire\WithFileUploads;
use SPR\ServiceSDK\UI\Pages\DashPage;

class DataEditor extends DashPage implements DataEditorTypes
{
    use DataEditorTrait;
    use WithFileUploads;


    public function mount($uuid = null)
    {
        
        $this->UUID = $uuid;
        
    }

    public function page()
    {
        return view('livewire.glide.data-editor');
    }
}
