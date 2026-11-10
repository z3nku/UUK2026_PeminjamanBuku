<?php

namespace App\Filament\Resources\Bukus;

use App\Filament\Resources\Bukus\Pages\CreateBuku;
use App\Filament\Resources\Bukus\Pages\EditBuku;
use App\Filament\Resources\Bukus\Pages\ListBukus;
use App\Filament\Resources\Bukus\Schemas\BukuForm;
use App\Filament\Resources\Bukus\Tables\BukusTable;
use App\Models\Buku;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;
use Override;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'judul';

    #[Override]
    public static function getAuthorizationResponse(string|UnitEnum $action, ?Model $record = null): Response
    {
        if (auth()->user()->isAdmin() || $action === 'viewAny') {
            return Response::allow();
        }
        return Response::deny();
    }

    public static function form(Schema $schema): Schema
    {
        return BukuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BukusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBukus::route('/'),
            'create' => CreateBuku::route('/create'),
            'edit' => EditBuku::route('/{record}/edit'),
        ];
    }
}
