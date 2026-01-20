<?php

namespace App\Livewire;

use Livewire\Component;

class LocationSelector extends Component
{
    public $province = '';
    public $district = '';
    public $districts = [];

    public function mount()
    {
        if ($this->province) {
            $this->districts = $this->districtList[$this->province] ?? [];
        }
    }

    public $provinces = [
        'Western',
        'Central',
        'Southern',
        'Northern',
        'Eastern',
        'North Western',
        'North Central',
        'Uva',
        'Sabaragamuwa',
    ];

    public $districtList = [
        'Western' => ['Colombo', 'Gampaha', 'Kalutara'],
        'Central' => ['Kandy', 'Matale', 'Nuwara Eliya'],
        'Southern' => ['Galle', 'Matara', 'Hambantota'],
        'Northern' => ['Jaffna', 'Kilinochchi', 'Mannar', 'Mullaitivu', 'Vavuniya'],
        'Eastern' => ['Trincomalee', 'Batticaloa', 'Ampara'],
        'North Western' => ['Kurunegala', 'Puttalam'],
        'North Central' => ['Anuradhapura', 'Polonnaruwa'],
        'Uva' => ['Badulla', 'Monaragala'],
        'Sabaragamuwa' => ['Ratnapura', 'Kegalle'],
    ];

    public function updatedProvince($value)
    {
        $this->district = '';
        $this->districts = $this->districtList[$value] ?? [];
    }

    public function render()
    {
        return view('livewire.location-selector');
    }
}
