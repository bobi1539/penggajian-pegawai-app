<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'name',
        'group_id',
        'position_id',
        'status',
        'number_of_children'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
