<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameAttemptResource\Pages;
use App\Models\GameAttempt;
use Filament\Forms\Components;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;

class GameAttemptResource extends Resource
{
    protected static ?string $model = GameAttempt::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Components\Select::make('course_id')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Player Name'),
                Components\DateTimePicker::make('completed_at')
                    ->nullable()
                    ->label('Completion Time'),
                Components\Textarea::make('nonce')
                    ->maxLength(255)
                    ->nullable()
                    ->helperText('Security nonce for the game attempt'),
                Components\KeyValue::make('game_data')
                    ->label('Game Data')
                    ->keyLabel('Property')
                    ->valueLabel('Value')
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Player'),
                Tables\Columns\TextColumn::make('course.title')
                    ->label('Course')
                    ->sortable(),
                Tables\Columns\TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Completed'),
                Tables\Columns\IconColumn::make('completed_at')
                    ->boolean()
                    ->label('Finished')
                    ->getStateUsing(fn ($record) => !is_null($record->completed_at)),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Started')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('nonce')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('course')
                    ->relationship('course', 'title'),
                Tables\Filters\Filter::make('completed')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('completed_at'))
                    ->label('Completed attempts'),
                Tables\Filters\Filter::make('in_progress')
                    ->query(fn (Builder $query): Builder => $query->whereNull('completed_at'))
                    ->label('In progress'),
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
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListGameAttempts::route('/'),
            'create' => Pages\CreateGameAttempt::route('/create'),
            'view' => Pages\ViewGameAttempt::route('/{record}'),
            'edit' => Pages\EditGameAttempt::route('/{record}/edit'),
        ];
    }
}
