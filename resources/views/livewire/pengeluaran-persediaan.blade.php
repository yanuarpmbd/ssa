<div class="min-w-screen min-h-screenflex items-center justify-center px-32 py-10">
    <div class="bg-gray-100 text-gray-500 rounded-3xl shadow-xl w-full overflow-auto">
        <div class="md:flex w-full">
            <div class="w-full py-10 px-5 md:px-10">
                <div class="text-center mb-10">
                    <div class="justify-center items-center">
                        <img src="{{asset('/images/F.png')}}" width="150px" height="auto" class="mx-auto">
                    </div>
                    <h1 class="font-bold text-3xl text-gray-900">Persediaan</h1>
                    <p>BPK Perwakilan Provinsi Sulawesi Utara</p>
                </div>
                <form wire:submit.prevent="create">
                    {{ $this->form }}
                    <button type="submit" class="block w-full max-w-xs mx-auto bg-amber-500 hover:bg-amber-700 focus:bg-amber-700 text-white rounded-lg px-2 py-2 font-semibold mt-2">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>