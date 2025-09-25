<div class=" mx-auto">
    <div class="max-w-2xl mx-auto text-center mb-20">
        <h1 class="font-heading text-5xl sm:text-6xl tracking-xs text-white mb-6">Formulir Permohonan</h1>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- Form -->
    <form wire:submit.prevent="submit" class="">
        {{-- Step Indicator --}}
        <div class="overflow-y-auto">
            <div class=" px-4 max-w-2xl mx-auto space-y-6">
                <div class="flex justify-between items-center mb-6">
                    @foreach ([1 => 'Pemohon', 2 => 'Permohonan', 3 => 'Pengisian', 4 => 'Unggah Dokumen', 5 => 'Konfirmasi'] as $index => $label)
                        <div
                            class="px-4 flex flex-col items-center text-sm {{ $currentStep === $index ? 'text-white font-bold' : 'text-white' }}">
                            <div
                                class="w-8 h-8 rounded-full border-2 flex items-center justify-center {{ $currentStep >= $index ? 'border-white' : 'border-white' }}">
                                {{ $index }}
                            </div>
                            <span class="mt-1">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Data Pemohon -->
        @if ($currentStep === 1111)
            <div class="p-4 rounded-lg shadow-md bg-white">

                <input type="file" wire:model="uploadedFilesa.1"
                    class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                      file:bg-gray-50 file:border-0
                      file:me-4
                      file:py-3 file:px-4
                     ">

                <!-- Spinner saat upload -->
                <div wire:loading wire:target="uploadedFilesa.1" class="w-full grid gap-1 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span class="text-sm text-gray-600">Unggah file...</span>
                    </div>
                </div>


                @if ($uploadedFilesa[1] ?? false)
                    <div wire:loading.remove wire:target="uploadedFilesa.1" class="w-full grid gap-1 mt-4">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                    viewBox="0 0 40 40" fill="none">
                                    <g id="File">
                                        <path id="icon"
                                            d="M31.6497 10.6056L32.2476 10.0741L31.6497 10.6056ZM28.6559 7.23757L28.058 7.76907L28.058 7.76907L28.6559 7.23757ZM26.5356 5.29253L26.2079 6.02233L26.2079 6.02233L26.5356 5.29253ZM33.1161 12.5827L32.3683 12.867V12.867L33.1161 12.5827ZM31.8692 33.5355L32.4349 34.1012L31.8692 33.5355ZM24.231 11.4836L25.0157 11.3276L24.231 11.4836ZM26.85 14.1026L26.694 14.8872L26.85 14.1026ZM11.667 20.8667C11.2252 20.8667 10.867 21.2248 10.867 21.6667C10.867 22.1085 11.2252 22.4667 11.667 22.4667V20.8667ZM25.0003 22.4667C25.4422 22.4667 25.8003 22.1085 25.8003 21.6667C25.8003 21.2248 25.4422 20.8667 25.0003 20.8667V22.4667ZM11.667 25.8667C11.2252 25.8667 10.867 26.2248 10.867 26.6667C10.867 27.1085 11.2252 27.4667 11.667 27.4667V25.8667ZM20.0003 27.4667C20.4422 27.4667 20.8003 27.1085 20.8003 26.6667C20.8003 26.2248 20.4422 25.8667 20.0003 25.8667V27.4667ZM23.3337 34.2H16.667V35.8H23.3337V34.2ZM7.46699 25V15H5.86699V25H7.46699ZM32.5337 15.0347V25H34.1337V15.0347H32.5337ZM16.667 5.8H23.6732V4.2H16.667V5.8ZM23.6732 5.8C25.2185 5.8 25.7493 5.81639 26.2079 6.02233L26.8633 4.56274C26.0191 4.18361 25.0759 4.2 23.6732 4.2V5.8ZM29.2539 6.70608C28.322 5.65771 27.7076 4.94187 26.8633 4.56274L26.2079 6.02233C26.6665 6.22826 27.0314 6.6141 28.058 7.76907L29.2539 6.70608ZM34.1337 15.0347C34.1337 13.8411 34.1458 13.0399 33.8638 12.2984L32.3683 12.867C32.5216 13.2702 32.5337 13.7221 32.5337 15.0347H34.1337ZM31.0518 11.1371C31.9238 12.1181 32.215 12.4639 32.3683 12.867L33.8638 12.2984C33.5819 11.5569 33.0406 10.9662 32.2476 10.0741L31.0518 11.1371ZM16.667 34.2C14.2874 34.2 12.5831 34.1983 11.2872 34.0241C10.0144 33.8529 9.25596 33.5287 8.69714 32.9698L7.56577 34.1012C8.47142 35.0069 9.62375 35.4148 11.074 35.6098C12.5013 35.8017 14.3326 35.8 16.667 35.8V34.2ZM5.86699 25C5.86699 27.3344 5.86529 29.1657 6.05718 30.593C6.25217 32.0432 6.66012 33.1956 7.56577 34.1012L8.69714 32.9698C8.13833 32.411 7.81405 31.6526 7.64292 30.3798C7.46869 29.0839 7.46699 27.3796 7.46699 25H5.86699ZM23.3337 35.8C25.6681 35.8 27.4993 35.8017 28.9266 35.6098C30.3769 35.4148 31.5292 35.0069 32.4349 34.1012L31.3035 32.9698C30.7447 33.5287 29.9863 33.8529 28.7134 34.0241C27.4175 34.1983 25.7133 34.2 23.3337 34.2V35.8ZM32.5337 25C32.5337 27.3796 32.532 29.0839 32.3577 30.3798C32.1866 31.6526 31.8623 32.411 31.3035 32.9698L32.4349 34.1012C33.3405 33.1956 33.7485 32.0432 33.9435 30.593C34.1354 29.1657 34.1337 27.3344 34.1337 25H32.5337ZM7.46699 15C7.46699 12.6204 7.46869 10.9161 7.64292 9.62024C7.81405 8.34738 8.13833 7.58897 8.69714 7.03015L7.56577 5.89878C6.66012 6.80443 6.25217 7.95676 6.05718 9.40704C5.86529 10.8343 5.86699 12.6656 5.86699 15H7.46699ZM16.667 4.2C14.3326 4.2 12.5013 4.1983 11.074 4.39019C9.62375 4.58518 8.47142 4.99313 7.56577 5.89878L8.69714 7.03015C9.25596 6.47133 10.0144 6.14706 11.2872 5.97592C12.5831 5.8017 14.2874 5.8 16.667 5.8V4.2ZM23.367 5V10H24.967V5H23.367ZM28.3337 14.9667H33.3337V13.3667H28.3337V14.9667ZM23.367 10C23.367 10.7361 23.3631 11.221 23.4464 11.6397L25.0157 11.3276C24.9709 11.1023 24.967 10.8128 24.967 10H23.367ZM28.3337 13.3667C27.5209 13.3667 27.2313 13.3628 27.0061 13.318L26.694 14.8872C27.1127 14.9705 27.5976 14.9667 28.3337 14.9667V13.3667ZM23.4464 11.6397C23.7726 13.2794 25.0543 14.5611 26.694 14.8872L27.0061 13.318C26.0011 13.1181 25.2156 12.3325 25.0157 11.3276L23.4464 11.6397ZM11.667 22.4667H25.0003V20.8667H11.667V22.4667ZM11.667 27.4667H20.0003V25.8667H11.667V27.4667ZM32.2476 10.0741L29.2539 6.70608L28.058 7.76907L31.0518 11.1371L32.2476 10.0741Z"
                                            fill="#4F46E5" />
                                    </g>
                                </svg>
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path id="icon"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                        stroke="#4F46E5" stroke-width="1" stroke-linecap="round" />
                                </svg>
                                <div class="grid gap-1">
                                    <h4 class="text-gray-900 text-sm font-normal leading-snug">
                                        {{ $uploadedFilesa[1]->getClientOriginalName() }}</h4>
                                    <h5 class="text-gray-400   text-xs font-normal leading-[18px]">Upload complete</h5>
                                </div>
                            </div>

                        </div>

                        {{-- <div class="relative flex items-center gap-2.5 py-1.5">
                            <div class="relative  w-full h-2.5  overflow-hidden rounded-3xl bg-gray-100">
                                <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 100%"
                                    class="flex h-full items-center justify-center bg-indigo-600  text-white rounded-3xl">
                                </div>
                            </div>
                            <span
                                class="ml-2 bg-white  rounded-full  text-gray-800 text-xs font-medium flex justify-center items-center ">100%</span>
                        </div> --}}
                    </div>
                @endif



                <input type="file" wire:model="uploadedFilesa.26"
                    class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                      file:bg-gray-50 file:border-0
                      file:me-4
                      file:py-3 file:px-4
                     ">
                <!-- Spinner saat upload -->
                <div wire:loading wire:target="uploadedFilesa.26" class="w-full grid gap-1 mt-4">
                    <div class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        <span class="text-sm text-gray-600">Unggah file...</span>
                    </div>
                </div>
                @if ($uploadedFilesa[26] ?? false)
                    <div wire:loading.remove wire:target="uploadedFilesa.26" class="w-full grid gap-1 mt-4">
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-2">
                                <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                    viewBox="0 0 40 40" fill="none">
                                    <g id="File">
                                        <path id="icon"
                                            d="M31.6497 10.6056L32.2476 10.0741L31.6497 10.6056ZM28.6559 7.23757L28.058 7.76907L28.058 7.76907L28.6559 7.23757ZM26.5356 5.29253L26.2079 6.02233L26.2079 6.02233L26.5356 5.29253ZM33.1161 12.5827L32.3683 12.867V12.867L33.1161 12.5827ZM31.8692 33.5355L32.4349 34.1012L31.8692 33.5355ZM24.231 11.4836L25.0157 11.3276L24.231 11.4836ZM26.85 14.1026L26.694 14.8872L26.85 14.1026ZM11.667 20.8667C11.2252 20.8667 10.867 21.2248 10.867 21.6667C10.867 22.1085 11.2252 22.4667 11.667 22.4667V20.8667ZM25.0003 22.4667C25.4422 22.4667 25.8003 22.1085 25.8003 21.6667C25.8003 21.2248 25.4422 20.8667 25.0003 20.8667V22.4667ZM11.667 25.8667C11.2252 25.8667 10.867 26.2248 10.867 26.6667C10.867 27.1085 11.2252 27.4667 11.667 27.4667V25.8667ZM20.0003 27.4667C20.4422 27.4667 20.8003 27.1085 20.8003 26.6667C20.8003 26.2248 20.4422 25.8667 20.0003 25.8667V27.4667ZM23.3337 34.2H16.667V35.8H23.3337V34.2ZM7.46699 25V15H5.86699V25H7.46699ZM32.5337 15.0347V25H34.1337V15.0347H32.5337ZM16.667 5.8H23.6732V4.2H16.667V5.8ZM23.6732 5.8C25.2185 5.8 25.7493 5.81639 26.2079 6.02233L26.8633 4.56274C26.0191 4.18361 25.0759 4.2 23.6732 4.2V5.8ZM29.2539 6.70608C28.322 5.65771 27.7076 4.94187 26.8633 4.56274L26.2079 6.02233C26.6665 6.22826 27.0314 6.6141 28.058 7.76907L29.2539 6.70608ZM34.1337 15.0347C34.1337 13.8411 34.1458 13.0399 33.8638 12.2984L32.3683 12.867C32.5216 13.2702 32.5337 13.7221 32.5337 15.0347H34.1337ZM31.0518 11.1371C31.9238 12.1181 32.215 12.4639 32.3683 12.867L33.8638 12.2984C33.5819 11.5569 33.0406 10.9662 32.2476 10.0741L31.0518 11.1371ZM16.667 34.2C14.2874 34.2 12.5831 34.1983 11.2872 34.0241C10.0144 33.8529 9.25596 33.5287 8.69714 32.9698L7.56577 34.1012C8.47142 35.0069 9.62375 35.4148 11.074 35.6098C12.5013 35.8017 14.3326 35.8 16.667 35.8V34.2ZM5.86699 25C5.86699 27.3344 5.86529 29.1657 6.05718 30.593C6.25217 32.0432 6.66012 33.1956 7.56577 34.1012L8.69714 32.9698C8.13833 32.411 7.81405 31.6526 7.64292 30.3798C7.46869 29.0839 7.46699 27.3796 7.46699 25H5.86699ZM23.3337 35.8C25.6681 35.8 27.4993 35.8017 28.9266 35.6098C30.3769 35.4148 31.5292 35.0069 32.4349 34.1012L31.3035 32.9698C30.7447 33.5287 29.9863 33.8529 28.7134 34.0241C27.4175 34.1983 25.7133 34.2 23.3337 34.2V35.8ZM32.5337 25C32.5337 27.3796 32.532 29.0839 32.3577 30.3798C32.1866 31.6526 31.8623 32.411 31.3035 32.9698L32.4349 34.1012C33.3405 33.1956 33.7485 32.0432 33.9435 30.593C34.1354 29.1657 34.1337 27.3344 34.1337 25H32.5337ZM7.46699 15C7.46699 12.6204 7.46869 10.9161 7.64292 9.62024C7.81405 8.34738 8.13833 7.58897 8.69714 7.03015L7.56577 5.89878C6.66012 6.80443 6.25217 7.95676 6.05718 9.40704C5.86529 10.8343 5.86699 12.6656 5.86699 15H7.46699ZM16.667 4.2C14.3326 4.2 12.5013 4.1983 11.074 4.39019C9.62375 4.58518 8.47142 4.99313 7.56577 5.89878L8.69714 7.03015C9.25596 6.47133 10.0144 6.14706 11.2872 5.97592C12.5831 5.8017 14.2874 5.8 16.667 5.8V4.2ZM23.367 5V10H24.967V5H23.367ZM28.3337 14.9667H33.3337V13.3667H28.3337V14.9667ZM23.367 10C23.367 10.7361 23.3631 11.221 23.4464 11.6397L25.0157 11.3276C24.9709 11.1023 24.967 10.8128 24.967 10H23.367ZM28.3337 13.3667C27.5209 13.3667 27.2313 13.3628 27.0061 13.318L26.694 14.8872C27.1127 14.9705 27.5976 14.9667 28.3337 14.9667V13.3667ZM23.4464 11.6397C23.7726 13.2794 25.0543 14.5611 26.694 14.8872L27.0061 13.318C26.0011 13.1181 25.2156 12.3325 25.0157 11.3276L23.4464 11.6397ZM11.667 22.4667H25.0003V20.8667H11.667V22.4667ZM11.667 27.4667H20.0003V25.8667H11.667V27.4667ZM32.2476 10.0741L29.2539 6.70608L28.058 7.76907L31.0518 11.1371L32.2476 10.0741Z"
                                            fill="#4F46E5" />
                                    </g>
                                </svg>
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path id="icon"
                                        d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                        stroke="#4F46E5" stroke-width="1" stroke-linecap="round" />
                                </svg>
                                <div class="grid gap-1">
                                    <h4 class="text-gray-900 text-sm font-normal leading-snug">
                                        {{ $uploadedFilesa[26]->getClientOriginalName() }}</h4>
                                    <h5 class="text-gray-400   text-xs font-normal leading-[18px]">Upload complete</h5>
                                </div>
                            </div>

                        </div>
                    </div>
                @endif



            </div>

        @endif


        @if ($currentStep === 1)
            <div class="p-4 rounded-lg shadow-md bg-white">
                <h3 class="text-lg font-semibold text-center">Data Pemohon</h3>
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
                        <label for="pemohon_hp_telepon" class="block text-sm/6 font-medium text-gray-900">No Hp
                            (Whatsapp) <span class="text-red-500">*</span></label>
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
                        <label for="pemohon_email" class="block text-sm/6 font-medium text-gray-900">Email </label>
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
                        <label for="pemohon_warga_blok" class="block text-sm/6 font-medium text-gray-900">
                            Warga Blok/ Pepanthan/ Komisi/ Panitia/ Tim </label>
                        <div class="mt-2">
                            <input type="text" wire:model="pemohon_warga_blok"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                                placeholder="Blok 2">
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
        @endif

        <!-- Jenis Permohonan -->
        @if ($currentStep === 2)
            <div class="p-4 rounded-lg shadow-md mt-5 bg-white">
                <h3 class="text-lg font-semibold text-center">Form Permohonan</h3>
                {{-- <p class="text-sm text-gray-600 mb-4">Silakan isi data permohonan dengan benar.</p> --}}
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

                </div>
            </div>
        @endif

        <!-- Surat Permohonan -->
        @if ($currentStep === 3)
            <div class="p-4 rounded-lg shadow-md mt-5 bg-white">
                <h3 class="text-lg font-semibold text-center">Surat Permohonan</h3>
                {{-- <h4 class="text-md font-semibold">Surat Permohonan</h4> --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2">
                    @if (!isset($pertanyaans) || count($pertanyaans) === 0)
                        <div class="sm:col-span-3">
                            <div class="max-w-xl mx-auto text-center">
                                <p class="text-gray-700">Lewati langkah ini.</p>
                                <p class="text-gray-700">Tidak ada data yang perlu dikirim.</p>
                            </div>
                        </div>
                    @else
                        @foreach ($pertanyaans as $pertanyaan)
                            @if ($pertanyaan->tipe_jawaban === 'header')
                                {{-- <div class="sm:col-span-3">
                                                <h4 class="text-lg font-semibold text-gray-700">{{ $pertanyaan->pertanyaan }}
                                                </h4>
                                            </div> --}}
                                <div class="sm:col-span-3 text-black">
                                    <p class="text-sm text-gray-600 mb-4">{{ $pertanyaan->pertanyaan }}</p>
                                    {{-- <label>{{ $pertanyaan->pertanyaan }}</label> --}}
                                </div>
                            @else
                                <div class="sm:col-span-1">
                                    <label
                                        class="block text-sm/6 font-medium text-gray-900">{{ $pertanyaan->pertanyaan }}
                                        @if ($pertanyaan->tipe_jawaban === 'date')
                                            <span class="text-gray-500"> (Format dd/mm/yyyy) </span>
                                        @endif
                                        @if ($pertanyaan->required)
                                            <span class="text-red-500">*</span>
                                        @endif
                                    </label>
                                    {{-- <td>: {{ \Carbon\Carbon::parse('2020-04-04')->locale('id')->translatedFormat('d F Y') }} / {{ \Carbon\Carbon::parse('2020-04-04')->age }} / {{ '2025-04-04' }} </td> --}}

                                    <div class="mt-2">
                                        @if ($pertanyaan->tipe_jawaban === 'text')
                                            <input
                                                placeholder="{{ $pertanyaan->placeholder == null ? $pertanyaan->placeholder : '' }}"
                                                type="text" wire:model="answers.{{ $pertanyaan->order }}"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @elseif ($pertanyaan->tipe_jawaban === 'date')
                                            <input
                                                placeholder="{{ $pertanyaan->placeholder == null ? $pertanyaan->placeholder . ', ' : '' }} Cth. 21/03/1994"
                                                oninput="validateDateInput(this, {{ $pertanyaan->order }})"
                                                x-mask="99/99/9999" wire:model="answers.{{ $pertanyaan->order }}"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">

                                            {{-- <input placeholder="{{ ($pertanyaan->placeholder==null)? $pertanyaan->placeholder: '' }}" type="date"
                                                wire:model="answers.{{ $pertanyaan->order }}"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6"> --}}
                                        @elseif ($pertanyaan->tipe_jawaban === 'time')
                                            <input
                                                placeholder="{{ $pertanyaan->placeholder == null ? $pertanyaan->placeholder : '' }}"
                                                type="time" wire:model="answers.{{ $pertanyaan->order }}"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 outline-gray-300 focus:outline-2 focus:outline-indigo-600 sm:text-sm/6">
                                        @elseif ($pertanyaan->tipe_jawaban === 'textarea')
                                            <textarea placeholder="{{ $pertanyaan->placeholder == null ? $pertanyaan->placeholder : '' }}"
                                                wire:model="answers.{{ $pertanyaan->order }}"
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
                                                        <option value="{{ $option['label'] }}">
                                                            {{ $option['label'] }}</option>
                                                    @endforeach
                                                </select>
                                            @elseif ($pertanyaan->tipe_jawaban === 'checkbox')
                                                @foreach ($opsi_jawaban as $option)
                                                    <div class="flex items-center">
                                                        <input type="checkbox"
                                                            wire:model="answers.{{ $pertanyaan->order }}"
                                                            value="{{ $option['label'] }}" class="mr-2">
                                                        <span>{{ $option['label'] }}</span>
                                                    </div>
                                                @endforeach
                                            @elseif ($pertanyaan->tipe_jawaban === 'radio')
                                                @foreach ($opsi_jawaban as $option)
                                                    <div class="flex items-center">
                                                        <input type="radio"
                                                            wire:model="answers.{{ $pertanyaan->order }}"
                                                            value="{{ $option['label'] }}" class="mr-2">
                                                        <span>{{ $option['label'] }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @endif
                                        @if ($pertanyaan->tipe_jawaban === 'date')
                                            <p id="date-error-{{ $pertanyaan->order }}" class="text-red-500"></p>
                                        @endif

                                        @error('answers.' . $pertanyaan->order)
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    @endif
                </div>


            </div>
        @endif
        <script>
            function validateDateInput(input, id) {
                console.log(input);

                let value = input.value;
                console.log(value);
                let errorText = document.getElementById('date-error-' + id);

                const regex = /^(\d{2})\/(\d{2})\/(\d{4})$/;

                const bagianTanggal = value.split('/');
                const hari = parseInt(bagianTanggal[0], 10);
                const bulan = parseInt(bagianTanggal[1], 10) - 1; // Bulan dalam JavaScript dimulai dari 0 (Januari = 0)
                const tahun = parseInt(bagianTanggal[2], 10);

                const d = new Date(tahun, bulan, hari);

                const valid = d.getFullYear() === tahun && d.getMonth() === bulan && d.getDate() === hari;
                console.log(value.length);

                if (value.length == 10 && (!regex.test(value) || valid == false)) {
                    errorText.textContent = "Tanggal tidak valid";
                } else {
                    errorText.textContent = "";
                }
            }
        </script>
        <!-- Unggah Dokumen -->
        @if ($currentStep === 4)
            <div class="p-4 rounded-lg shadow-md mt-5 bg-white">
                <h3 class="text-lg font-semibold text-center">Unggah Dokumen</h3>
                {{-- <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2" wire:ignore> --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 mt-2">
                    @if (!isset($listUploads) || count($listUploads) === 0)
                        <div class="sm:col-span-3">
                            <div class="max-w-xl mx-auto text-center">
                                <p class="text-gray-700">Lewati langkah ini.</p>
                                <p class="text-gray-700">Tidak ada data yang perlu dikirim.</p>
                            </div>
                        </div>
                    @else
                        @foreach ($listUploads as $upload)
                            <div class="sm:col-span-1" wire:key="upload-{{ $upload->id }}">
                                <label class="block text-gray-700 font-medium">{{ $upload->name }}
                                    @if ($upload->is_required)
                                        <span class="text-red-500">*</span>
                                    @endif
                                </label>

                                <x-filepond::upload class="filepond" 
                                    wire:model="uploadedFiles.{{ $upload->id }}"
                                    :existing-files="null"
                                    {{-- acceptedFileTypes="{{ $upload->upload_type === 'pdf' ? 'application/pdf' : 'image/*' }}" --}}
                                    acceptedFileTypes="{{ $upload->upload_type === 'pdf' ? 'application/pdf' : ($upload->upload_type === 'both' ? 'application/pdf,image/*' : 'image/*') }}"
                                    max-file-size="5MB" />

                                @php
                                    $upload_id = $upload->id;
                                @endphp

                              
                                {{-- <input type="file" wire:model="uploadedFiles.{{ $upload_id }}"
                                    onchange="validateFileSize(this, {{ $upload_id }})"
                                    class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                    file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4"
                                    accept="{{ $upload->upload_type === 'pdf' ? 'application/pdf' : 'image/*' }}"> --}}


                                <p class="text-xs text-gray-500">
                                    Format: {{ $upload->upload_type === 'pdf' ? 'PDF' : ($upload->upload_type === 'both' ? 'PDF, JPG, JPEG, PNG' : 'JPG, JPEG, PNG') }}, Maks:
                                    5MB
                                </p>
                                <p id="size-error-{{ $upload_id }}" class="text-sm text-red-600 mt-1"></p>

                                {{-- <div wire:loading wire:target="uploadedFiles.{{ $upload_id }}"
                                    class="w-full grid gap-1 mt-4">
                                    <div class="flex items-center gap-2">
                                        <svg class="animate-spin h-5 w-5 text-indigo-600"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z">
                                            </path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Unggah file...</span>
                                    </div>
                                </div> --}}

                                {{-- <div id="size-error-{{ $upload_id }}" class="w-full grid gap-1 mt-4 hidden">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                            </svg>


                                            <div class="grid gap-1">
                                                <h4 class="text-sm text-red-600 font-normal leading-snug">Ukuran file
                                                    terlalu besar!</h4>
                                            </div>
                                        </div>

                                    </div>


                                </div> --}}

                                @if ($existingUploads[$upload_id] ?? false)
                                    <div wire:loading.remove wire:target="uploadedFiles.{{ $upload_id }}"
                                        class="w-full grid gap-1 mt-4">
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-center gap-2">
                                                @if ($upload->upload_type === 'pdf')
                                                    <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg"
                                                        width="40" height="40" viewBox="0 0 40 40"
                                                        fill="none">
                                                        <g id="File">
                                                            <path id="icon"
                                                                d="M31.6497 10.6056L32.2476 10.0741L31.6497 10.6056ZM28.6559 7.23757L28.058 7.76907L28.058 7.76907L28.6559 7.23757ZM26.5356 5.29253L26.2079 6.02233L26.2079 6.02233L26.5356 5.29253ZM33.1161 12.5827L32.3683 12.867V12.867L33.1161 12.5827ZM31.8692 33.5355L32.4349 34.1012L31.8692 33.5355ZM24.231 11.4836L25.0157 11.3276L24.231 11.4836ZM26.85 14.1026L26.694 14.8872L26.85 14.1026ZM11.667 20.8667C11.2252 20.8667 10.867 21.2248 10.867 21.6667C10.867 22.1085 11.2252 22.4667 11.667 22.4667V20.8667ZM25.0003 22.4667C25.4422 22.4667 25.8003 22.1085 25.8003 21.6667C25.8003 21.2248 25.4422 20.8667 25.0003 20.8667V22.4667ZM11.667 25.8667C11.2252 25.8667 10.867 26.2248 10.867 26.6667C10.867 27.1085 11.2252 27.4667 11.667 27.4667V25.8667ZM20.0003 27.4667C20.4422 27.4667 20.8003 27.1085 20.8003 26.6667C20.8003 26.2248 20.4422 25.8667 20.0003 25.8667V27.4667ZM23.3337 34.2H16.667V35.8H23.3337V34.2ZM7.46699 25V15H5.86699V25H7.46699ZM32.5337 15.0347V25H34.1337V15.0347H32.5337ZM16.667 5.8H23.6732V4.2H16.667V5.8ZM23.6732 5.8C25.2185 5.8 25.7493 5.81639 26.2079 6.02233L26.8633 4.56274C26.0191 4.18361 25.0759 4.2 23.6732 4.2V5.8ZM29.2539 6.70608C28.322 5.65771 27.7076 4.94187 26.8633 4.56274L26.2079 6.02233C26.6665 6.22826 27.0314 6.6141 28.058 7.76907L29.2539 6.70608ZM34.1337 15.0347C34.1337 13.8411 34.1458 13.0399 33.8638 12.2984L32.3683 12.867C32.5216 13.2702 32.5337 13.7221 32.5337 15.0347H34.1337ZM31.0518 11.1371C31.9238 12.1181 32.215 12.4639 32.3683 12.867L33.8638 12.2984C33.5819 11.5569 33.0406 10.9662 32.2476 10.0741L31.0518 11.1371ZM16.667 34.2C14.2874 34.2 12.5831 34.1983 11.2872 34.0241C10.0144 33.8529 9.25596 33.5287 8.69714 32.9698L7.56577 34.1012C8.47142 35.0069 9.62375 35.4148 11.074 35.6098C12.5013 35.8017 14.3326 35.8 16.667 35.8V34.2ZM5.86699 25C5.86699 27.3344 5.86529 29.1657 6.05718 30.593C6.25217 32.0432 6.66012 33.1956 7.56577 34.1012L8.69714 32.9698C8.13833 32.411 7.81405 31.6526 7.64292 30.3798C7.46869 29.0839 7.46699 27.3796 7.46699 25H5.86699ZM23.3337 35.8C25.6681 35.8 27.4993 35.8017 28.9266 35.6098C30.3769 35.4148 31.5292 35.0069 32.4349 34.1012L31.3035 32.9698C30.7447 33.5287 29.9863 33.8529 28.7134 34.0241C27.4175 34.1983 25.7133 34.2 23.3337 34.2V35.8ZM32.5337 25C32.5337 27.3796 32.532 29.0839 32.3577 30.3798C32.1866 31.6526 31.8623 32.411 31.3035 32.9698L32.4349 34.1012C33.3405 33.1956 33.7485 32.0432 33.9435 30.593C34.1354 29.1657 34.1337 27.3344 34.1337 25H32.5337ZM7.46699 15C7.46699 12.6204 7.46869 10.9161 7.64292 9.62024C7.81405 8.34738 8.13833 7.58897 8.69714 7.03015L7.56577 5.89878C6.66012 6.80443 6.25217 7.95676 6.05718 9.40704C5.86529 10.8343 5.86699 12.6656 5.86699 15H7.46699ZM16.667 4.2C14.3326 4.2 12.5013 4.1983 11.074 4.39019C9.62375 4.58518 8.47142 4.99313 7.56577 5.89878L8.69714 7.03015C9.25596 6.47133 10.0144 6.14706 11.2872 5.97592C12.5831 5.8017 14.2874 5.8 16.667 5.8V4.2ZM23.367 5V10H24.967V5H23.367ZM28.3337 14.9667H33.3337V13.3667H28.3337V14.9667ZM23.367 10C23.367 10.7361 23.3631 11.221 23.4464 11.6397L25.0157 11.3276C24.9709 11.1023 24.967 10.8128 24.967 10H23.367ZM28.3337 13.3667C27.5209 13.3667 27.2313 13.3628 27.0061 13.318L26.694 14.8872C27.1127 14.9705 27.5976 14.9667 28.3337 14.9667V13.3667ZM23.4464 11.6397C23.7726 13.2794 25.0543 14.5611 26.694 14.8872L27.0061 13.318C26.0011 13.1181 25.2156 12.3325 25.0157 11.3276L23.4464 11.6397ZM11.667 22.4667H25.0003V20.8667H11.667V22.4667ZM11.667 27.4667H20.0003V25.8667H11.667V27.4667ZM32.2476 10.0741L29.2539 6.70608L28.058 7.76907L31.0518 11.1371L32.2476 10.0741Z"
                                                                fill="#4F46E5" />
                                                        </g>
                                                    </svg>
                                                @else
                                                    <svg width="40" height="40" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path id="icon"
                                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                                            stroke="#4F46E5" stroke-width="1"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                @endif
                                                <div class="grid gap-1">
                                                    <h4 class="text-gray-900 text-sm font-normal leading-snug">
                                                        {{ (isset($uploadedFiles[$upload_id]) ? $uploadedFiles[$upload_id]->getClientOriginalName() : (isset($existingUploads[$upload_id]) ? $existingUploads[$upload_id]->getClientOriginalName() : 'Nama File Tidak Ada')) }}</h4>
                                                    <h5 id="text-size-error-{{ $upload_id }}"
                                                        class="text-gray-400 text-xs font-normal leading-[18px]">
                                                        Upload complete</h5>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @else
                                    <div></div>
                                @endif

                                {{-- @error('uploadedFiles.' . $upload->id) --}}
                                @error('existingUploads.' . $upload->id)
                                    <p class="text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endif
        {{-- @script --}}
        <script>
            function validateFileSize(input, id) {
                const MAX_SIZE_MB = 5;
                const MAX_SIZE_BYTES = MAX_SIZE_MB * 1024 * 1024;
                // const errorElement = document.getElementById(`size-error-${id}`);
                // const uploadSuccess = document.getElementById(`upload-success-${id}`);
                var errorDiv = document.getElementById(`size-error-${id}`);
                var errorDexscription = document.getElementById(`text-size-error-${id}`);
                var errorDexscription1 = document.getElementById(`text-size-error1-${id}`);
                console.log('file.size');

                if (input.files.length > 0) {
                    var file = input.files[0];
                    var fileSizeMB = (file.size / 1024 / 1024).toFixed(2); // Format angka            
                    if (file.size > MAX_SIZE_BYTES) {
                        // errorDescription.textContent = `Ukuran file ini ${fileSizeMB}MB.`;            
                        errorDexscription1.textContent = 'Ukuran file ini ' + fileSizeMB + 'MB.';
                        errorDescription.textContent = 'Ukuran file ini ' + fileSizeMB + 'MB.';
                        errorDiv.classList.remove('hidden');
                        // uploadSuccess.classList.add('hidden');
                    } else {
                        errorDexscription1.textContent = ''; // Kosongkan pesan error
                        errorDescription.textContent = ''; // Kosongkan pesan error
                        errorDiv.classList.add('hidden');
                    }
                } else {
                    errorDexscription1.textContent = '';
                    errorDescription.textContent = '';
                    errorDiv.classList.add('hidden');
                }
            }
        </script>
        {{-- @endscript --}}
        <!-- Konfirmasi -->
        @if ($currentStep === 5)
            <div class="p-4 rounded-lg shadow-md mt-5 bg-white space-y-6">
                <h3 class="text-lg font-semibold text-center">Konfirmasi</h3>
                <div class="max-w-xl mx-auto text-center">
                    {{-- <p class="text-gray-700">Silahkan periksa kembali data yang Anda isi sebelum mengirim permohonan. --}}
                    </p>
                    <p class="text-gray-700">Pasikan semua data sudah terisi dengan benar, silakan klik tombol
                        <strong>Submit</strong>
                        di bawah untuk mengirim
                        permohonan.
                    </p>
                </div>
            </div>
        @endif


        {{-- Navigasi --}}
        <div class="flex justify-between mt-6 pt-6">
            @if ($currentStep > 1)
                <button type="button" wire:click="previousStep"
                    class="rounded-lg cursor-pointer text-white border border-white hover:bg-white hover:text-teal-900 transition duration-200 px-4 py-2 font-bold shadow-md">
                    Sebelumnya
                </button>
            @endif

            @if ($currentStep < 5)
                <button type="button" wire:click="nextStep"
                    class="ml-auto rounded-lg cursor-pointer text-teal-900 border border-lime-500 hover:border-white bg-lime-500 hover:bg-white transition duration-200 px-4 py-2 font-bold shadow-md">
                    Selanjutnya
                </button>
            @else
                <button type="submit"
                    class="ml-auto rounded-lg cursor-pointer text-teal-900 border border-lime-500 hover:border-white bg-lime-500 hover:bg-white transition duration-200 px-4 py-2 font-bold shadow-md">
                    <span wire:loading.remove wire:target="submit">Submit</span>
                    <span wire:loading wire:target="submit">Loading...</span>
                </button>
            @endif
        </div>
        {{-- <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="submit"
                class="rounded-lg text-teal-900 border border-lime-500 hover:border-white 
                bg-lime-500 hover:bg-white transition duration-200 
                px-4 py-2 text-md font-bold shadow-md focus:outline-none focus:ring-2 
                focus:ring-lime-500 focus:ring-offset-2 cursor-pointer">
                <span wire:loading.remove wire:target="submit">Submit</span>
                <span wire:loading wire:target="submit">Loading...</span>
            </button>
        </div> --}}
        {{-- <div wire:loading class="fixed inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <p class="text-lg font-semibold text-gray-800">Sedang menyimpan...</p>
            </div>
        </div> --}}

    </form>
</div>
