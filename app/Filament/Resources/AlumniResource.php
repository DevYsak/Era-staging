<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Filament\Resources\AlumniResource\RelationManagers;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\AlumniResource\Pages\CreateAlumni;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

protected static ?string $navigationGroup = 'Listings';

  public static function form(Form $form): Form
{
    return $form
        ->schema([
    TextInput::make('name')->required(),
    TextInput::make('email')->email()->required(),
    TextInput::make('phone')->tel(),
    TextInput::make('batch_year'),
    Select::make('user_type')
        ->options([
            'student' => 'Student',
            'alumni' => 'Alumni',
            'faculty' => 'Faculty',
        ])->required(),
    Select::make('status')
        ->options([
            'active' => 'Active',
            'inactive' => 'Inactive',
        ])->required(),
    TextInput::make('password')
    ->password() // ← This makes it behave as a password field
    ->required(fn (\Filament\Pages\Page $livewire) => $livewire instanceof \App\Filament\Resources\AlumniResource\Pages\CreateAlumni)
    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
    ->dehydrated(fn ($state) => filled($state)),
]);
}


    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('name')->searchable(),
            TextColumn::make('email')->searchable(),
            TextColumn::make('phone'),
            TextColumn::make('batch_year'),
            TextColumn::make('user_type'),
            TextColumn::make('status'),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }    
}
