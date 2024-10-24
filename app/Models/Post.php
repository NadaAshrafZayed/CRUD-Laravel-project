<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'description', 'user_id'];


    // Defining the inverse of a hasMany relationship in One-To-Many relationship:
    // A post BELONGS TO a user. ()
    // Kda el connection between the two models/tables are made. They are related now.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    IMPORTANT: since enk smeety fo2 el function (user), fa hoa rbbt en el posts tables
    related to el users table w kda hatta you didn't have to twdd7i el foreign key
    ely mrbbt bb3d el etneen but lw konty smety el function haga tanya, you need
    to show el foreign key.
    NOTE: T2reebn el kalam da lw katba el Forign key constraint line, gher kda
    smmy el function name (user) 3shan not sure hysht8l aw la lw el fn name msh
    (user) w el Forign key constraint line msh maktoob.
    */
    // public function postCreator()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
