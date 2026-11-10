<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Buku;
use App\Models\User;
use App\Models\Pinjam;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
           Stat::make('Judul Buku', Buku::count()),
           Stat::make('Anggota', User::where('role', 'siswa')->count()),
           Stat::make('Sedang Dipinjam', Pinjam::where('status', 'dipinjam')->count()),
        ];
    }
}
