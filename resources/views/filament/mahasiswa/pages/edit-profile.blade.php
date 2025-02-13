<x-filament-panels::page>
    <x-filament-panels::form wire:submit="updateProfile">
        {{ $this->editProfileForm }}
        <x-filament-panels::form.actions 
            :actions="$this->getUpdateProfileFormActions()"
        />
    </x-filament-panels::form>
    <x-filament-panels::form wire:submit="updateInfoMahasiswa">
        {{ $this->informasiMahasiswaForm }}
        <x-filament-panels::form.actions 
            :actions="$this->getInformasiMahasiswaFormActions()"
        />
    </x-filament-panels::form>
    <x-filament-panels::form wire:sumbit="updatePassword">
        {{ $this->editPasswordForm }}
        <x-filament-panels::form.actions 
            :actions="$this->getUpdatePasswordFormActions()"
        />
    </x-filament-panels::form>
</x-filament-panels::page>