<?php

namespace App\Filament\Worker\Resources\OvertimeResource\Pages;

use App\Filament\Worker\Resources\OvertimeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOvertimes extends ListRecords
{
    protected static string $resource = OvertimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
