<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $News = [
            [
              'image'=> 'IMG-20190926-WA0050.jpg',
              'title'=> "Supermodel",
              'subTitle'=> "Foster the People",
              'description'=>
                "Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.",
              'likesNumber'=> 256 ,
              'shareLink' => "www.facebook.com/" ,
              'Date' => date("y-m-d h:i:s"),
              'shareNumber' => 35 ,
              'category'=> "Life",
            ],
            [
              'image'=> 'IMG-20190926-WA0050.jpg',
              'title'=> "Super Video",
              'subTitle'=> "Foster the Video",
              'description'=>
                "Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.",
              'likesNumber'=> 256 ,
              'shareLink' => "www.facebook.com/" ,
              'Date' => date("y-m-d h:i:s"),
              'shareNumber' => 15 ,
              'category'=> "Video",
            ],
            [
              'image'=> 'IMG-20190926-WA0050.jpg',
              'title'=> "Super Music",
              'subTitle'=> "Foster the Music",
              'description'=>
                "Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.",
              'likesNumber'=> 250 ,
              'shareLink' => "www.facebook.com/" ,
              'Date' => date("y-m-d h:i:s"),
              'shareNumber' => 22 ,
              'category'=> "Music",
            ],
        ];
        foreach($News as $new){
            News::Create($new); 
        }
    }
}
