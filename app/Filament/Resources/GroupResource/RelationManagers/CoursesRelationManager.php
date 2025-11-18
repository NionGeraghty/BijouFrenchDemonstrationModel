<?php

namespace App\Filament\Resources\GroupResource\RelationManagers;

use App\Models\Course;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;

class CoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Course Title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('access_code')
                    ->label('Access Code')
                    ->searchable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Course'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\BulkActionGroup::make([
                    Tables\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
