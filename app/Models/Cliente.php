<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'nome', 'email', 'telefone',
        'data_nascimento', 'endereco',
        'complemento', 'bairro', 'cep'
    ];

    protected $dates = ['data_nascimento'];

    public function rules()
    {
        return [
            'nome' => 'required|min:3',
            'email' => 'required|unique:clientes,email,'.$this->id,
            'telefone' => 'required',
            'data_nascimento' => 'required',
            'endereco' => 'required',
            'complemento' => 'required',
            'bairro' => 'required',
            'cep' => 'required',
        ];
    }
    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',

            'nome.min' => 'O campo nome deve prossuir ao menos 3 caracteres',
            'email.unique' => 'O e-mail informado já foi cadastrado.',
        ];
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
