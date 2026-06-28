<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Designation extends Model
{
    protected $fillable = [
        'title',
        'status'
    ];
    public function users()
{
    return $this->hasMany(User::class);
}
}