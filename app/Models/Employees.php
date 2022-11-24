<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'first_name', 'last_name', 'email', 'phone'];


    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id', 'id');
    }
}
