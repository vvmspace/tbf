<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class DominoCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'domino {args*}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Usage example: domino 12 21 33 44 55';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $dominos = $this->arguments()['args'];

        $left = [];
        $right = [];

        foreach ($dominos as $domino){
            $left[] = $domino[0];
            $right[] = $domino[1];
        }

        $this->info(static::Counter($left, $right));
    }

    static function Counter($left, $right){

        if(static::Check($left, $right))
            return 0;

        if((array_sum($left) % 2) != (array_sum($right) % 2))
            return -1;

        $count = 0;

        for($i = 0; $i < count($left); $i++){
            if($left[$i] != $right[$i]){
                $tmp = $left[$i];
                $left[$i] = $right[$i];
                $right[$i] = $tmp;
                $count++;
            }
            if(static::Check($left, $right))
                return $count;
        }

        return -1;
    }

    static function Check($left, $right){
        return (array_sum($left) % 2 == 0) && (array_sum($right) % 2 == 0);
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
