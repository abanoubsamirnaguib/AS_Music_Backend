<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Music;


class MusicSeeder extends Seeder
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
              'image'=> 'https://picsum.photos/500/300?image=1',
              'track'=> 'https://drive.google.com/uc?id=1grhQQInDkBXzn0leYSGUPXHekPslSKBu&export=media',
              'title'=> "Supermodel",
              'artist'=> "Foster the People",
              'description'=>
                "Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.",
              'likesNumber'=> 256 ,
              'shareLink' => "www.facebook.com/" ,
              'Released' => date("y-m-d h:i:s"),
              'shareNumber' => 35 ,
              'Label'=> "Life",
            ],
            [
              'image'=> 'https://picsum.photos/500/300?image=2',
              'track'=> 'https://drive.google.com/uc?id=1grhQQInDkBXzn0leYSGUPXHekPslSKBu&export=media',
              'title'=> "Super Video",
              'artist'=> "Foster the Video",
              'description'=>
                "Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.",
              'likesNumber'=> 256 ,
              'shareLink' => "www.facebook.com/" ,
              'Released' => date("y-m-d h:i:s"),
              'shareNumber' => 15 ,
              'Label'=> "Video",
            ],
            [
              'image'=> 'https://picsum.photos/500/300?image=3',
              'track'=> 'https://drive.google.com/uc?id=1grhQQInDkBXzn0leYSGUPXHekPslSKBu&export=media',
              'title'=> "Super Music",
              'artist'=> "Foster the Music",
              'description'=>
                "Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.",
              'likesNumber'=> 250 ,
              'shareLink' => "www.facebook.com/" ,
              'Released' => date("y-m-d h:i:s"),
              'shareNumber' => 22 ,
              'Label'=> "Music",
            ],
        ];
        foreach($News as $new){
            Music::Create($new); 
        }
    }
}
