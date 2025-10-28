<?php

namespace App\Filament\Resources\CohortResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;

class CoursesRelationManager extends RelationManager
{
    protected static string $relationship = 'courses';
    protected static ?string $recordTitleAttribute = 'title';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('access_code')
                    ->label('Access Code')
                    ->toggleable(),

                // ✅ Add a toggle column for "Active" course
                Tables\Columns\ToggleColumn::make('active')
                    ->label('Active')
                    ->afterStateUpdated(function (Model $record, $state) {
                        if ($state && $record->cohort_id) {
                            // Deactivate all other courses for this cohort
                            $record->where('cohort_id', $record->cohort_id)
                                ->where('id', '!=', $record->id)
                                ->update(['active' => false]);
                        }
                    }),

                Tables\Columns\IconColumn::make('games_active')
                    ->boolean()
                    ->label('Games Active'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
