<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'file_path', 'title', 'author', 
        'description', 'image_path', 'category', 'views' // Adicionei 'views' se for usar filtro "Mais lidos"
    ];

    // Relacionamento com User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Métodos de escopo para filtros (Boas práticas)
    public function scopeMostRead($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeByCategory($query)
    {
        return $query->orderBy('category');
    }

    public function scopeByAuthor($query)
    {
        return $query->orderBy('author');
    }
}