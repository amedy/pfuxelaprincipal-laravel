<?php

namespace App\Providers;

use App\Events\CarFilled;
use App\Events\OrdemAnswered;
use App\Events\OrdemEnviada;
use App\Events\RequisicaoFeita;
use App\Events\PiqueteStado;
use App\Listeners\SendPiqueteStadoNotification;
use App\Listeners\estado;
use App\Listeners\SendNewBombasWarningNotification;
use App\Listeners\SendNewOrdemAnsweredNotification;
use App\Listeners\SendNewOrdemEnviadaNotification;
use App\Listeners\SendNewRequisicaoFeitaNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RequisicaoFeita::class => [
            SendNewRequisicaoFeitaNotification::class,
        ],
        OrdemEnviada::class => [
            SendNewOrdemEnviadaNotification::class,
        ],
        OrdemAnswered::class => [
            SendNewOrdemAnsweredNotification::class,
        ],
        CarFilled::class => [
            SendNewBombasWarningNotification::class,
        ],
        PiqueteStado::class =>[
            SendPiqueteStadoNotification::class,
            estado::class,

        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
