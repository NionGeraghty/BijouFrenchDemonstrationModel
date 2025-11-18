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

                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Add Course'),
            ])
            ->actions([
                Tables\Actions\Action::make('setActive')
                    ->label('Set Active')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Course $record): void {

                        // deactivate all courses in this group
                        Course::where('group_id', $record->group_id)
                            ->update(['active' => false]);

                        // activate selected course
                        $record->update(['active' => true]);
                    }),
            ])
            ->bulkActions([]);
    }
}
