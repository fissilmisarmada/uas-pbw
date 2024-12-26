<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Home extends Page
{
    public static function getRoute(): string
    {
        return url('/home'); // Arahkan ke route frontend
    }

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Dashboard';
    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Home';

    public static function shouldRegisterNavigation(): bool
    {
        return true; // Tetap tampil di sidebar untuk navigasi
    }

    public static function getNavigationUrl(): string
    {
        return url('/home'); // Pastikan ini mengarah ke route frontend
    }
}
