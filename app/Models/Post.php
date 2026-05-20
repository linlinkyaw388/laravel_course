<?php

namespace App\Models;

use App\Mail\PostCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Post extends Model
{
    use HasFactory;
    // protected $fillable = ['name','description'];
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo('App\Models\category','category_id');       //foreign key
    }

    // protected static function booted(){
    //     static::creating(function($post){
    //         Mail::to('hlaing@gmail.com')->send(new PostCreated($post));
    //     });
    // }
    
}