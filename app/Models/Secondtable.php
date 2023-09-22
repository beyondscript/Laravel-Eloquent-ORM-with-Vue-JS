<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondtable extends Model
{
    use HasFactory;

    protected $fillable = [
        'stext',
        'ft_id',
    ];

    public function firsttables()
    {
        return $this->belongsTo(Firsttable::class, 'ft_id');
    }
}
