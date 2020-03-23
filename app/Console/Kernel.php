<?php
declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Application;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Create a new console kernel instance.
     *
     * @param \Laravel\Lumen\Application $app
     */
    public function __construct(Application $app)
    {
        $this->commands = [];

        parent::__construct($app);
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) Signature matches parent class
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
