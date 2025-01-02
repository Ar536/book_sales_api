<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Harry Potter and the Sorcerer\s Stone',
            'description' => 'orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world',
            'price' => 50000,
            'stock' => 50,
            'cover_photo' => 'harrypoter.png',
            'genre_id' => 1,
            'author_id' => 1,
        ]);
        Book::create([
            'title' => 'Shadow slave',
            'description' => 'This book is about a guy named Sunny who lives in a dystopian future where some people are forced to periodically visit a magical world and battle terrible monsters.',
            'price' => 20000,
            'stock' => 60,
            'cover_photo' => 'shadowslave.png',
            'genre_id' => 2,
            'author_id' => 2,
        ]);
        Book::create([
            'title' => 'endless path infinite cosmos',
            'description' => 'This book is about a guy named vahn,Due to a rare mutation, his blood had the potential to target and attack ailments within the human body. Touted as a universal cure.',
            'price' => 40000,
            'stock' => 70,
            'cover_photo' => 'epic.png',
            'genre_id' => 3,
            'author_id' => 3,
        ]);
        Book::create([
            'title' => 'Supreme magus',
            'description' => 'where the protagonist, Lith Verhen, is a man with a tragic past who, through relentless dedication and a unique ability to manipulate magic, rises to become an incredibly powerful mage',
            'price' => 90000,
            'stock' => 80,
            'cover_photo' => 'Suprememagus.png',
            'genre_id' => 4,
            'author_id' => 4,
        ]);
        Book::create([
            'title' => 'Tenggelamnya kapal vander wick',
            'description' => 'a love story about Zainuddin and Hayati who are stopped by tradition and class level',
            'price' => 75000,
            'stock' => 90,
            'cover_photo' => 'vaderwick.png',
            'genre_id' => 5,
            'author_id' => 5,
        ]);
    }
}
