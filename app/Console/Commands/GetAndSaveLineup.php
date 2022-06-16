<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Fixture;
use App\Member;
use App\UseCase\GetLineupUseCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function PHPUnit\Framework\throwException;

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
        DB::beginTransaction();
        try {
            Member::where('player_1', null)->delete();

            $now = Carbon::now()->toDateTimeString();
            file_put_contents('/tmp/sample.log', $now . PHP_EOL, FILE_APPEND);
            $searchFrom = new Carbon('now');
            // dd($searchFrom);
            $searchTo = new Carbon('-30 days');
            // dd($searchTo);

            $fixtures = Fixture::where('fixture_date_time', '<', $searchFrom)->where('fixture_date_time', '>', $searchTo)->get();
            // $fixtures = Fixture::where('fixture_date_time', '>', $searchTo)->get();
            // dd($fixtures);
            $fixtures = $fixtures->toArray();
            if ($fixtures) {
                foreach ($fixtures as $key => $fixture) {

                    if (Member::where('fixture_id', $fixture['id'])->where('team_name', $fixture['hometeam_name'])->first()) {
                        continue;
                    }
                    Log::debug($fixture);

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
                    $playerNameLists = GetLineupUseCase::run($matchUrl . '#live');

                    $homeTeamLineup->fill($playerNameLists[0])->save();
                    $awayTeamLineup->fill($playerNameLists[1])->save();

                    DB::commit();
                    sleep(10);
                }
            }
        } catch (\Throwable $th) {
            Log::debug('ラインナップエラー' . $th->getMessage());
            DB::rollBack();
            Artisan::call('get:lineup');
        }
    }
}
