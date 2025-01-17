<?php

namespace App\Filament\Worker\Resources;

use App\Filament\Worker\Resources\OvertimeResource\Pages;
use App\Filament\Worker\Resources\OvertimeResource\RelationManagers;
use App\Models\Overtime;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OvertimeResource extends Resource
{
    protected static ?string $model = Overtime::class;

    protected static ?string $navigationGroup = 'Income';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function getEloquentQuery(): Builder
    {
        /** @var User $user */
        $user = auth()->user();

        return parent::getEloquentQuery()->whereBelongsTo($user);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListOvertimes::route('/'),
            'create' => Pages\CreateOvertime::route('/create'),
            'edit' => Pages\EditOvertime::route('/{record}/edit'),
        ];
    }
}
