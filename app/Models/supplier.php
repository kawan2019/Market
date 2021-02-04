<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model{
    protected $table = "supplier";
    protected $fillable = [
        'company_name',
        'email',
        'address',
        'phonenumber',
    ];
    use HasFactory;
}
