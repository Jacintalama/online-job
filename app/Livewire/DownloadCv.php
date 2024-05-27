<?php

namespace App\Livewire;

use Livewire\Component;

class DownloadCv extends Component
{
    public $filename;
    public function download()
    {
        return response()->download(storage_path("app/cvs/{$this->filename}"));
    }
    public function render()
    {
        return view('livewire.download-cv');
    }
}
