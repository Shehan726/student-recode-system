<?php

namespace App\Livewire;

use App\Models\Student;
use App\Models\User;
use Doctrine\DBAL\Query;
use Filament\Notifications\Notification;
use Livewire\Component;
use view;

class DatabaseNotifications extends Component
{


    public function render()
    {

        // Student::insert($data);

        // Notification::make()
        //     ->success()
        //     ->title('Murid'.$this->first_name. 'telthmendafter')
        //     ->sendToDatabase(Student::whereHas('roles',function ($query){
        //         $query->where('first_name', 'admin');
        //     })->get());
        // return view('livewire.database-notifications');
    }
}
