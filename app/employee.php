<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    //
    public $timestamps = false;
    protected $table = 'employees';
    protected $fillable = ['FirstName','LastName','Email','Hobbies','Gender','Picture'];
    // protected $table2 = 'pictures';
    // protected $fillable2= [];



    // public function setCategoryAttribute($value)

    // {

    //     $this->attributes['Hobbies'] = json_encode($value);
    //     $this->attributes['Gender'] = json_encode($value);

    // }


    // public function getCategoryAttribute($value)

    // {

    //     return $this->attributes['Hobbies'] = json_decode($value);
    //     return $this->attributes['Gender'] = json_decode($value);

    // }

}
