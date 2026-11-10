<?php

namespace App\Filament\Resources\Pinjams\Tables;

use App\Models\Pinjam;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Facades\Filament;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class PinjamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('buku.id')
                    ->searchable(),
                TextColumn::make('tgl_dipinjam')
                    ->date()
                    ->sortable(),
                TextColumn::make('tgl_dikembalikan')
                    ->date()
                    ->sortable(),
                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state)=> $state === 'dipinjam' ? 'warning' : 'success'),
                TextColumn::make('denda')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('kembalikan')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->requiresConfirmation()
                    ->visible(fn (Pinjam $record) => $record->status === 'dipinjam')
                    ->action(function (Pinjam $record){
                        $telat = (int) $record->due_date->diffIndays(now()->startOfDay(), false);
                        $record->update([
                            'tgl_dikembalikan' => now(),
                            'status' => 'dikembalikan',
                            'denda' => max(0, $telat) * 1000,
                        ]);
                        $record->buku->increment('stok');
                        Notification::make()->title('Buku sudah dikembalikan')->success()->send();
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
