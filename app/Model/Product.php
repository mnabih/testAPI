<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'name','price','stock','discount','detail'
	];
    public function reviews(){
    	return $this->hasMany(Review::class);
    }
}
