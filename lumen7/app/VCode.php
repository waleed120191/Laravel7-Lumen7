<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class VCode extends Model
{
	protected $connection = 'mysql';
    protected $table = 'codes';
    protected $fillable = [
        'unique_code',
    ];

}
