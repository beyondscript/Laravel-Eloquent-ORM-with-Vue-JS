<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firsttable extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'number',
        'image',
    ];

    public function secondtables()
    {
        return $this->hasMany(Secondtable::class, 'ft_id');
    }
}
