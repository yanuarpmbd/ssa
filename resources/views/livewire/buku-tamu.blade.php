<div class="min-w-screen min-h-screen bg-amber-400 flex items-center justify-center px-10 py-10">
    <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-auto">
        <div class="md:flex w-full">
            <div class="hidden md:block w-1/2 bg-gray-200 py-10 px-10">
                <img src="{{asset('/images/lambang-bpk.png')}}" width="100%" height="auto">
            </div>
            <div class="w-full md:w-1/2 py-10 px-5 md:px-10">
                <div class="text-center mb-10">
                    <h1 class="font-bold text-3xl text-gray-900">Buku Tamu</h1>
                    <p>BPK Perwakilan Provinsi Sulawesi Utara</p>
                </div>
                <form wire:submit.prevent="create">
                    {{ $this->form }}
                    <button type="submit" class="block w-full max-w-xs mx-auto bg-amber-500 hover:bg-amber-700 focus:bg-amber-700 text-white rounded-lg px-2 py-2 font-semibold">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>