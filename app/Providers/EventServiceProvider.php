<?php

namespace App\Providers;

use App\Events\DepositApproveEvent;
use App\Events\DepositRejectEvent;
use App\Events\DepositRequestSentEvent;
use App\Events\EmailVerificationEvent;
use App\Events\ForgetPasswordVerificationEvent;
use App\Events\LoginAlertEvent;
use App\Events\LotteryBuyEvent;
use App\Events\LotteryWinnerEvent;
use App\Events\NewJobApplyEvent;
use App\Events\PasswordChangedEvent;
use App\Events\WithdrawApproveEvent;
use App\Events\WithdrawRejectEvent;
use App\Events\WithdrawRequestSentEvent;
use App\Listeners\DepositApproveListener;
use App\Listeners\DepositRejectListener;
use App\Listeners\DepositRequestSentListener;
use App\Listeners\EmailVerificationListener;
use App\Listeners\ForgetPasswordVerificationListener;
use App\Listeners\LoginAlertListener;
use App\Listeners\LotteryBuyListener;
use App\Listeners\LotteryWinnerListener;
use App\Listeners\NewJobApplyListener;
use App\Listeners\PasswordChangedListener;
use App\Listeners\WithdrawApproveListener;
use App\Listeners\WithdrawRejectListener;
use App\Listeners\WithdrawRequestSentListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        EmailVerificationEvent::class => [
            EmailVerificationListener::class,
        ],

        PasswordChangedEvent::class => [
            PasswordChangedListener::class,
        ],

        LoginAlertEvent::class => [
            LoginAlertListener::class,
        ],

        LotteryWinnerEvent::class => [
            LotteryWinnerListener::class,
        ],

        DepositRequestSentEvent::class => [
            DepositRequestSentListener::class,
        ],

        LotteryBuyEvent::class => [
            LotteryBuyListener::class,
        ],

        DepositApproveEvent::class => [
            DepositApproveListener::class,
        ],

        DepositRejectEvent::class => [
            DepositRejectListener::class,
        ],

        WithdrawRequestSentEvent::class => [
            WithdrawRequestSentListener::class,
        ],

        WithdrawApproveEvent::class => [
            WithdrawApproveListener::class,
        ],

        WithdrawRejectEvent::class => [
            WithdrawRejectListener::class,
        ]


    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
