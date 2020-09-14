<?php

namespace App\Console;

use App\Console\Commands\WeeklySubscribersPosts;
use App\Model\Settings;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        WeeklySubscribersPosts::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('weekly:send_posts')->everyMinute();
        if(Schema::hasTable('settings')) {

            if(Settings::first()){
                $weeklyPosts = Settings::where('type','weeklyPosts')->first();
                if($weeklyPosts){
                    $schedule->command('weekly:send_posts')
//                        ->everyMinute();
                        ->weeklyOn(4, ($weeklyPosts->value));
                }

            }
        }
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
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
