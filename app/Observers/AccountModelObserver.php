<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\User;

use function random_int;

class AccountModelObserver
{
    public function created(User $user)
    {
        // Generate data in another table
        $account = new Account();
        $account->Account_holder = $user->name;
        $account->Ac_No = '01500'.random_int(1000, 9999);
        $account->Balance = 100;
        $account->loan = 0;
        $account->Status = 'Active';
       
        // Set other attributes as needed
        $account->save();
    }

    public function deleting($model)
    {
        Account::where('id', $model->id)->delete();
    }

}
