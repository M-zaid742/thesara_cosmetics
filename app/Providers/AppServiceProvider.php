<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            // Get latest 5 messages and unread count
            $messages = Contact::latest()->take(5)->get();
            $messageCount = Contact::where('is_read', 0)->count(); 
            // Get latest 5 notifications and unread count
            $notifications = Notification::latest()->take(5)->get();
            $notificationCount = Notification::whereNull('read_at')->count();

            // Pass variables to all views
            $view->with([
                'messages' => $messages,
                'messageCount' => $messageCount,
                'notifications' => $notifications,
                'notificationCount' => $notificationCount,
            ]);
        });
    }
}