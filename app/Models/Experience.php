<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';
    public $timestamps = false;

    protected $fillable = ['position', 'company', 'start_year', 'start_month', 'end_year', 'end_month'];
}

?>
