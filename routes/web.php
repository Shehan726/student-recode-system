<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Route::get('store', function() {
//     $recipients = auth()->user();

//     \Filament\Notifications\Notification::make()
//         ->title('huhuuhhu')
//         ->sendToDatabase($recipients);
    
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [StudentController::class, 'create'])->name('create');
Route::post('/register', [StudentController::class, 'store'])->name('store');
// Route::get('/send-notification', [StudentController::class, 'notifyAdmin']);
Route::get('/send-test-notification', [StudentController::class, 'sendTestNotification']);

// Route::post('/students/{student}/resubmit', [StudentController::class, 'resubmit'])
//     ->name('students.resubmit');
