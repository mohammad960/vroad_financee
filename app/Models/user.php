<?php

namespace App\Models;
use  App\Models\role;
use  App\Models\market;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model implements
    \Illuminate\Contracts\Auth\Authenticatable
{
    use HasFactory;
	use Authenticatable;
	protected $fillable=["username","password","role_id","removed"];



    public function role()
    {
        return $this->belongsTo(role::class);



    }


    public function market()
    {
        return $this->belongsTo(market::class);
    }
}
