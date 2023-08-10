<x-filament::page class="filament-resources-list-records-page">
    {{ $this->table }}
    @if(auth()->user()->email == 'admin@admin.com' or 'admin@arsip.sulut.bpk.go.id')
    <x-filament::button wire:click="updateRetensi">Update Retensi</x-filament::button>
    <x-filament::button wire:click="generateQR">QR</x-filament::button>
    @else
    @endif
</x-filament::page>
