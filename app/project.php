<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    public $fillable = ['pname','description'];

    public function technologies()
    {
    	return $this->belongstoMany('App\technology');
    }

    public function projectsToUser()
    {
        return $this->belongstoMany('App\User');
    }
}// anmol