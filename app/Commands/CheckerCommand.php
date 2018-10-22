<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class CheckerCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'checker {input=input.txt} {output=output.txt}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Usage: checker input_file output_file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $input = $this->argument('input');
        $output = $this->argument('output');

        $this->info('Input file: ' . $input);
        $this->info('Output file: ' . $output);
        $this->info('');

        if(file_exists($input)){
            $this->info('File ' . $input . ' exist');
            $fi = fopen($input, 'r');
            while (($host = fgets($fi)) !== false){
                $this->info('Checking ' . $host);
            }
            fclose($fi);
        }else{
            $this->error('File ' . $input . ' not exist');
        }
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
