<?php

namespace App\Filament\Resources\TestingResource\Pages;

use App\Filament\Resources\TestingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTesting extends CreateRecord
{
    protected static string $resource = TestingResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Data berhasil disimpan';
    }
}
