<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Livewire::component('address-form', \App\Livewire\AddressForm::class);
    }
}
