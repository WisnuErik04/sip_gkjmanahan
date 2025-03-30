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
                    Berikut persyarata dan formulir kegiatan yang berkaitan dengan Gereja Kristen Jawa (GKJ)
                    Manahan. Daftar formulir selengkapnya dapat di lihat di halaman akhir di bawah ini.
                </p>
            </div>
            <div class="max-w-md mx-auto lg:max-w-none">
                <div class="flex flex-wrap -mx-4">


                    @foreach ($forms as $form)
                        <div class="w-full lg:w-1/2 px-4 mb-4 lg:mb-0">
                            <button
                                class="flex w-full py-4 px-8 mb-4 bg-white items-start justify-between text-left shadow-md rounded-2xl cursor-pointer"
                                x-data="{ accordion: false }" x-on:click.prevent="accordion = !accordion">
                                <div class="pr-5">
                                    <h5 class="text-xl font-medium">{{ $form->name }}</h5>
                                    <div class="overflow-hidden h-0 duration-500" x-ref="container"
                                        :style="accordion ? 'height: ' + $refs.container.scrollHeight + 'px' : ''"
                                        style="height: 112px">
                                        <p class="text-gray-700 mt-4">{!! $form->content !!}</p>
                                    </div>
                                </div>
                                <span class="flex-shrink-0">
                                    <div :class="{ 'hidden': accordion }" class="hidden">
                                        {{-- <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M12 5.69995V18.3" stroke="#1D1F1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                      <path d="M5.69995 12H18.3" stroke="#1D1F1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                        </svg>

                                    </div>
                                    <div class="" :class="{ 'hidden': !accordion }">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                        </svg>

                                    </div>
                                </span>
                            </button>


                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
</x-layout>
