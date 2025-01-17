<?php

namespace App\Filament\Admin\Resources\UserTypeResource\Pages;

use App\Filament\Admin\Resources\UserTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserType extends CreateRecord
{
    protected static string $resource = UserTypeResource::class;
}
