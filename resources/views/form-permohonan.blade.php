<x-layout>
    <x-slot:menu>{{ $menu }}</x-slot:menu>

    <section class="relative py-12 lg:py-24 bg-teal-900 overflow-hidden">
        <img class="absolute top-0 right-0" src="{{ asset('quantam-assets/pricing/waves-right-top.png') }}" alt="">
        <div class="container mx-auto px-4 relative">

            <livewire:form-permohonan />
        </div>
    </section>
</x-layout>
