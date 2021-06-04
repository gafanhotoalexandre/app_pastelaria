<?php

namespace Database\Seeders;

use App\Models\Pastel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PastelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pastel = new Pastel();
        $pastel->nome = 'Pastel de Calabresa';
        $pastel->preco = 4.5;
        $pastel->foto = 'imagens/pastel_calabresa.png';

        $pastel->save();

        Pastel::create([
            'nome' => 'Pastel de Pizza',
            'preco' => 5,
            'foto' => 'imagens/pastel_pizza.png',
        ]);

        DB::table('pasteis')->insert([
            'nome' => 'Pastel de Carne',
            'preco' => 4.5,
            'foto' => 'imagens/pastel_carne.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
