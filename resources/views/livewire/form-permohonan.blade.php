<div class=" mx-auto p-6  bg-teal-900 rounded-lg shadow-md">
    <h2 class="text-2xl text-white font-semibold mb-4">Formulir Permohonan</h2>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form -->
    <form wire:submit.prevent="submit" class="">

        <!-- Data Pemohon -->
        <div class="p-4 rounded-lg shadow-md bg-white">
            <h3 class="text-lg font-semibold">Data Pemohon</h3>
            <p class="text-sm text-gray-600 mb-4">Silakan isi data pemohon dengan benar.</p>
            {{-- <div class="grid grid-cols-2 gap-4"> --}}
            <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="pemohon_nama" class="block text-sm/6 font-medium text-gray-900">Nama <span
                            class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" wire:model="pemohon_nama"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            placeholder="Nama">
                        @error('pemohon_nama')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="pemohon_hp_telepon" class="block text-sm/6 font-medium text-gray-900">No Hp (Whatsapp) <span
                            class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" wire:model="pemohon_hp_telepon" oninput="validatePhoneNumber(this)"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            placeholder="Contoh: 081234567890">
                        @error('pemohon_hp_telepon')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <p id="phone-error" class="text-red-500"></p>
                    </div>
                </div>
                <script>
                    function validatePhoneNumber(input) {
                        let value = input.value;
                        let errorText = document.getElementById('phone-error');
                
                        if (!/^0\d{9,14}$/.test(value)) {
                            errorText.textContent = "Nomor telepon harus diawali dengan 0 dan memiliki 10-15 digit.";
                        } else {
                            errorText.textContent = "";
                        }
                    }
                </script>

                <div class="sm:col-span-2">
                    <label for="pemohon_email" class="block text-sm/6 font-medium text-gray-900">Email <span
                            class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="email" wire:model="pemohon_email"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            placeholder="Email">
                        @error('pemohon_email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="pemohon_warga_blok" class="block text-sm/6 font-medium text-gray-900">Warga
                        Blok/Pepanthan <span class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <input type="text" wire:model="pemohon_warga_blok"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            placeholder="Warga Blok">
                        @error('pemohon_warga_blok')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <label for="pemohon_alamat" class="block text-sm/6 font-medium text-gray-900">Alamat <span
                            class="text-red-500">*</span></label>
                    <div class="mt-2">
                        <textarea wire:model="pemohon_alamat"
                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            placeholder="Alamat"></textarea>
                        @error('pemohon_alamat')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Jenis Permohonan -->
        <div class="p-4 rounded-lg shadow-md mt-5 bg-white">
            <h3 class="text-lg font-semibold">Form Permohonan</h3>
            <p class="text-sm text-gray-600 mb-4">Silakan isi data permohonan dengan benar.</p>
            {{-- <div class="grid grid-cols-2 gap-4"> --}}
            <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">

                <div class="sm:col-span-6">
                    <label for="jenis_permohonan" class="block text-sm font-medium text-gray-900">Jenis Permohonan
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($forms as $form)
                            <button type="button" wire:click="$set('form_id', {{ $form->id }})"
                                class="px-4 py-2 rounded-md border cursor-pointer hover:text-gray-900 hover:bg-lime-500 hover:border-lime-500 rounded-full transition duration-200 flex-auto
                                       {{ $form_id == $form->id ? 'bg-teal-900 text-white' : 'bg-white' }}">
                                {{ $form->name }}
                            </button>
                        @endforeach
                    </div>
                    @error('form_id')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Animasi Loading -->
                <div wire:loading wire:target="form_id" class="mt-2 text-center text-gray-600 sm:col-span-6">
                    <svg class="animate-spin h-6 w-6 text-teal-900 mx-auto" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <p>Memuat daftar formulir...</p>
                </div>

                @if ($form_id)
                    <div wire:loading.remove wire:target="form_id" class="sm:col-span-6">
                        <h4 class="text-md font-semibold">Surat Permohonan</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2">
                            @foreach ($pertanyaans as $pertanyaan)
                                @if ($pertanyaan->tipe_jawaban === 'header')
                                    {{-- <div class="sm:col-span-3">
                                        <h4 class="text-lg font-semibold text-gray-700">{{ $pertanyaan->pertanyaan }}
                                        </h4>
                                    </div> --}}
                                    <div class="sm:col-span-3">
                                        <label>{{ $pertanyaan->pertanyaan }}</label>
                                    </div>
                                @else
                                    <div class="sm:col-span-1">
                                        <label class="block text-gray-700 font-medium">{{ $pertanyaan->pertanyaan }}
                                            @if ($pertanyaan->required)
                                                <span class="text-red-500">*</span>
                                            @endif
                                        </label>

                                        <div class="mt-2">
                                            @if ($pertanyaan->tipe_jawaban === 'text')
                                                <input type="text" wire:model="answers.{{ $pertanyaan->order }}"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                                            @elseif ($pertanyaan->tipe_jawaban === 'textarea')
                                                <textarea wire:model="answers.{{ $pertanyaan->order }}"
                                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                                            </textarea>
                                            @elseif (in_array($pertanyaan->tipe_jawaban, ['select', 'checkbox', 'radio']))
                                                @php
                                                    // $opsi_jawaban = json_decode($pertanyaan->opsi_jawaban, true) ?? [];
                                                    $opsi_jawaban = $pertanyaan->opsi_jawaban ?? [];
                                                    // print_r($opsi_jawaban );
                                                @endphp

                                                @if ($pertanyaan->tipe_jawaban === 'select')
                                                    <select wire:model="answers.{{ $pertanyaan->order }}"
                                                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                                                        <option value="">Pilih salah satu</option>
                                                        @foreach ($opsi_jawaban as $option)
                                                            <option value="{{ $option['label'] }}"> {{ $option['label'] }}</option>
                                                        @endforeach
                                                    </select>
                                                @elseif ($pertanyaan->tipe_jawaban === 'checkbox')
                                                    @foreach ($opsi_jawaban as $option)
                                                        <div class="flex items-center">
                                                            <input type="checkbox" wire:model="answers.{{ $pertanyaan->order }}" value="{{ $option['label'] }}" class="mr-2">
                                                            <span>{{ $option['label'] }}</span>
                                                        </div>
                                                    @endforeach
                                                @elseif ($pertanyaan->tipe_jawaban === 'radio')
                                                    @foreach ($opsi_jawaban as $option)
                                                        <div class="flex items-center">
                                                            <input type="radio" wire:model="answers.{{ $pertanyaan->order }}" value="{{ $option['label'] }}" class="mr-2">
                                                            <span>{{ $option['label'] }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            @endif

                                            @error('answers.'. $pertanyaan->order)
                                                <p class="text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- <label for="" class="block text-sm/6 font-medium text-gray-900 mt-3">
                            Unggah Dokumen
                        </label> --}}
                        <h4 class="text-md font-semibold mt-8">Unggah Dokumen</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2">
                            @foreach ($listUploads as $upload)
                                <div class="sm:col-span-1">
                                    <label class="block text-gray-700 font-medium">{{ $upload->name }}
                                        @if ($upload->is_required)
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>

                                    <x-filepond::upload wire:model="uploadedFiles.{{ $upload->id }}"
                                        acceptedFileTypes="{{ $upload->upload_type === 'pdf' ? 'application/pdf' : 'image/*' }}"
                                        {{-- accepted=".pdf" --}} max-file-size="2MB" />

                                    <p class="text-xs text-gray-500">
                                        Format: {{ $upload->upload_type === 'pdf' ? 'PDF' : 'JPG, JPEG, PNG' }}, Maks:
                                        2MB
                                    </p>
                                    @error('uploadedFiles.' . $upload->id)
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        {{-- Error untuk seluruh file upload jika ada --}}
                        {{-- @error('uploadedFiles')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror --}}
                    </div>
                @endif


            </div>
        </div>


        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit"
                class="rounded-lg text-teal-900 border border-lime-500 hover:border-white 
                bg-lime-500 hover:bg-white transition duration-200 
                px-4 py-2 text-md font-bold shadow-md focus:outline-none focus:ring-2 
                focus:ring-lime-500 focus:ring-offset-2 cursor-pointer">
                <span wire:loading.remove wire:target="submit">Submit</span>
                <span wire:loading wire:target="submit">Loading...</span>
            </button>
        </div>
        {{-- <div wire:loading class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <p class="text-lg font-semibold text-gray-800">Sedang menyimpan...</p>
            </div>
        </div> --}}

    </form>
</div>
