<?php

namespace SPR\ServiceSDK\UI\DataEditor;

use App\Glide\Pages\BasePage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PublicDataEditor extends BasePage
{
   use DataEditorTrait;
   use  WithFileUploads;

   public function mount($uuid = null)
    {
        // dd($uuid);
        $this->UUID = $uuid;
        $this->inSupportWindow = inSupportWindow();
    }

   public function page()
   {
       return view('livewire.glide.data-editor');
   }
}
