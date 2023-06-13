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
        //$this->info($this->CalculateSS("addresses.txt","drivers.txt"));
        $results = $this->CalculateSS("street_names.txt","drivers.txt");

        foreach($results as $result){
            $this->info("Address : {$result['street']}");
            $this->info("Driver: {$result['driver']}");
            $this->info("Score: {$result['score']}");
            $this->info("----------------");
            $this->newLine();
        }
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

    public function CalculateSS($addressFile, $driversFile)
    {
        $baseSS = 0;
        $results = array();
        $counter = 0;

        //Get file arrays
        $addresses = $this->read_addresses($addressFile);

        $drivers = $this->read_drivers($driversFile);


        //Since each driver can only have one address, we will iterate from that list
        foreach($drivers as $driver)
        {
            //Files to array is return the break line as part of the string, therefore we need to remove it.
            $streetLength = strlen(preg_replace("/\r|\n/","",$addresses[$counter]));
            $driverLength = strlen(preg_replace("/\r|\n/","",$driver));
            $score = 0;
            $result['driver'] = $driver;
            //$result['street'] = $streetLength;
            $result['street'] = $addresses[$counter];

            $isEven = $streetLength % 2;

            if( $isEven == 0)
            {
                //if length is even, SS is number of vowels in driver name multipliead by 1.5
                $vowels = $this->count_Vowels($driver);
                $score = $vowels*1.5;

            }else{
                //if length is odd, SS is number of consonants in drivers name multiplied by 1
                $score = ($this->count_consonants($driver) * 1);
            }

            //If length of Street address and Drivers name is the same, base SS is increased 50%
            if($streetLength == $driverLength)
            {
                $newscore = ($score / 2) + $score;

            }

            $result['score'] = $score;

            array_push($results,$result);

            $counter++;
        }

        return $results;

    }

    /**
     * Return the number of vowels in a string
     */
    public function count_Vowels($string)
    {
      preg_match_all('/[aeiou]/i', $string, $matches);
      return count($matches[0]);
    }

    /**
     * Return the number of consonants in a string
     */
    public function count_consonants($string)
    {
        preg_match_all('/[bcdfghjklmnpqrstvwxyz]/i', $string, $matches);
        return count($matches[0]);
    }

    private function read_addresses($fileName)
    {
        $addressCollection = file(storage_path($fileName), FILE_IGNORE_NEW_LINES);
        return $addressCollection;
    }

    private function read_drivers($fileName)
    {
        $driversCollection = file(storage_path($fileName), FILE_IGNORE_NEW_LINES);
        return $driversCollection;
    }
}
