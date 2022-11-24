<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'logo', 'website'];
    protected $appends = ['logo_url'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'logo_url' => 'string',
    ];


    public function employees()
    {
        return $this->hasMany(Employees::class, 'company_id', 'id');
    }


    protected function getLogoUrlAttribute(): string
    {
        return asset('storage/logos/' . $this->logo);
    }
}
