<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pastel extends Model
{
    use HasFactory;

    // use SoftDeletes;

    protected $table = 'pasteis';
    protected $fillable = ['nome', 'preco', 'foto'];

    public function rules()
    {
        return [
            'nome' => 'required',
            'preco' => 'required',
            'foto' => 'required',
        ];
    }
    public function feedback()
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido.'
        ];
    }
}
