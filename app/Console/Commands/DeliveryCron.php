<?php

namespace App\Console\Commands;

use App\Mail\DeliveryMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DeliveryCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delivery:cron';

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
     * @return int
     */
    public function handle()
    {
        /*  $users = User::whereMonth('date_of_birth', '=', date('m'))->whereDay('date_of_birth', '=', date('d'))->get();
 */

        $user = [
            'id' => 1,
            'name' => 'cesarin'
        ];

        /*  foreach($users as $key => $user)

        {

            $email = $user->email; */


        Mail::to('ces.pertel@gmail.com')->send(new DeliveryMail($user));
        /*  dd("success"); */
        /*   }

    } */
    }
}
