<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iclock extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'iclock';
    // public $timestamps = false;
}
