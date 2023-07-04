<x-filament::page>
  <div class="bg-white dark:bg-gray-900 shadow overflow-hidden sm:rounded-lg">
    <div class="border-t border-gray-200 dark:bg-gray-900">
      <dl>
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Kode Klasifikasi</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->jenisArsip->kode_arsip}}</dd>
        </div>
        <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Unit Kerja</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->unitKerja->nama_unit_kerja}}</dd>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Nama Dokumen</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->nama_arsip}}</dd>
        </div>
        <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Jenis Arsip</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->jenisArsip->jenis_arsip}}</dd>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Rak</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->rak->nama_rak}}</dd>
        </div>
        <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Dus</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->dus->nama_dus}}</dd>
        </div>
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Tahun</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->tahun>}}</dd>
        </div> 
        <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Tingkat Perkembangan</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->tingkat_perkembangan}}</dd>
        </div> 
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Status Arsip</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->status_arsip}}</dd>
        </div>
        <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Deskripsi</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->deskripsi}}</dd>
        </div> 
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Tanggal Upload</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->created_at}}</dd>
        </div> 
        <div class="bg-white dark:bg-gray-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">Dilihat</dt>
          <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">{{$this->record->getCounterValue('number_of_arsip_views')}} Kali</dd>
        </div> 
        <div class="bg-gray-50 dark:bg-gray-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500 dark:text-white">File Download</dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
              <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                <div class="w-0 flex-1 flex items-center">
                  <!-- Heroicon name: solid/paper-clip -->
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                  </svg>
                  <span class="ml-2 flex-1 w-0 truncate dark:text-white">{{$this->record->upload_arsip}}</span>
                </div>
                <div class="ml-4 flex-shrink-0">
                <button wire:click="download" type="button" class="font-medium text-primary-700 hover:text-primary-500">Download</button>
                </div>
              </li>
            </ul>
          </dd>
        </div>
      </dl>
    </div>
    <div class="relative" style="padding-top: 56.25%">
      <iframe class="absolute inset-0 w-full h-full" src="{{asset('storage/'. $this->record->upload_arsip)}}#view=FitH" frameborder="0" …></iframe>
    </div>
  </div>
</x-filament::page>
