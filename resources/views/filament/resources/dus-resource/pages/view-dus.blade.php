<x-filament::page
    :widget-data="['record' => $record]"
    :class="\Illuminate\Support\Arr::toCssClasses([
        'filament-resources-view-record-page',
        'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
        'filament-resources-record-' . $record->getKey(),
    ])"
>

    <div class="flex">
        <img src="{{asset('/storage'.$this->record->qr_path)}}" onerror="this.onrror=null; this.src='{{asset('/images/lambang-bpk.png')}}'" width="80" height="100">
        @if(auth()->user()->roles[0]->name == 'super_admin')
        <div class="ml-4 flex-col flex-shrink-0">
            <div class="pb-3">
                <x-filament-support::button
                wire:click="generateQr"
                :dark-mode="config('filament.dark_mode')"
                >
                    Generate QR Code
                </x-filament-support::button>
            </div>
            <div class="pt-3">
                <x-filament-support::button
                wire:click="qr"
                :dark-mode="config('filament.dark_mode')"
                >
                    Download QR Code
                </x-filament-support::button>
            </div>
        </div>
        @else
        @endif
    </div>
    
    @php
        $relationManagers = $this->getRelationManagers();
    @endphp

    @if ((! $this->hasCombinedRelationManagerTabsWithForm()) || (! count($relationManagers)))
        {{ $this->form }}
    @endif

    @if (count($relationManagers))
        @if (! $this->hasCombinedRelationManagerTabsWithForm())
            <x-filament::hr />
        @endif

        <x-filament::resources.relation-managers
            :active-manager="$activeRelationManager"
            :form-tab-label="$this->getFormTabLabel()"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        >
            @if ($this->hasCombinedRelationManagerTabsWithForm())
                <x-slot name="form">
                    {{ $this->form }}
                </x-slot>
            @endif
        </x-filament::resources.relation-managers>
    @endif
</x-filament::page>



