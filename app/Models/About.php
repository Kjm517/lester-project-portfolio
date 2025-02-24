<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['description', 'skills']; // Allow 'description' and 'skills' as input
    public $timestamps = false;
}
?>