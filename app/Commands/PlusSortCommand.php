<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class PlusSortCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'plussort {s}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Usage: "s+t+r+i+n+g"';

    static function PlusSort($s){
        $array = explode('+', $s);
        sort($array);
        return implode('+', $array);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(static::PlusSort($this->argument('s')));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
