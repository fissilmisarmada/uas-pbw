<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Rental Mobil</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('rental.request') }}">Pengajuan Rental</a></li>
                <!-- Tombol Logout menggunakan Form POST -->
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Log Out</button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="content">
            <h1>Selamat Datang di Rental Mobil SM </h1>
            <p>Silakan pilih salah satu opsi di bawah ini:</p>
            <div class="buttons">
                <a href="{{ route('about') }}" class="btn">About Us</a>
                <a href="{{ route('rental.request') }}" class="btn">Pengajuan Rental</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Rental Mobil. All rights reserved.</p>
    </footer>
</body>
</html>
