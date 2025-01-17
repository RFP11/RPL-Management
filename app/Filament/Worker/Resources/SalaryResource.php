<?php

namespace App\Filament\Worker\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Salary;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Worker\Resources\SalaryResource\Pages;
use App\Filament\Worker\Resources\SalaryResource\RelationManagers;

class SalaryResource extends Resource
{
    protected static ?string $model = Salary::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

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
                Forms\Components\TextInput::make('amount')
                ->required(),
                Forms\Components\TextInput::make('user_id')
                ->required()
                ->readOnly()
                ->default(Filament::auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('user.name'),
                Tables\Columns\TextColumn::make('updated_at'),
                Tables\Columns\TextColumn::make('created_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSalaries::route('/'),
            'create' => Pages\CreateSalary::route('/create'),
            'edit' => Pages\EditSalary::route('/{record}/edit'),
        ];
    }
}
