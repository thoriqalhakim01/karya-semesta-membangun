<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EditUserAddress extends Component
{
    public User $user;

    public $provinceList = [];
    public $cityList     = [];
    public $districtList = [];
    public $villageList  = [];

    public $province    = '';
    public $city        = '';
    public $district    = '';
    public $village     = '';
    public $fullAddress = '';

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->address) {
            $this->province = $this->user->address->province;
        }
        if ($this->user->address->city) {
            $this->city = $this->user->city;
        }
        if ($this->user->address->district) {
            $this->district = $this->user->address->district;
        }
        if ($this->user->address->village) {
            $this->village = $this->user->village;
        }
        if ($this->user->address->full_address) {
            $this->fullAddress = $this->user->address->full_address;
        }

        $this->loadProvinces();

        if ($this->province) {
            $this->loadCities($this->province);
        }
        if ($this->city) {
            $this->loadDistricts($this->city);
        }
        if ($this->district) {
            $this->loadVillages($this->district);
        }
    }

    private function loadProvinces()
    {
        try {
            $response           = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
            $this->provinceList = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $this->provinceList = [];
            session()->flash('error', 'Failed to load provinces');
        }
    }

    private function loadCities($provinceId)
    {
        try {
            $response       = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' . $provinceId . '.json');
            $this->cityList = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $this->cityList = [];
        }
    }

    private function loadDistricts($cityId)
    {
        try {
            $response           = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' . $cityId . '.json');
            $this->districtList = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $this->districtList = [];
        }
    }

    private function loadVillages($districtId)
    {
        try {
            $response          = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' . $districtId . '.json');
            $this->villageList = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $this->villageList = [];
        }
    }

    public function updatedProvince($value)
    {
        $this->city         = '';
        $this->district     = '';
        $this->village      = '';
        $this->cityList     = [];
        $this->districtList = [];
        $this->villageList  = [];

        if ($value) {
            $this->loadCities($value);
        }
    }

    public function updatedCity($value)
    {
        $this->district     = '';
        $this->village      = '';
        $this->districtList = [];
        $this->villageList  = [];

        if ($value) {
            $this->loadDistricts($value);
        }
    }

    public function updatedDistrict($value)
    {
        $this->village     = '';
        $this->villageList = [];

        if ($value) {
            $this->loadVillages($value);
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'province'    => 'required',
            'city'        => 'required',
            'district'    => 'required',
            'village'     => 'required',
            'fullAddress' => 'required|max:255',
        ]);

        $this->user->address()->update([
            'province'     => $validated['province'],
            'city'         => $validated['city'],
            'district'     => $validated['district'],
            'village'      => $validated['village'],
            'full_address' => $validated['fullAddress'],
        ]);

        $this->dispatch('userAddressUpdated');

        $this->modal('edit-user-address')->close();
    }

    public function render()
    {
        return view('livewire.settings.profile.edit-user-address');
    }
}
