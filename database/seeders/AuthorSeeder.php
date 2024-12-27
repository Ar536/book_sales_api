<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'J.K.Rowling',
            'photo' => 'jkrowling.png',
            'bio' => 'Dia adalah penulis seri Harry Potter, yang telah memenangkan banyak penghargaan dan terjual lebih dari 500 juta kopi pada tahun 2018 dan pada 2008 menjadi seri buku anak-anak terlaris dalam sejarah',
        ]);
        Author::create([
            'name' => 'Robert Kirkman',
            'photo' => 'robertkirkman.png',
            'bio' => 'seorang penulis buku komik Amerika yang terkenal karena karyanya di The Walking Dead , Invincible , dan Marvel Zombies',
        ]);
        Author::create([
            'name' => 'Stephen King',
            'photo' => 'stephenking.png',
            'bio' => 'adalah seorang penulis kontemporer Amerika Serikat. Novel-novelnya yang umumnya bergenre horor, fiksi ilmiah, dan fantasi telah terjual lebih dari 350 juta eksemplar di seluruh dunia',
        ]);
        Author::create([
            'name' => 'Joe Hill',
            'photo' => 'joehill.png',
            'bio' => 'Joe Hill , adalah seorang penulis Amerika. Karyanya meliputi novel Heart-Shaped Box (2007), Horns (2010), NOS4A2 (2013), dan The Fireman (2016)',
        ]);
        Author::create([
            'name' => 'Owen King',
            'photo' => 'owenking.png',
            'bio' => 'seorang pengarang novel dan novel grafis Amerika, dan produser film televisi. Ia menerbitkan buku pertamanya, Were All in This Together, pada tahun 2005 dan mendapat ulasan positif',
        ]);
    }
}
