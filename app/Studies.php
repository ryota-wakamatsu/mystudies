<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studies extends Model
{
    protected $guarded = array('id');
    
    protected $fillable = ['id','title','body','image_path']; 
     
     // 以下を追記
    // News Modelに関連付けを行う
    public function histories()
    {
      return $this->hasMany('App\History');

    }
}
