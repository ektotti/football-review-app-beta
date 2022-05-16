<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use Nesk\Puphpeteer\Puppeteer;
// use App\UseCase\GetLineupUseCase;
use App\Fixture;
use App\Member;
use App\UseCase\GetLineupUseCase;
use Carbon\Carbon;
// use App\Member;

class GetAndSaveLineup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:lineup';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $searchFrom = new Carbon('now');
        // dd($searchFrom);
        $searchTo = new Carbon('-30 days');
        // dd("2022-04-02 14:03:00" > $searchFrom);

        // $fixtures = Fixture::where('fixture_date_time', '>', $searchFrom)->where('fixture_date_time', '<', $searchTo)->get();
        $fixtures = Fixture::all();
        $fixtures = $fixtures->toArray();
        // dd($fixtures);
        if($fixtures) {
            foreach($fixtures as $fixture){

                if(Member::where('fixture_id', $fixture['id'])->where('team_name', $fixture['hometeam_name'])->first()) {
                    continue;
                }

                $homeTeamLineup = Member::create([
                    'fixture_id' => $fixture['id'],
                    'team_name' => $fixture['hometeam_name'],
                    'status' => 'home',
                ]);
    
                $awayTeamLineup = Member::create([
                    'fixture_id' => $fixture['id'],
                    'team_name' => $fixture['awayteam_name'],
                    'status' => 'away',
                ]);
    
                $matchUrl = $fixture['fixture_url'];
                $playerNameLists = GetLineupUseCase::run($matchUrl.'#live');
                
                $homeTeamLineup->fill($playerNameLists[0])->save();
                $awayTeamLineup->fill($playerNameLists[1])->save();

                sleep(30);
            }
        }
    }
}