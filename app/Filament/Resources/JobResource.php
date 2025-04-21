<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Models\Job;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Career';
    protected static function getNavigationBadge(): ?string
        {
        return static::getModel()::count();
        }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\TextInput::make('title')->required(),
               Forms\Components\TextInput::make('company')->required(),
               Forms\Components\TextInput::make('location'),
               Forms\Components\Select::make('job_type')
                   ->options([
                       'Full-time' => 'Full-time',
                       'Part-time' => 'Part-time',
                       'Internship' => 'Internship',
                       'Volunteer' => 'Volunteer',
                   ])
                   ->required(),
               Forms\Components\Textarea::make('description')->required(),
               Forms\Components\TextInput::make('apply_link')->url()->label('Apply Link'),
               Forms\Components\DatePicker::make('posted_on')->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
               Tables\Columns\TextColumn::make('title')->searchable(),
               Tables\Columns\TextColumn::make('company')->sortable(),
               Tables\Columns\TextColumn::make('location'),
               Tables\Columns\BadgeColumn::make('job_type'),
               Tables\Columns\TextColumn::make('posted_on')->date(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }    
}
