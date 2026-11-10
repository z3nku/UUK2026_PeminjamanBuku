<?php

namespace App\Filament\Resources\Bukus\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Buku;
use App\Models\Pinjam;
use Filament\Actions\action;
use Filament\Actions\Action as ActionsAction;
use Filament\Notifications\Notification;

class BukusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Judul')
                    ->searchable(),
                TextColumn::make('Penulis')
                    ->searchable(),
                TextColumn::make('Penerbit')
                    ->searchable(),
                TextColumn::make('tahun')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('stok')
                    ->numeric()
                    ->sortable(),
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
                Action::make('pinjam')
                    ->icon('heroicon-o-book-open')
                    ->requiresConfirmation()
                    ->visible(fn () => ! auth()->user()->isAdmin())
                    ->disabled(fn (Buku $record) => $record->stok < 1)
                    ->action(function (Buku $record){
                        $aktif = Pinjam::where('user_id', auth()->id())->where('status', 'dipinjam')->count();
                        if ($aktif >= 3){
                            Notification::make()->title('Maksimal Meminjam 3 buku')->danger()->send();
                            return;
                        }
                        Pinjam::create([
                            'user_id' => auth()->id(),
                            'buku_id' => $record->id,
                            'tgl_dipinjam' => now(),
                            'due_date' => now()->addDays(7),

                        ]);
                        $record->decrement('stok');
                        Notification::make()->title('Buku berhasil dipinjam')->success()->send();
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
