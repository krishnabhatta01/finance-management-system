<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\User;

class AccountModelObserver
{
    public function created(User $user)
    {
        // Generate data in another table
        $account = new Account();
        $account->Account_holder = $user->name;
       
        // Set other attributes as needed
        $account->save();
    }
}
