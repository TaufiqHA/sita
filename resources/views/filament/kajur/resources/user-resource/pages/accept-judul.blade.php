<x-filament-panels::page>
    {{ $this->judulInfolist }}

    <x-filament-panels::form wire:submit='save'>
        {{ $this->form }}
        <x-filament-panels::form.actions 
            :actions="$this->getFormActions()"
        />
    </x-filament-panels>
</x-filament-panels::page>
