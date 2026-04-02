<?php

namespace App\Livewire;

use Livewire\Component;

class Map extends Component
{
    public $latitude = 24.7136;
    public $longitude = 46.6753;
    public $address = '';
    public $zoom = 12;
    public $apiKey;

    public function mount()
    {
        $this->apiKey = config('services.google.maps_api_key');
    }

    public function updatedLocation($lat, $lng, $address = '')
    {
        $this->latitude = $lat;
        $this->longitude = $lng;
        $this->address = $address;

        $this->emit('locationUpdated', [
            'lat' => $lat,
            'lng' => $lng,
            'address' => $address
        ]);
    }
    public function render()
    {
        return view('livewire.map');
    }
}
