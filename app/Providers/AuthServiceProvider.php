<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Message;
use App\Policies\MessagePolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Message::class => MessagePolicy::class,
    ];
protected $routeMiddleware = [
    // ... other middleware ...
    'role' => \App\Http\Middleware\CheckUserRole::class,
];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('view-message', function ($user, $message) {
            return $user->id === $message->sender_id || $user->id === $message->recipient_id;
        });

        Gate::define('delete-message', function ($user, $message) {
            return $user->id === $message->sender_id;
        });

        Gate::define('mark-message-as-read', function ($user, $message) {
            return $user->id === $message->recipient_id;
        });
    }
}
