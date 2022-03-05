<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';
    protected $guarded = array('id');

   

    
    protected $fillable = ['id','name','gender','hobby','introduction'];
    
    
     public function histories()
    {
      return $this->hasMany('App\ProfileHistory');

    }
}
