<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    protected $table = 'awards';
    public $timestamps = false;

    protected $fillable = ['award_name', 'company', 'expiration', 'photo', 'cert_link'];
}
