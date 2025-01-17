<?php

namespace App\Filament\Admin\Resources\UserTypeResource\Pages;

use App\Filament\Admin\Resources\UserTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserType extends EditRecord
{
    protected static string $resource = UserTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
