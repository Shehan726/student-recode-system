<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassRoomResource\Pages;
use App\Filament\Resources\ClassRoomResource\RelationManagers;
use App\Models\ClassRoom;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassRoomResource extends Resource
{
    protected static ?string $model = ClassRoom::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup  = 'Class Rooms';

    protected static ?string $slug  = 'classrooms';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('first_name')
                //     ->label('student name')
                //     ->required(),
            //     Forms\Components\Select::make('type')
            //     ->options([
            //         'Sinhala' => 'Sinhala',
            //         'English' => 'English',
            // ])->required(), 
                // CheckboxList::make('students')
                //     ->label('Assign Students')
                //     ->relationship('students', 'first_name') // Assuming 'first_name' represents students
                //     ->options(Student::pluck('first_name', 'id'))
                //     ->columns(2)
                //     ->required(),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Class Type'),
                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject'),
                // TextColumn::make('students.first_name')
                //     ->label('Students')
                //     ->badge() // Displays assigned students as badges
                //     ->separator(', ')
                //     ->state(function ($record) {
                //         return $record->students()
                //             ->pluck('first_name')
                //             ->join(', '); // Get all students assigned to the classroom,
                //     }),
                // TextColumn::make('students.name')->label('Students')->separator(', '),

            //     Tables\Columns\TextColumn::make('students.first_name')
            //         ->label('Students')
            //         ->badge() // Displays assigned students as badges
            //         ->separator(', ')
            //         ->state(function ($record) {
            //             return $record->students->pluck('first_name')->join(', ');
            // }),
            Tables\Columns\TextColumn::make('students.first_name')
                ->label('Students')
                ->badge()
                ->separator(', ')
                ->state(function ($record) {
                return optional($record->students)->pluck('first_name')->join(', ');
            }),
        
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListClassRooms::route('/'),
            'create' => Pages\CreateClassRoom::route('/create'),
            'view' => Pages\ViewClassRoom::route('/{record}'),
            'edit' => Pages\EditClassRoom::route('/{record}/edit'),
        ];
    }
}
