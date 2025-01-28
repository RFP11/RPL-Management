<?php

namespace App\Filament\Student\Resources;

use App\Models\Book;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Validation\Rules\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Student\Resources\BookResource\Pages;
use App\Filament\Student\Resources\BookResource\RelationManagers;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Lecture';
    
    public static function getEloquentQuery(): Builder
    {
        /** @var User $user */
        $user = Filament::auth()->user();

        return parent::getEloquentQuery()->whereBelongsTo($user);
    }

    public static function form(Form $form): Form
    {   

        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                ->default(Filament::auth()->id()), 

                Forms\Components\TextInput::make('title')
                    ->required(),
    
                Forms\Components\Select::make('filetype')
                    ->required()
                    ->options([
                        'pdf' => 'PDF',
                        'epub' => 'EPUB',
                        'docx' => 'DOCX',
                        'pptx' => 'PPTX',
                    ]),

                Forms\Components\FileUpload::make('filename')
                    ->rules([
                        File::types(['pdf', 'docx', 'pptx']),
                    ])
                    ->disk('public') 
                    ->required(),
                
                Forms\Components\Select::make('category')
                ->options([
                        'learning_material' => 'Learning Material',
                       'journal' => 'Journal',
                       'books' => 'Book',
                       'thesis' => 'Thesis',
                ]) 
                ->required(),
                    
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('filename'),
                Tables\Columns\TextColumn::make('filetype'),

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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
