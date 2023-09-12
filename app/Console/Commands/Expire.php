<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class expire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Expire:User';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End theExpiration of User Every 5 Minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users=User::where('expire',0)->get();
        foreach($users as $user)
        {
            $user->update(['expire'=>1]);
        }
    }
}
