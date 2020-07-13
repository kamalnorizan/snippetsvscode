<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   public $timestamps = true;

   protected $table = 'comments';

   protected $primaryKey = 'id';

   public $incrementing = true;

   protected $guarded = ['id'];

   public function user()
   {
       return $this->belongsTo('App\User', 'user_id', 'id');
   }

   public function post()
   {
       return $this->belongsTo('App\Post', 'post_id', 'id');
   }

}
