<?php

namespace App\Filament\Resources\Pinjams\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PinjamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('buku_id')
                    ->relationship('buku', 'id')
                    ->required(),
                DatePicker::make('tgl_dipinjam')
                    ->required(),
                DatePicker::make('tgl_dikembalikan'),
                DatePicker::make('due_date')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('dipinjam'),
                TextInput::make('denda')
                    ->required()
                    ->default('0'),
            ]);
    }
}
