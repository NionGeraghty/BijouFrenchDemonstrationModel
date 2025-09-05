<?php

namespace App\Filament\Resources\GameAttemptResource\Pages;

use App\Filament\Resources\GameAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGameAttempts extends ListRecords
{
    protected static string $resource = GameAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
