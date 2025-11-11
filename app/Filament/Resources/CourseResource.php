<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Filament\Resources\CourseResource\RelationManagers;
use App\Models\Course;
use Filament\Forms\Components;
use Filament\Forms\Get;

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
use Filament\Schemas\Components\Section;
use BackedEnum;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Basic Information')
                    ->schema([
                        Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('access_code')
                            ->maxLength(255)
                            ->nullable()
                            ->helperText('Optional access code for course enrollment'),
                        Components\Select::make('article_id')
                            ->relationship('article', 'title')
                            ->searchable()
                            ->preload()
                            ->nullable(),

                    ])
                    ->columns(2),

                Section::make('Games Configuration')
                    ->schema([
                        Components\Toggle::make('games_active')
                            ->label('Games Active')
                            ->default(false)
                            ->live()
                            ->columnSpanFull(),

                        Components\Repeater::make('reorder_games')
                            ->label('Reorder Games')
                            ->schema([
                                Components\TextInput::make('question')
                                    ->label('Question')
                                    ->helperText('Scrambled text - No capital letters!')
                                    ->required()
                                    ->columnSpanFull(),
                                Components\TextInput::make('solution')
                                    ->label('Solution')
                                    ->helperText('Correct order - No capital letters!')
                                    ->required()
                                    ->columnSpanFull(),
                                Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? 'New game')
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull(),

                        Components\Repeater::make('odd_one_out_games')
                            ->label('Odd One Out Games')
                            ->schema([
                                Components\Textarea::make('question')
                                    ->label('Question')
                                    ->helperText('One option per line')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                                Components\TextInput::make('solution')
                                    ->label('Solution')
                                    ->helperText('Which one is the odd one out?')
                                    ->required()
                                    ->columnSpanFull(),
                                Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['solution'] ?? 'New game')
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull(),

                        Components\Repeater::make('category_games')
                            ->label('Category Games')
                            ->schema([
                                Components\Textarea::make('game')
                                    ->label('Game')
                                    ->helperText('One option per line. Use the format word:category for each line')
                                    ->required()
                                    ->rows(6)
                                    ->columnSpanFull(),
                                Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => 'Category Game ' . ($state['hint'] ?? ''))
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull(),

                        Components\Repeater::make('match_up_games')
                            ->label('Match Up Games')
                            ->schema([
                                Components\Textarea::make('game')
                                    ->label('Game')
                                    ->helperText('One option per line. Use the format question:answer for each line.')
                                    ->required()
                                    ->rows(6)
                                    ->columnSpanFull(),
                                Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => 'Match Up Game ' . ($state['hint'] ?? ''))
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull(),

                    ])
                    ->collapsible()
                    ->collapsed(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('access_code')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('groups_count')
                    ->counts('groups')
                    ->label('Groups'),
                Tables\Columns\TextColumn::make('article.title')
                    ->label('Article')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('games_active')
                    ->boolean()
                    ->label('Games'),
                Tables\Columns\TextColumn::make('activities_count')
                    ->counts('activities')
                    ->label('Activities'),
                Tables\Columns\TextColumn::make('songs_count')
                    ->counts('songs')
                    ->label('Songs'),
                Tables\Columns\TextColumn::make('game_attempts_count')
                    ->counts('gameAttempts')
                    ->label('Game Attempts'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                Tables\Filters\TernaryFilter::make('games_active'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ActivitiesRelationManager::class,
            RelationManagers\SongsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
            'games' => Pages\ManageGames::route('/{record}/games'),
        ];
    }
}
