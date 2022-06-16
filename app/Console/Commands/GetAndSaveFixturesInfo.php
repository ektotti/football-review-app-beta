<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\UseCase\GetFixturesInfoUseCase;
use App\Fixture;

class GetAndSaveFixturesInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:fixturesInfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GetFixturesInfoUseCase $usecase)
    {
        parent::__construct();
        $this->usecase = $usecase;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $month = Carbon::now()->format('m');
        $fixtures = $this->usecase->run(5);
       
        foreach($fixtures as $fixtureInfo){
            $fixture = new Fixture;
            $fixture->fill($fixtureInfo)->save();                
        }
    }
}
