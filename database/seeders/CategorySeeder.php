<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
        	'Veículo de passageiros',
        	'Bicicleta',
			'Ciclomotor',
			'Motocicleta',
			'Triciclo',
			'Quadriciclo',
			'Automóvel',
			'Microônibus',
			'Ônibus',
			'Bonde',
			'Reboque ou semi-reboque',
			'Charrete',

			'Veículo de carga',
			'Motoneta',
			'Caminhonete',
			'Caminhão',
			'Carroça',
			'Carro-de-mão',

			'Veículo Misto',
			'Camioneta',
			'Utilitário',
			 
			'Veículos de competição',
			 
			'Veículo de tração',
			'Caminhão-trator',
			'Trator de rodas',
			'Trator de esteiras',
			'Trator misto',
			'Especial',
			'De coleção',
			'Esportivo',
			'Passeio',
			'Corrida'
        ];

        foreach($categories as $category):
        	$data = [
        		'name' => $category,
        		'slug' => Str::of($category)->slug('-')
        	];

        	Category::create($data);
        endforeach;
    }
}
