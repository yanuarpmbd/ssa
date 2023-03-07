<x-filament::widget class="filament-filament-info-widget">
    <x-filament::card class="relative">
        <div class="relative flex flex-col space-y-2">
            <div class="space-y-1">
                <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                    Sistem Online Pelayanan Umum Terpadu dalam genggamAN<br>
                </h2>
                <a
                    href="{{ asset('/images/Manual Book E-Arsip BPK Sulut.pdf') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    @class([
                        'flex items-end space-x-2 rtl:space-x-reverse text-gray-800 hover:text-primary-500 transition',
                        'dark:text-gray-100 dark:hover:text-primary-500' => config('filament.dark_mode'),
                    ])
                >
                    <p class="text-sm">Panduan Penggunaan</p>
                </a>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>