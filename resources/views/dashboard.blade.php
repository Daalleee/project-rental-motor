<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Daftar Motor Rental') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($motors as $motor)
                <div class="bg-white rounded-xl shadow-md p-5 flex flex-col text-center h-full">
                    {{-- Gambar motor --}}
                    <div class="h-44 flex items-center justify-center mb-4">
                        @if ($motor->image)
                            <img src="{{ asset('storage/' . $motor->image) }}"
                                alt="{{ $motor->brand }} {{ $motor->model }}" class="h-full object-contain mx-auto">
                        @else
                            <div class="h-full w-full bg-gray-200 flex items-center justify-center text-gray-400">
                                No Image
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="flex flex-col flex-grow justify-between">
                        {{-- Nama motor dengan tinggi minimal agar rata --}}
                        <h3 class="text-base font-bold text-gray-900 mb-2 min-h-[48px]">
                            {{ $motor->brand }} {{ $motor->model }}
                        </h3>

                        {{-- Deskripsi dengan tinggi minimal --}}
                        <p class="text-sm text-green-600 mb-2 min-h-[40px]">
                            {{ $motor->description ?? 'Termasuk Helm SNI' }}
                        </p>

                        {{-- Harga --}}
                        <p class="text-base text-red-600 font-extrabold mb-4">
                            Rp {{ number_format($motor->rental_price_per_day, 0, ',', '.') }}
                            <span class="text-gray-700 text-sm font-medium">/ Hari</span>
                        </p>
                    </div>

                    {{-- Tombol sewa --}}
                    @php
                        $userName = Auth::user()->name ?? 'Pelanggan';
                        $today = now()->format('d-m-Y');
                        $message =
                            "Halo, saya $userName ingin menyewa motor {$motor->brand} {$motor->model} tanggal $today " .
                            'dengan harga Rp ' .
                            number_format($motor->rental_price_per_day, 0, ',', '.') .
                            '/hari selama (ISI BERAPA HARI) hari. Mohon informasinya lebih lanjut. Terima kasih.';
                        $whatsappLink = 'https://wa.me/6281337063361?text=' . urlencode($message);
                    @endphp

                    {{-- Form untuk simpan sewa --}}
                    <form id="sewaForm-{{ $motor->id }}" action="{{ route('sewa.store', $motor->id) }}"
                        method="POST" class="hidden">
                        @csrf
                    </form>

                    {{-- Tombol sewa yang kirim ke form dan redirect ke WhatsApp --}}
                    <button type="button" onclick="submitSewa({{ $motor->id }}, '{{ $whatsappLink }}')"
                        class="mt-auto w-full bg-green-600 hover:bg-green-700 text-white text-sm py-3 rounded font-semibold transition">
                        Sewa Sekarang
                    </button>

                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">Belum ada data motor.</p>
            @endforelse
        </div>
    </div>


</x-app-layout>
