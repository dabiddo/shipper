<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use LaravelZero\Framework\Commands\Command;

class Calculate extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'calculate';

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
        //
        $this->info($this->CalculateSS("addresses.txt","drivers.txt"));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }

    private function CalculateSS($addressFile, $driversFile)
    {
        $baseSS = 0;

        $addresses = $this->read_addresses($addressFile);
        $drivers = $this->read_drivers($driversFile);

        $counter = 0;



        foreach($drivers as $driver)
        {
            //length of street address is even
            $streetLength = strlen($addresses[$counter]);
            $driverLength = strlen($driver);
            $score = 0;

            if($streetLength % 2 == 0)
            {
                //if length is even, SS is number of vowels in driver name multipliead by 1.5
                $score = ($this->count_Vowels($driver)*1.5);

            }else
            {
                //if lenths is odd, SS is number of consonants in drivers name multiplied by 1
                $score = ($this->count_consonants($driver) * 1);
            }

            //If length of Street address and Drivers name is the same, base SS is increased 50%
            if($streetLength == $driverLength)
            {
                $score = ($score / 2) + $score;
            }

            if($counter == 0)
            {
                $baseSS = $score;
            }

            if($score<$baseSS)
            {
                $baseSS = $score;
            }

            $this->info("Address : {$addresses[$counter]}");
            $this->info("Driver: {$driver}");
            $this->info("Score: {$score}");
            $this->info("----------------");
            $this->newLine();

            $counter++;
        }

    }

    /**
     * Return the number of vowels in a string
     */
    private function count_Vowels($string)
    {
      preg_match_all('/[aeiou]/i', $string, $matches);
      return count($matches[0]);
    }

    /**
     * Return the number of consonants in a string
     */
    private function count_consonants($string)
    {
        preg_match_all('/[bcdfghjklmnpqrstvwxyz]/i', $string, $matches);
        return count($matches[0]);
    }

    private function read_addresses($fileName)
    {
        $addressCollection = array();
        $file = fopen(storage_path("{$fileName}"), "r");

        while(!feof($file)) {
            array_push($addressCollection,fgets($file));
            //return fgets($file);
        }

        return $addressCollection;
    }

    private function read_drivers($fileName)
    {
        $driversCollection = array();
        $file = fopen(storage_path("{$fileName}"), "r");

        while(!feof($file)) {
            array_push($driversCollection,fgets($file));
            //return fgets($file);
        }

        return $driversCollection;
    }
}
