<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class SongsRelationManager extends RelationManager
{
    protected static string $relationship = 'songs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('mp3')
                    ->label('MP3 File')
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3'])
                    ->directory('songs/audio')
                    ->downloadable()
                    ->openable()
                    ->nullable(),
                Forms\Components\FileUpload::make('lyrics')
                    ->label('Lyrics File')
                    ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->directory('songs/lyrics')
                    ->downloadable()
                    ->openable()
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mp3_name')
                    ->label('MP3')
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('lyrics_name')
                    ->label('Lyrics')
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('order_column')
                    ->label('Order')
                    ->sortable(),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column', 'asc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $maxOrder = static::getOwnerRecord()
                            ->songs()
                            ->max('order_column') ?? 0;

                        $data['order_column'] = $maxOrder + 1;

                        return $data;
                    }),
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
}
