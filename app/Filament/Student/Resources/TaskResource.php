<?php

namespace App\Filament\Student\Resources;

use Filament\Forms;
use App\Models\Task;
use Filament\Tables;
use App\Models\Status;
use App\Models\Subject;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Student\Resources\TaskResource\Pages;
use App\Filament\Student\Resources\TaskResource\RelationManagers;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Lecture';

    public static function getEloquentQuery(): Builder
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return parent::getEloquentQuery()->whereBelongsTo($user);
    }

    public static function form(Form $form): Form
    {
        $userid = Filament::auth()->id();
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                ->required(),
                Forms\Components\TextArea::make('description')
                ->required(),
                Forms\Components\Select::make('subject_id')
                ->options(Subject::where('user_id', $userid)->pluck('name', 'id')),
                Forms\Components\DateTimePicker::make('deadline')
                ->seconds(false),
                Forms\Components\Select::make('status_id')
                ->required()
                ->options(Status::where('name', 'regexp', '^(Task-)(\w+)')->pluck('name', 'id')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('subject_id'),
                Tables\Columns\TextColumn::make('deadline'),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
