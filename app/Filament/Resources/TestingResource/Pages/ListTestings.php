<?php

namespace App\Filament\Resources\TestingResource\Pages;

use App\Filament\Resources\TestingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTestings extends ListRecords
{
    protected static string $resource = TestingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
