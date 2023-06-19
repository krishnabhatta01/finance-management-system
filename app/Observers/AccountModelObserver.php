<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\User;

use Illuminate\Support\Str;

class AccountModelObserver
{
    public function created(User $user)
    {
        // Generate data in another table
        $account = new Account();
        $account->Account_holder = $user->name;
        $account->Ac_No = Str::random(7);
        $account->Balance = 100;
        $account->loan = 0;
       
        // Set other attributes as needed
        $account->save();
    }
}
