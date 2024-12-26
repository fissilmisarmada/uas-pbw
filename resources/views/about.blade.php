
<head>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
</head>


@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<section style="text-align: center; padding: 20px;">
    <h1>Tentang Kami</h1>
    <p>Berikut adalah informasi tentang pengembang aplikasi ini:</p>

    <div style="margin-top: 30px; display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
        <!-- Profil Pertama -->
        <div style="text-align: center; border: 2px solid #007BFF; border-radius: 10px; padding: 20px; max-width: 300px;">
            <img src="{{ asset('images/mael.jpg') }}" alt="Foto Profil Achmad Ismail" 
                 style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #007BFF;">
            <h2 style="margin-top: 20px; font-size: 20px;">Achmad Ismail</h2>
            <p style="font-size: 16px; margin: 5px 0;">NIM: C050423001</p>
            <p style="font-size: 16px; margin: 5px 0;">Kelas: SIKC-3A</p>
        </div>

        <!-- Profil Kedua -->
        <div style="text-align: center; border: 2px solid #007BFF; border-radius: 10px; padding: 20px; max-width: 300px;">
            <img src="{{ asset('images/silmi.jpg') }}" alt="Foto Profil Muhammad Fissilmi" 
                 style="width: 150px; height: 150px; border-radius: 50%; border: 2px solid #007BFF;">
            <h2 style="margin-top: 20px; font-size: 20px;">Muhammad Fissilmi Sarmada</h2>
            <p style="font-size: 16px; margin: 5px 0;">NIM: C050423002</p>
            <p style="font-size: 16px; margin: 5px 0;">Kelas: SIKC-3A</p>
        </div>
    </div>
</section>
@endsection
