<div class="relative">
    <button class="text-white focus:outline-none">
        Notifications ({{ auth()->user()->unreadNotifications->count() }})
    </button>

    <div class="absolute bg-white shadow-md rounded mt-2 w-64">
        @foreach(auth()->user()->unreadNotifications as $notification)
            <div class="p-2 border-b">
                <p>{{ $notification->data['message'] }}</p>
                <button wire:click="markAsRead('{{ $notification->id }}')" class="text-blue-500 text-xs">Mark as read</button>
            </div>
        @endforeach
    </div>
</div>
