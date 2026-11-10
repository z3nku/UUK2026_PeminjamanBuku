<?php

namespace App\Filament\Resources\Bukus\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BukuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('Judul')
                    ->required(),
                TextInput::make('Penulis')
                    ->required(),
                TextInput::make('Penerbit')
                    ->required(),
                TextInput::make('tahun')
                    ->required()
                    ->numeric(),
                TextInput::make('stok')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
