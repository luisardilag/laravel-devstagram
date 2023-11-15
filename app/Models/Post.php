<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'imagen',
    ];


    /* Un Post pertenece a un usuario */
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    /* Un Post tiene muchos comentarios */
    public function comentarios()
    {
        return $this->hasMany(Comentario::class)->orderBy('created_at', 'desc');
    }

    /* Un Post tiene muchos Likes */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /* Un Post tiene muchos Likes */
    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id', $user->id);;
    }
}
