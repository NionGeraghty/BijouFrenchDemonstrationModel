<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;
use Filament\Forms;

class ManageGames extends EditRecord
{
    protected static string $resource = CourseResource::class;

    public function getHeading(): string
    {
        return 'Manage Games: ' . $this->record->title;
    }

    public static function getNavigationLabel(): string
    {
        return 'Games';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Section::make('Games Configuration')
                    ->description('Configure different types of games for this course')
                    ->schema([
                        Forms\Components\Toggle::make('games_active')
                            ->label('Games Active')
                            ->default(false)
                            ->helperText('Enable or disable all games for this course')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('reorder_games')
                            ->label('Reorder Games')
                            ->schema([
                                Forms\Components\TextInput::make('question')
                                    ->label('Question')
                                    ->helperText('Scrambled text - No capital letters!')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('solution')
                                    ->label('Solution')
                                    ->helperText('Correct order - No capital letters!')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['question'] ?? 'New game')
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull()
                            ->reorderable(),

                        Forms\Components\Repeater::make('odd_one_out_games')
                            ->label('Odd One Out Games')
                            ->schema([
                                Forms\Components\Textarea::make('question')
                                    ->label('Question')
                                    ->helperText('One option per line')
                                    ->required()
                                    ->rows(4)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('solution')
                                    ->label('Solution')
                                    ->helperText('Which one is the odd one out?')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['solution'] ?? 'New game')
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull()
                            ->reorderable(),

                        Forms\Components\Repeater::make('category_games')
                            ->label('Category Games')
                            ->schema([
                                Forms\Components\Textarea::make('game')
                                    ->label('Game')
                                    ->helperText('One option per line. Use the format word:category for each line')
                                    ->required()
                                    ->rows(6)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => 'Category Game ' . ($state['hint'] ?? ''))
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull()
                            ->reorderable(),

                        Forms\Components\Repeater::make('match_up_games')
                            ->label('Match Up Games')
                            ->schema([
                                Forms\Components\Textarea::make('game')
                                    ->label('Game')
                                    ->helperText('One option per line. Use the format question:answer for each line.')
                                    ->required()
                                    ->rows(6)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('hint')
                                    ->label('Hint')
                                    ->helperText('Optional')
                                    ->columnSpanFull(),
                            ])
                            ->itemLabel(fn (array $state): ?string => 'Match Up Game ' . ($state['hint'] ?? ''))
                            ->collapsed()
                            ->cloneable()
                            ->collapsible()
                            ->defaultItems(0)
                            ->columnSpanFull()
                            ->reorderable(),
                    ]),
            ]);
    }
}

