<x-layout title="Home">
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <section class="py-12 lg:py-24 bg-teal-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-6">
                <h2 class="font-heading text-6xl text-white mb-12">Formulir Permohonan</h2>
                <a class="inline-flex py-4 px-12 items-center justify-center text-lg font-medium text-teal-900 border border-lime-500 hover:border-white bg-lime-500 hover:bg-white rounded-full transition duration-200"
                    href="{{ route('form-permohonan') }}">Ajukan Permohonan
                </a>
                <p class="text-lg text-white opacity-80 mt-12 mb-6">
                    Berikut persyaratan dan formulir kegiatan yang berkaitan dengan Gereja Kristen Jawa (GKJ)
                    Manahan. Daftar formulir selengkapnya dapat di lihat di halaman akhir di bawah ini.
                </p>
            </div>
            
            <div class="max-w-md mx-auto lg:max-w-none">
                <div class="flex flex-wrap -mx-4" x-data="{ activeAccordion: null }">
                    @foreach ($forms as $form)
                        <div class="w-full lg:w-1/2 px-4 mb-4 lg:mb-0" >
                            <div class="py-4 px-8 mb-4 bg-white text-left shadow-md rounded-2xl">
                                <div>
                                    <div class="flex items-start justify-between cursor-pointer"
                                         x-on:click.prevent="activeAccordion === {{ $form->id }} ? activeAccordion = null : activeAccordion = {{ $form->id }}">
                                        <h5 class="text-xl font-medium pr-5">{{ $form->name }}</h5>
                                        <span class="flex-shrink-0">
                                            <div x-show="activeAccordion !== {{ $form->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                     class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </div>
                                            <div x-show="activeAccordion === {{ $form->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                     class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                                </svg>
                                            </div>
                                        </span>
                                    </div>
                                    <div class="overflow-hidden transition-all duration-500"
                                         x-ref="container{{ $form->id }}"
                                         x-bind:style="activeAccordion === {{ $form->id }} ? 'height: ' + $refs.container{{ $form->id }}.scrollHeight + 'px' : 'height: 0px;'">
                                        <p class="text-gray-700 mt-4">{!! $form->content !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            
            {{-- <div class="max-w-md mx-auto lg:max-w-none">
                <div class="flex flex-wrap -mx-4">

                    <div x-data="{ activeAccordion: null }" >
                        @foreach ($forms as $form)
                            <div class="w-full lg:w-1/2 px-4 mb-4 lg:mb-0">
                                <div class="py-4 px-8 mb-4 bg-white text-left shadow-md rounded-2xl">
                                    <div>
                                        <div class="flex items-start justify-between cursor-pointer"
                                             x-on:click.prevent="activeAccordion === {{ $form->id }} ? activeAccordion = null : activeAccordion = {{ $form->id }}">
                                            <h5 class="text-xl font-medium pr-5">{{ $form->name }}</h5>
                                            <span class="flex-shrink-0">
                                                <div x-show="activeAccordion !== {{ $form->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </div>
                                                <div x-show="activeAccordion === {{ $form->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                         class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                                    </svg>
                                                </div>
                                            </span>
                                        </div>
                                        <div class="overflow-hidden transition-all duration-500"
                                             x-ref="container{{ $form->id }}"
                                             x-bind:style="activeAccordion === {{ $form->id }} ? 'height: ' + $refs.container{{ $form->id }}.scrollHeight + 'px' : 'height: 0px;'">
                                            <p class="text-gray-700 mt-4">{!! $form->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

        
                </div>
            </div> --}}
        </div>
    </section>
</x-layout>
