<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;

use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Container\Attributes\Auth;

class CreateStudent extends CreateRecord
{
    protected static string $resource = StudentResource::class;

    // protected function getRedirectUrl(): string
    // {
    //     $first_name = Auth::user() -> first_name;
    //     Notification::make()
    //         ->success()
    //         ->title('post created by'. $first_name)
    //         ->body('new post has been saved')
    //         ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());

    //     return $this->previousUrl ?? $this->getResource()::getUrl('index');
    // }   

    // protected function beforeSave(): void
    // {
    //     Notification::make()
    //         ->title('deed')
    //         ->sendToDatabase(\auth()->user());    
    // }
}
