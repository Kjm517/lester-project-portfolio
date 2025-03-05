<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';
    public $timestamps = false;

    protected $fillable = ['project_name', 'project_description', 'programming_language', 'link', 'project_image'];
}

?>

