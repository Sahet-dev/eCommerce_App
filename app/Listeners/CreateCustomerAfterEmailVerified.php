<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use App\Models\Customer;

class CreateCustomerAfterEmailVerified
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Verified  $event
     * @return void
     */
//    public function handle(Verified $event)
//    {
//        $user = $event->user;
//
//        if (is_null($user->customer)) {
//            $customer = new Customer();
//            $names = explode("  ", $user->name);
//            $customer->user_id = $user->id;
//            $customer->first_name = $names[0];
//            $customer->last_name = $names[1] ?? ' ';
//            $customer->status = ' ';
//
//            $customer->save();
//        }
//    }
}
