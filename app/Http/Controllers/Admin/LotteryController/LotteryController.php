<?php

namespace App\Http\Controllers\Admin\LotteryController;

use App\Events\LotteryWinnerEvent;
use App\Http\Controllers\Controller;
use App\Mail\LotteryWinnerMail;
use App\Models\Lottery;
use App\Models\LotteryTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class LotteryController extends Controller
{
    public function createLottery (Request $req)
    {
        $req->validate([
            'name' => 'required',
            'lottery_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
            'price' => 'required',
            'total_ticket' => 'required|min:1',
            'start_date' => 'required|date',
            'draw_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required',
            'total_winner' => 'required|numeric|min:1|max:' . $req->total_ticket,
            'winner_bonuses' => 'required|array|size:' . $req->total_winner,
            'winner_bonus_images' => 'array',
            'winner_bonus_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        // Save uploaded image
        $imagePath_lot = null;

        if ($req->hasFile('lottery_image')) {
            $file = $req->file('lottery_image');

            // Create a unique filename with original extension
            $filename = uniqid('lottery_', true) . '.' . $file->getClientOriginalExtension();

            // Move file directly to public/lottery_images folder
            $file->move(public_path('lottery_images'), $filename);

            // Create the image URL relative to public folder
            $imagePath_lot = '/lottery_images/' . $filename;
        }

        $combined = [];
        $winnerImages = $req->file('winner_bonus_images');

        for ($i = 0; $i < $req->total_winner; $i++) {
            $file = $winnerImages[$i] ?? null;  // safe access

            if ($file) {
                // Create a unique filename with original extension
                $filename = uniqid('winner_', true) . '.' . $file->getClientOriginalExtension();

                // Move file directly to public/winner_bonus_images folder
                $file->move(public_path('winner_bonus_images'), $filename);

                // Create the image URL relative to public folder
                $imagePath = '/winner_bonus_images/' . $filename;
            } else {
                $imagePath = null;
            }

            $combined[] = [
                'bonus' => $req->winner_bonuses[$i] ?? '',
                'image' => $imagePath,
            ];
        }
        // Create Lottery
        Lottery::create([
            'name' => $req->name,
            'lottery_image' => $imagePath_lot, // Save lottery image path
            'price' => $req->price,
            'total_ticket' => $req->total_ticket,
            'start_date' => $req->start_date,
            'draw_date' => $req->draw_date,
            'type' => $req->type,
            'total_winner' => $req->total_winner,
            'winner_bonuses' => json_encode($combined),
        ]);

        // return
        return redirect()->back()->withSuccess('Contest succesfully created');
    }

    public function getAllLottery ()
    {
        $data = Lottery::orderBy('created_at', 'desc')->paginate(15);

        return view('Admin.pages.Lottery.lotteries', ['data' => $data]);
    }

    public function activeInactiveLottery ($id)
    {
        // Get Lottery
        $lottery = Lottery::where('id', $id)->first();

        $lottery->update(
            [
                'status' => $lottery->status == 'active' ? 'inactive' : 'active',
            ]
        );

        return redirect()->back()->withSuccess('Contest status changed');
    }

    public function updateLotteryView ($id)
    {
        $lottery = Lottery::findOrFail($id);

        return view('Admin.pages.Lottery.update', ['data' => $lottery]);
    }

    // public function updateLottery (Request $req, $id)
    // {
    //     $lottery = Lottery::findOrFail($id);

    //     $lottery->update($req->all());

    //     return redirect()->route('lotteries')->withSuccess('Lottery successfully updated');
    // }

    public function updateLottery(Request $req, $id)
        {
            $lottery = Lottery::findOrFail($id);

            $req->validate([
                'name' => 'required',
                'lottery_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'price' => 'required',
                'total_ticket' => 'required|min:1',
                'start_date' => 'required|date',
                'draw_date' => 'required|date|after_or_equal:start_date',
                'type' => 'required',
                'total_winner' => 'required|numeric|min:1|max:' . $req->total_ticket,
                'winner_bonuses' => 'required|array|size:' . $req->total_winner,
                'winner_bonus_images' => 'array',
                'winner_bonus_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // === Handle lottery image ===
            $imagePath_lot = $lottery->lottery_image;

            if ($req->hasFile('lottery_image')) {
                // Delete old image from disk
                if ($imagePath_lot && file_exists(public_path($imagePath_lot))) {
                    unlink(public_path($imagePath_lot));
                }

                // Save new image
                $file = $req->file('lottery_image');
                $filename = uniqid('lottery_', true) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('lottery_images'), $filename);
                $imagePath_lot = '/lottery_images/' . $filename;
            }

            // === Handle winner bonuses ===
            $existingBonuses = json_decode($lottery->winner_bonuses, true) ?? [];
            $combined = [];
            $winnerImages = $req->file('winner_bonus_images', []);

            for ($i = 0; $i < $req->total_winner; $i++) {
                $bonusText = $req->winner_bonuses[$i] ?? '';
                $file = $winnerImages[$i] ?? null;
                $oldImagePath = $existingBonuses[$i]['image'] ?? null;

                if ($file) {
                    // Delete old winner image if exists
                    if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                        unlink(public_path($oldImagePath));
                    }

                    $filename = uniqid('winner_', true) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('winner_bonus_images'), $filename);
                    $imagePath = '/winner_bonus_images/' . $filename;
                } else {
                    $imagePath = $oldImagePath; // reuse if not changed
                }

                $combined[] = [
                    'bonus' => $bonusText,
                    'image' => $imagePath,
                ];
            }

            // === Update DB ===
            $lottery->update([
                'name' => $req->name,
                'lottery_image' => $imagePath_lot,
                'price' => $req->price,
                'total_ticket' => $req->total_ticket,
                'start_date' => $req->start_date,
                'draw_date' => $req->draw_date,
                'type' => $req->type,
                'total_winner' => $req->total_winner,
                'winner_bonuses' => json_encode($combined),
            ]);

            return redirect()->route('lotteries')->withSuccess('Lottery successfully updated');
        }


    public function statementView ()
    {
        $lottery = Lottery::with('lotteryTickets')->get();

        return view('Admin.pages.Lottery.statement', ['data' => $lottery]);
    }

    public function manualDrawView()
    {
        // Get the current date
        $currentDate = Carbon::now()->toDateString();

        // Fetch lottery data where the type is "manual" and the draw date is today or in the future
        $lotteries = Lottery::with('lotteryTickets')
                            ->where('type', 'manual')
                            ->whereDate('draw_date', '>=', $currentDate)
                            ->where('status', 'active')
                            ->get();

        return view('Admin.pages.Lottery.draw', ['data' => $lotteries]);
    }


    public function manualDraw (Request $req, $lotteryID)
    {

        // Get Lottery
        $lottery = Lottery::findOrFail($lotteryID);
        $lottery['winner_bonuses'] = json_decode($lottery->winner_bonuses);

        $winners = $req->input('winners');
        $winners = json_decode($winners);

        // Retrieve all the winners' data
        $winners = LotteryTicket::whereIn('id', $winners)->with('lottery')->with('user')->get();

        foreach ($winners as $index => $winner) {

            $rank = $index + 1;

            // Calculate prize amount based on rank or any other criteria
            $prize = $this->calculatePrize($index, $lottery); // You need to define the calculatePrize() function

            // Update the winner's status and rank in the database
            LotteryTicket::where('id', $winner->id)
            ->update([
                'status' => 'win', // Update the status to 'win'
                'rank' => $rank,   // Update the rank
                'prize' => $prize,
            ]);

            event(new LotteryWinnerEvent($winner));
        }

        // Get the IDs of the winners
        $winnerIds = $winners->pluck('id')->toArray();

        // Update all lottery tickets except for the winners with 'lose' status
        LotteryTicket::whereNotIn('id', $winnerIds)
            ->update(['status' => 'lose']);


        // Mark the lottery as completed
        $lottery->update([
            'status' => 'finished',
        ]);

        return redirect()->route('manual.draw')->withSuccess('Contest winner selected!');
    }

    // public function autoDraw ($lotteryID)
    // {
    //     // Get Lottery
    //     $lottery = Lottery::findOrFail($lotteryID);
    //     $lottery['winner_bonuses'] = json_decode($lottery->winner_bonuses);
    //     //$lottery['winner_bonuses'] = $lottery->winner_bonuses;

    //     // Check if the lottery type is manual
    //     if ($lottery->type !== 'auto') {
    //         return redirect()->back()->withErrors('This lottery is not auto draw type');
    //     }

    //     // Retrieve the total number of winners for this lottery
    //     $totalWinners = $lottery->total_winner;

    //     // Retrieve the purchased tickets for this lottery
    //     $purchasedTickets = LotteryTicket::where('lottery_id', $lotteryID)->with('user')->get();

    //     // Check if the total number of winners exceeds the total number of purchased tickets
    //     if ($totalWinners > $purchasedTickets->count()) {
    //         return redirect()->back()->withErrors('Total winners cannot exceed total purchased tickets.');
    //     }

    //     // Randomly select winners
    //     $winners = $purchasedTickets->random($totalWinners);

    //     foreach ($winners as $index => $winner) {

    //         $rank = $index + 1;

    //         // Calculate prize amount based on rank or any other criteria
    //         $prize = $this->calculatePrize($index, $lottery); // You need to define the calculatePrize() function

    //         // Update the winner's status and rank in the database
    //         LotteryTicket::where('id', $winner->id)
    //         ->update([
    //             'status' => 'win', // Update the status to 'win'
    //             'rank' => $rank,   // Update the rank
    //             'prize' => $prize,
    //         ]);

    //         event(new LotteryWinnerEvent($winner));
    //     }

    //     // Get the IDs of the winners
    //     $winnerIds = $winners->pluck('id')->toArray();

    //     // Update all lottery tickets except for the winners with 'lose' status
    //     LotteryTicket::whereNotIn('id', $winnerIds)
    //         ->update(['status' => 'lose']);


    //     // Mark the lottery as completed
    //     $lottery->update([
    //         'status' => 'finished',
    //     ]);

    //     return redirect()->back()->withSuccess('Contest winner selected!');
    // }

   public function autoDraw()
            {
            $lotteries = Lottery::where('type', 'auto')
                ->whereDate('draw_date', '<=', \Carbon\Carbon::today()) // catch up missed draws too
                ->where('status', '!=', 'finished')
                ->get();

                foreach ($lotteries as $lottery) {
                    try {
                        $winnerBonuses = json_decode($lottery->winner_bonuses, true); // decode as array

                        $totalWinners = $lottery->total_winner;

                        $purchasedTickets = \App\Models\LotteryTicket::where('lottery_id', $lottery->id)
                            ->with('user')
                            ->get();

                        if ($totalWinners > $purchasedTickets->count()) {
                            \Log::warning("Lottery ID {$lottery->id}: Winners exceed purchased tickets.");
                            continue;
                        }

                        $winners = $purchasedTickets->random($totalWinners);

                        foreach ($winners as $index => $winner) {
                            $rank = $index + 1;
                            $prize = $this->calculatePrize($index, $winnerBonuses); // pass bonuses here

                            \App\Models\LotteryTicket::where('id', $winner->id)->update([
                                'status' => 'win',
                                'rank' => $rank,
                                'prize' => $prize,
                            ]);

                            event(new \App\Events\LotteryWinnerEvent($winner));
                        }

                        $winnerIds = $winners->pluck('id')->toArray();
                        
                        \App\Models\LotteryTicket::where('lottery_id', $lottery->id)
                            ->whereNotIn('id', $winnerIds)
                            ->update(['status' => 'lose']);

                    // \DB::listen(function ($query) {
                    //     $sql = $query->sql;
                    //     foreach ($query->bindings as $binding) {
                    //         $value = is_numeric($binding) ? $binding : "'{$binding}'";
                    //         $sql = preg_replace('/\?/', $value, $sql, 1);
                    //     }
                    //     echo "Executed Query: " . $sql . PHP_EOL;
                    // });
        $lottery->update(['status' => 'finished']);

            \Log::info("Lottery ID {$lottery->id}: Winners selected successfully.");
        } catch (\Exception $e) {
            \Log::error("AutoDraw failed for Lottery ID {$lottery->id}: " . $e->getMessage());
        }
    }

    return "All eligible auto-draw lotteries processed.";
}


   public function calculatePrize($index, $winnerBonuses)
    {
        // Get prize from bonus list based on index
        if (isset($winnerBonuses[$index]['bonus'])) {
            return $winnerBonuses[$index]['bonus'];
        }

        // Default fallback if no bonus is defined
        return 0;
    }

}
