<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeling extends Model
{
    use HasFactory;

    protected $fillable = [
        'feeling_name',
        'is_active',

        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];
}
