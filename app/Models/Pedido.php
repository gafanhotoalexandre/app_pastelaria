<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory;

    use SoftDeletes;
    
    protected $fillable = ['cliente_id', 'pastel_id'];

    public function rules()
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'pastel_id' => 'required|exists:pasteis,id',
        ];
    }
    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido.',
            'exists' => 'O :attribute selecionado é inválido.',
        ];
    }

    public function cliente()
    {
        // um pedido pertence a um cliente
        return $this->belongsTo(Cliente::class);
    }
    public function pasteis()
    {
        return $this->hasMany(Pastel::class, 'id', 'pastel_id');
    }
}
