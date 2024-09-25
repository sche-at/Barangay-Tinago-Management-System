<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Data extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'datas';

    protected $fillable = ['Full_Name', 'Phone_Number', 'Email', 'Username', 'Password'];
}
