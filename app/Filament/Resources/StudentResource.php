<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use App\Notifications\StudentRegisteredNotification;
// use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Notifications\Notification;


class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup  = 'Students';

    protected static ?string $slug  = 'students';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nic')
                    ->required()
                    ->maxLength(255)
                    ->required(),

                Forms\Components\Select::make('type')
                    ->options([
                        'Class A' => 'Class A',
                        'Class B' => 'Class B',
                    ])->required()
                    ->multiple()
                    ->relationship('classrooms', 'type'),

                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),


                // Forms\Components\TextInput::make('review_code')
                //     ->label('Review Code')
                //     ->required()
                //     ->afterStateUpdated(function ($state, $record) {
                //         if ($state === 'APPROVE123') {
                //             $record->status = 'approved';
                //         } elseif ($state === 'REJECT456') {
                //             $record->status = 'rejected';
                //         } else {
                //             $record->status = 'pending';
                //         }
                //         $record->save();
                //     }),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    
                    ]),
                    // ->disabled(),

                DatePicker::make('date_of_birth')
                    ->label('Date Of Birth')
                    ->required()
                    ->native(false) // Optional: Uses Filament's custom date picker instead of the browser's default
                    ->minDate('1900-01-01') // Optional: Restrict minimum date
                    ->maxDate(now()),
                FileUpload::make('image')
                    ->label('Profile Image')
                    ->image()
                    // ->directory('uploads/users') 
                    ->disk('public') // Make sure the file is uploaded to 'public' disk
                    ->directory('students') // Specify the folder where the image will be saved
                    ->visibility('public'), // Ensure the image is publicly accessible

                FileUpload::make('pdf')
                    ->label('Upload PDF')
                    ->storeFileNamesIn('pdf')
                    ->disk('public')
                    ->directory('students/pdfs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->visibility('public')
                    ->maxSize(5120),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Profile Image')
                    ->url(fn($record) => asset('storage/' . $record->image))
                    // ImageColumn::make('author.avatar')
                    ->circular(),


                Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name'),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('contact_no')
                    ->label('Phone'),
                Tables\Columns\TextColumn::make('nic')
                    ->label('NIC'),
                Tables\Columns\TextColumn::make('type')
                    ->label('Class Type'),
                Tables\Columns\TextColumn::make('address')
                    ->label('Address'),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->label('DOB'),
        
                BadgeColumn::make('status')
                ->label('Status')
                ->color(fn ($state) => match ($state) {
                    'pending' => 'warning',  // Yellow
                    'approved' => 'success', // Green
                    'rejected' => 'danger',  // Red
                }),
    
                Tables\Columns\TextColumn::make('pdf')
                    ->label('PDF File')
                    ->formatStateUsing(fn($record) => $record->pdf
                        ? '<a href="' . asset('storage/' . $record->pdf) . '" target="_blank" class="text-blue-500 underline">Download</a>'
                        : 'No File')
                    ->html(),

                // TextColumn::make('classrooms.name')
                //     ->label('Classrooms')
                //     // ->badge() // Shows classes as badges
                //     // ->limit(3), // Show max 3 classes in table


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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
