<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
