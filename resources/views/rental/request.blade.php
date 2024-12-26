@extends('layouts.app')

@section('head')
    <!-- Menambahkan link ke file CSS -->
    <link href="{{ asset('css/pengajuan.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section id="rental-request">
        <h2>Pengajuan Rental</h2>

        <!-- Menampilkan pesan jika ada notifikasi sukses atau error -->
        @if(session('success'))
            <div class="status-message success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="status-message error">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form untuk pengajuan rental -->
        <form action="{{ route('rental.submit') }}" method="POST">
            @csrf

            <!-- Input Nama -->
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <!-- Input Email -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <!-- Pilih Kendaraan -->
            <label for="vehicle">Kendaraan yang Diinginkan:</label>
            <select id="vehicle" name="vehicle_id" required>
                @foreach($vehicles as $vehicle)
                    @if($vehicle->is_available)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->name }} - Rp {{ number_format($vehicle->price_per_day, 2) }} per hari
                        </option>
                    @else
                        <option value="{{ $vehicle->id }}" disabled>
                            {{ $vehicle->name }} - Tidak Tersedia
                        </option>
                    @endif
                @endforeach
            </select>

            <!-- Input Tanggal Mulai Sewa -->
            <label for="rental_date">Tanggal Mulai Sewa:</label>
            <input type="date" id="rental_date" name="rental_date" value="{{ old('rental_date') }}" required>

            <!-- Input Tanggal Pengembalian -->
            <label for="return_date">Tanggal Pengembalian:</label>
            <input type="date" id="return_date" name="return_date" value="{{ old('return_date') }}">

            <!-- Tombol Ajukan Rental -->
            <button type="submit">Ajukan Rental</button>
        </form>
    </section>
@endsection
