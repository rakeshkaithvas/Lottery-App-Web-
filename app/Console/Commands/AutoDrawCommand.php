<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\LotteryController\LotteryController;
use App\Models\Lottery;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AutoDrawCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:draw';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically trigger the autodraw function when a lottery draw is available';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find lotteries with auto-draw enabled and draw date today
        $lotteries = Lottery::where('type', 'auto')->whereDate('draw_date', Carbon::today())->get();

       foreach ($lotteries as $lottery) {
                try {
                    $controller = new LotteryController();
                    $message = $controller->autoDraw($lottery->id);
                    $this->info($message);
                } catch (\Exception $e) {
                    \Log::error("AutoDraw failed for Lottery ID {$lottery->id}: " . $e->getMessage());
                    $this->error("AutoDraw failed for Lottery ID {$lottery->id}: " . $e->getMessage());
                }
        }

    }
}
