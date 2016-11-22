<?php namespace Acme\Bookshop\Updates;

use Seeder;
use Acme\Bookshop\Models\Book;
use Acme\Bookshop\Models\Series;
use Acme\Bookshop\Models\Author;
use Acme\Bookshop\Models\Level;
use Acme\Bookshop\Models\Category;
use Acme\Bookshop\Models\Publisher;

class SeedAllTables extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        // Author 
        foreach (range(0, 10) as $index) {
             Author::create(['name' => $faker->name, 'created_at' => $faker->dateTime(),]);
        }

        // Category
        foreach (range(0, 10) as $index) {
             Category::create(['name' => 'Category -- ' .$index, 'created_at' => $faker->dateTime() ]);
        }

        //Level
        foreach (range(1, 10) as $index) {
             Level::create(['name' => 'Level--' . $index, 'created_at' => $faker->dateTime(),]);
        }

        // publisher
        foreach (range(0, 10) as $index) {
             Publisher::create(['name' => $faker->company, 'created_at' => $faker->dateTime(), ]);
        }


        $books = ['Officer Of The Day',
                    'Queen Of The Solstice',
                    'Witches Of Fire',
                    'Giants Of Darkness',
                    'Vultures And Men',
                    'Traitors And Priests',
                    'Misfortune Of Gold',
                    'Achievement With Sins',
                    'Searching In The World',
                    'Scared Of The Apocolypse',
                    'Hawk Of The Ancestors',
                    'Owl Without Courage',
                    'Children Without Shame',
                    'Lions Of Silver',
                    'Companions And Women',
                    'Trees And Owls',
                    'Tower Of The Gods',
                    'Spear Without Fear',
                    'Eating At My Wife',
                    'Life In My End',

                    'Foe Of The Prison',
                    'Slave Without Faith',
                    'Wives With A Goal',
                    'Hunters Of Dusk',
                    'Descendants And Witches',
                    'Humans And Fish',
                    'Achievement Of The North',
                    'Birth Of Wind',
                    'Arriving At The Fog',
                    'Searching In Dreams',

                    'Swindler With Honor',
                    'Girl Of The Land',
                    'Butchers Of Wood',
                    'Gods Of The Banished',
                    'Heroes And Trees',
                    'Thieves And Traitors',
                    'Faction Of History',
                    'Design Of The Eclipse',
                    'Rescue In The South',
                    'Challenge Of Dreams',


                    'Phantom Without Time',
                    'Agent Of The Night',
                    'Armies Of Reality',
                    'Wives Of Utopia',
                    'Pirates And Gods',
                    'Cats And Girls',
                    'Determination Of Water',
                    'Fruit Of Perfection',
                    'Promises Of The West',
                    'Accepting The River',

                    'Pilot Of The Gods',
                    'Officer With Gold',
                    'Dogs Of Darkness',
                    'Heirs Without Hope',
                    'Giants And Vultures',
                    'Lords And Wives',
                    'Ascension Of Desire',
                    'Effect Of The Solstice',
                    'Battle The Emperor',
                    'Faith Of My Past',

                    'Knight Of Destruction',
                    'Friend Of Rainbows',
                    'Hunters Of The Forsaken',
                    'Assassins Of The Night',
                    'Officers And Blacksmiths',
                    'Pirates And Rebels',
                    'Future Of The Sea',
                    'Obliteration Of My Imagination',
                    'Searching In My Future',
                    'Praise History',
        ];


        foreach (range(1, 69) as $index) {

            // $book = [
            // 'name'=> $books[$index],
            // 'photo' => $faker->image(),
            // 'price' => $faker->randomFloat($nbMaxDecimals = 10, $min = 10, $max = 300), // 48.8932
            // 'numberOfPages' => $faker->numberBetween($min = 20, $max = 600),
            // 'language' => $faker->languageCode,
            // 'publishDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
            // 'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            // 'author_id' => Author::find(rand(1, 20)),
            // 'publisher_id' => Publisher::find(rand(1, 20)),
            // 'level_id' => Leve::find(rand(1, 20)),
            // 'category_id' => Category::find(rand(1, 20)),
            // 'ISBN'=> $faker->isbn13

            // ];

            $book = [
            'title'=> $books[$index],
            'slug'=> str_replace(' ', '-', $books[$index]),
            'image' => $faker->imageUrl(200, 200, 'abstract', true, 'Faker'),
            'price' => $faker->randomFloat(10, 10, 300), // 48.8932
            'numberOfPages' => $faker->numberBetween(20, 600),
            'language' => $faker->languageCode,
            'publishDate' => $faker->date('Y-m-d'),
            'shortDescription' => $faker->paragraph(2, true),
            'description' => $faker->paragraph(5, true),
            'author_id' => Author::find(rand(1, 10))->id,
            'publisher_id' => Publisher::find(rand(1, 10))->id,
            'level_id' => Level::find(rand(1, 10))->id,
            'category_id' => Category::find(rand(1, 10))->id,
            // 'series_id' => Category::find(rand(1, 20))->id,
            'ISBN'=> $faker->isbn13,
            'created_at' => $faker->date('Y-m-d', 'now'),
            ];
            
            Book::create($book);

        }

        //series
        foreach (range(1, 20) as $index) {

            $series = Series::create([
                'title' => 'Series -----' . $index, 
                'slug' => str_replace(' ', '-', 'Series -----' . $index),
                'price'=> $faker->randomFloat(2, 100, 1000), 
                'image' => $faker->imageUrl(250, 250, 'cats', true, 'Series'), 
                'description' => $faker->paragraph(3, true),
                'shortDescription' => $faker->paragraph(2, true) ]);


            Book::find( $index +40 )->update( ['series_id' => $series->id ] )  ;
        }


        // Tags
        // foreach (range(0, 20) as $index) {
        //      Tag::create(['name' => 'Tag ---' . $index , 'created_at' => $faker->dateTime()]);
        // }

        // foreach ((range(1, 20)) as $index) {
        //     DB::table('taggables')->insert(
        //         [
        //             'tag_id' => rand(1, 20),
        //             'taggable_id' => rand(1, 20),
        //             'taggable_type' => rand(0, 1) == 1 ? 'Book' : 'Series'
        //         ]
        //     );

        // }

    }
}