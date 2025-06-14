<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateReferCodes extends Command
{
    protected $signature = 'refercodes:generate';

    protected $description = 'Generate OLD users refer code';

    public function handle()
    {
        $usersWithoutReferCode = DB::table('users')->whereNull('refer_code')->get();

        foreach ($usersWithoutReferCode as $user) {
            $referCode = $this->generateUniqueReferCode();

            DB::table('users')->where('id', $user->id)->update(['refer_code' => $referCode]);
        }

        $this->info('Unique refer codes generated for old users.');
    }

    private function generateUniqueReferCode()
    {
        return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    }
}
