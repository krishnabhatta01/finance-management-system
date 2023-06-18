<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Account extends Model
{
    use  HasFactory, Notifiable;

    protected $fillable = [
            'Account_holder',
            'Ac_No',
            'Balance',
            'loan',
    ];
}
