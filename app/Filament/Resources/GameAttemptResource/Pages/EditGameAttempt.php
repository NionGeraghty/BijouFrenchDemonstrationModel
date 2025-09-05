<?php

namespace App\Filament\Resources\GameAttemptResource\Pages;

use App\Filament\Resources\GameAttemptResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGameAttempt extends EditRecord
{
    protected static string $resource = GameAttemptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
