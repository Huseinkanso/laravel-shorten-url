<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Url extends Model
{
    use HasFactory;

    // this accept only what is given
    protected $fillable=['original_url','shorten_url','visits','user_id','title'];
    //or
    // protected $guarded=[]; //this disable mass assignment


    // serialisation json
    protected $appends=['path'];

    // boot is used to use elequent events
    // here is event creating
    // so we give a dynamiic random string for shorten_url on creation
    protected static function boot()
    {
        parent::boot();
        static::creating(function($url){
            $url->shorten_url=Str::random(6);
        });
    }

    // by default the key binding to identifie data is id but we can change it by overwiting the function and give a key
    public function getRouteKeyName()
    {
        return 'shorten_url';
    }

    // getFullNameAttribute
    // we can grap the attribute and modifie it before sending it by using this
    // this method will help us modifie the created_at attribute
    // created_at == CreatedAt in the function name
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function getPathAttribute()
    {
        return asset("u/$this->shorten_url");
    }

    // public function user()
    // {
    //     $this->belongsTo(User::class);
    // }
}
