<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'foto',
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_produto');
    }
}
