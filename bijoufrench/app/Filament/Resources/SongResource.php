<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SongResource\Pages;
use App\Models\Song;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;

class SongResource extends Resource
{
    protected static ?string $model = Song::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-musical-note';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Components\TextInput::make('order_column')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Order'),
                Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                Section::make('Audio File')
                    ->schema([
                        Components\FileUpload::make('mp3')
                            ->directory('songs/audio')
                            ->acceptedFileTypes(['audio/mpeg', 'audio/mp3', 'audio/wav'])
                            ->nullable(),
                        Components\TextInput::make('mp3_name')
                            ->maxLength(255)
                            ->nullable()
                            ->helperText('Original filename for the audio file'),
                    ])
                    ->columns(2),

                Section::make('Lyrics')
                    ->schema([
                        Components\FileUpload::make('lyrics')
                            ->directory('songs/lyrics')
                            ->acceptedFileTypes(['application/pdf', 'text/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->nullable(),
                        Components\TextInput::make('lyrics_name')
                            ->maxLength(255)
                            ->nullable()
                            ->helperText('Original filename for the lyrics file'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Course')
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_column')
                    ->sortable()
                    ->label('Order'),
                Tables\Columns\IconColumn::make('mp3')
                    ->boolean()
                    ->label('Has Audio'),
                Tables\Columns\IconColumn::make('lyrics')
                    ->boolean()
                    ->label('Has Lyrics'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('course', 'title'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_column');
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
            'index' => Pages\ListSongs::route('/'),
            'create' => Pages\CreateSong::route('/create'),
            'view' => Pages\ViewSong::route('/{record}'),
            'edit' => Pages\EditSong::route('/{record}/edit'),
        ];
    }
}
