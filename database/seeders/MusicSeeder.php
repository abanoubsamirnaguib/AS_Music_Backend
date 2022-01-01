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
              'image'=> 'Desert.jpg',
              'track'=> 'Desert.mp3',
              'title'=> "Arabic Desert",
              'artist'=> "Aabnoub Samir and and sound of Desert Instrument" ,
              'description'=>
                "Looking For Desert Music You will enjoy this Music , its have have the feeling of Dark Night Desert.",
              'likesNumber'=> 5 ,
              'shareLink' => "/" ,
              'Released' => date("y-m-d h:i:s"),
              'shareNumber' => 0 ,
              'Label'=> "Music",
            ],
            [
              'image'=> 'any zakartak.jfif',
              'track'=> 'any zakartak.mp3',
              'title'=> "any zakartak",
              'artist'=> "sense of cello and piano",
              'description'=>
                "If you like the sense of cello and piano , you will enjoy this Piece of Amazing Warm Music.",
              'likesNumber'=> 4 ,
              'shareLink' => "/" ,
              'Released' => date("y-m-d h:i:s"),
              'shareNumber' => 2 ,
              'Label'=> "Music",
            ],
            [
              'image'=> 'Abanoub.jpg',
              'track'=> 'malak.mp3',
              'title'=> "malak Moh BAyen leh",
              'artist'=> "Cover Of Hamza Nemra Song",
              'description'=>
                "this is the famous song 'malak mosh bayen leh' of hamza nemra song , u can sing with it and enjoy this cover with this amazing arabic instrument.",
              'likesNumber'=> 10 ,
              'shareLink' => "/" ,
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
