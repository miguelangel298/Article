<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singature extends Model
{
  protected $fillable = ['name', 'email', 'body'];

  // public  function flag() {
  //   return $this->update(['flagged_at' => \Carbon\Carbon::now()]);
  // }
}
