<?php
namespace App\Livewire\Settings\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class UserAddress extends Component
{
    public User $user;

    public $province    = '';
    public $city        = '';
    public $district    = '';
    public $village     = '';
    public $fullAddress = '';

    protected $listeners = ['userAddressUpdated' => 'refreshUser'];

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->address) {
            $this->province    = $this->user->address->province;
            $this->city        = $this->user->address->city;
            $this->district    = $this->user->address->district;
            $this->village     = $this->user->address->village;
            $this->fullAddress = $this->user->address->full_address;
        }
    }

    protected function getRegionName($endpoint, $id = null)
    {
        try {
            $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/{$endpoint}");
            if ($response->successful()) {
                return collect($response->json())
                    ->firstWhere('id', $id ?? $this->province)['name'] ?? '-';
            }
        } catch (\Exception $e) {
            dd($e);
        }
        return '-';
    }

    public function getProvinceName()
    {
        return $this->province ? $this->getRegionName("provinces.json") : '-';
    }

    public function getCityName()
    {
        return $this->city ? $this->getRegionName("regencies/{$this->province}.json", $this->city) : '-';
    }

    public function getDistrictName()
    {
        return $this->district ? $this->getRegionName("districts/{$this->city}.json", $this->district) : '-';
    }

    public function getVillageName()
    {
        return $this->village ? $this->getRegionName("villages/{$this->district}.json", $this->village) : '-';
    }

    public function refreshUser()
    {
        $this->user->refresh();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.settings.profile.user-address');
    }
}
