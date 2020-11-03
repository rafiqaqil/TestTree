<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\MidnightUpdatePool;

use App\Console\Commands\calcAll;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
      
        
        MidnightUpdatePool::class,
         calcAll::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
     
        \App\Models\DM3tree::fixTree();
        echo" Fix Tree DM3   ";
        
            $schedule->command('midnightupdatepool:now')->timezone('Asia/Kuala_Lumpur')->dailyAt('00:01');
            //
          $schedule->command('calcAll:now')->timezone('Asia/Kuala_Lumpur')->hourly();
         
            
             //$schedule->command('   calcAll:now')->timezone('Asia/Kuala_Lumpur')->everyMinute();
         
    }

    /**protected function schedule(Schedule $schedule)
{

    $schedule->call(function () {

        // your schedule code
        Log::info('Working');
        
    })->everyMinute();

}
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
