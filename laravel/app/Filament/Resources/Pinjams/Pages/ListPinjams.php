<?php

namespace App\Filament\Resources\Pinjams\Pages;

use App\Filament\Resources\Pinjams\PinjamResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPinjams extends ListRecords
{
    protected static string $resource = PinjamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
