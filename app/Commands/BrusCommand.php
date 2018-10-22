<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class BrusCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'brus {a} {b}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arr1 = explode(' ', $this->argument('a'));
        $arr2 = explode(' ', $this->argument('b'));

        $this->info(static::BCnt($arr1, $arr2));
    }

    static function BCnt($first, $second){
        $n = 0;
        foreach($first as $a){
            $n += count(array_filter($second, function($b) use ($a){
                return ($b == $a + 1) || ($b == $a - 1);
            }));
        }
        return $n;
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
