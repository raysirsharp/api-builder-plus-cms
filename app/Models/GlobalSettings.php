<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are protected from being mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
