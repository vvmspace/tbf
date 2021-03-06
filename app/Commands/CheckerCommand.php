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

        $first = null;

        $this->info('Input file: ' . $input);
        $this->info('Output file: ' . $output);
        $this->info('');

        if(file_exists($input)){
            $this->info('File ' . $input . ' exist');
            $fi = fopen($input, 'r');
            $fo = fopen($output, 'w');
            while (($host = fgets($fi)) !== false){
                $host = trim($host);
                $this->info('Checking ' . $host);
                if(static::Check('http://' . $host)){
                    $this->info('Ok');
                    fputs($fo, "$host\r\n");
                    $first = $first ?? $host;
                }else{
                    $this->warn('Error');
                }
            }
            fclose($fi);
        }else{
            $this->error('File ' . $input . ' not exist');
        }

        if(!empty($first)){
            exec('google-chrome http://' . $first);
        }
    }


    static function Check($url, $timeout = 1000){
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, true);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT_MS, $timeout);
        curl_exec($curlHandle);
        $response = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);
        curl_close($curlHandle);
        return ($response > 0) && ($response < 400);
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
