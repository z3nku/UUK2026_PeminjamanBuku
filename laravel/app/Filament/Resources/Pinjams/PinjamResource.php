<?php

namespace App\Filament\Resources\Pinjams;

use App\Filament\Resources\Pinjams\Pages\CreatePinjam;
use App\Filament\Resources\Pinjams\Pages\EditPinjam;
use App\Filament\Resources\Pinjams\Pages\ListPinjams;
use App\Filament\Resources\Pinjams\Schemas\PinjamForm;
use App\Filament\Resources\Pinjams\Tables\PinjamsTable;
use App\Models\Pinjam;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Override;
use UnitEnum;

class PinjamResource extends Resource
{
    protected static ?string $model = Pinjam::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    #[Override]
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }
        return $query;
    }

    #[Override]
    public static function getAuthorizationResponse(string|UnitEnum $action, ?Model $record = null): Response
    {
        if ($action === 'viewAny') {
            return Response::allow();
        }
        return Response::deny();
    }

    public static function form(Schema $schema): Schema
    {
        return PinjamForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PinjamsTable::configure($table);
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
            'index' => ListPinjams::route('/'),
            'create' => CreatePinjam::route('/create'),
            'edit' => EditPinjam::route('/{record}/edit'),
        ];
    }
}
