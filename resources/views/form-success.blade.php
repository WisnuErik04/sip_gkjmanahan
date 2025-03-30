<x-layout>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <section class="relative py-12 lg:py-24 bg-teal-900 overflow-hidden">
        <img class="absolute top-0 right-0"
            src="{{ asset('quantam-assets/pricing/waves-right-top.png') }}" alt="" />
        <div class="container mx-auto px-4 relative">
            <div class="max-w-2xl mx-auto text-center mb-20">
                <h1 class="font-heading text-5xl sm:text-6xl tracking-xs text-white mb-6">
                    <section class="relative py-12 lg:py-24 bg-teal-900 overflow-hidden"><img
                            class="absolute top-0 right-0" src="{{ asset('quantam-assets/pricing/waves-right-top.png') }}"
                            alt="" />
                        <div class="container mx-auto px-4 relative">
                            <div class="max-w-2xl mx-auto text-center mb-20">
                                <h1 class="font-heading text-5xl sm:text-6xl tracking-xs text-white mb-6">Berhasil</h1>
                                <p class="text-lg text-white opacity-80">Form Berhasil Diajukan!</p>
                                <p class="text-lg text-white opacity-80">Silakan cek email Anda untuk melihat status
                                    pengajuan secara berkala.</p>
                            </div>
                            <a class="inline-flex py-4 px-6 items-center justify-center text-lg font-medium text-teal-900 border border-lime-500 hover:border-white bg-lime-500 hover:bg-white rounded-full transition duration-200"
                                href="{{ route('home') }}">
                                Kembali ke Beranda
                            </a>

                        </div>
                    </section>
                </h1>

            </div>

        </div>
    </section>

</x-layout>
