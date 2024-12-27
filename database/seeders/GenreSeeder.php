<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'Fiksi',   //'name'(key) => '',
            'description' => 'cerita rekaan atau khayalan yang tidak berdasarkan kenyataan atau fakta ',
        ]);
        Genre::create([
            'name' => 'Horror',   
            'description' => 'genre fiksi spekulatif yang bertujuan untuk menakut-nakuti, mengganggu, atau membuat takut.',
        ]);
        Genre::create([
            'name' => 'Romance',   
            'description' => 'genre cerita yang berfokus pada kisah cinta dan hubungan romantis antara dua tokoh atau lebih. ',
        ]);
        Genre::create([
            'name' => 'Fantasy',   
            'description' => 'genre fiksi spekulatif yang melibatkan tema-tema supranatural, sihir, dan dunia serta makhluk imajiner.',
        ]);
        Genre::create([
            'name' => 'Sci-fi',   
            'description' => 'genre fiksi spekulatif yang menggambarkan sains dan teknologi nyata atau imajiner dalam plot, latar, atau tema ceritanya.',
        ]);
    }
}
