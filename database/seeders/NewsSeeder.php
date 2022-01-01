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
            'image'=> 'Amen.jpg',
            'title'=> "El Moemen Al Amen ",
            'subTitle'=> "Christian poems",
            'description'=>
              "Violin Piano and guitar for new vision of the song ",
            'likesNumber'=> 90 ,
            'shareLink' => "https://www.youtube.com/watch?v=zP601i-x0O4" ,
            'Date' => date("y-m-d h:i:s" , '2021/03/05'),
            'shareNumber' => 2 ,
            'category'=> "Video",
          ],
          [
            'image'=> 'any zakartak.jfif',
            'title'=> "any zakartak",
            'subTitle'=> "Islamic poems Music",
            'description'=>
              "with cello and piano and arabic rythm , you can see how this poems sound .",
            'likesNumber'=> 20 ,
            'shareLink' => "/" ,
            'Date' => date("y-m-d h:i:s"),
            'shareNumber' => 11 ,
            'category'=> "Music",
          ],
            [
              'image'=> 'IMG-20190926-WA0021.jpg',
              'title'=> "Studio Work",
              'subTitle'=> "New songs Coming",
              'description'=>
                "In studio working on some New Songs Soon ...",
              'likesNumber'=> 10 ,
              'shareLink' => "/" ,
              'Date' => date("y-m-d h:i:s"),
              'shareNumber' => 2 ,
              'category'=> "Life",
            ],
            [
              'image'=> 'batband.jpg',
              'title'=> "Bat Band",
              'subTitle'=> "Band Time ",
              'description'=>
                "Play Guitar in bat band ,To see More of coming event Join Our Band Page ",
              'likesNumber'=> 10 ,
              'shareLink' => "https://www.facebook.com/batbandstar" ,
              'Date' => date("y-m-d h:i:s"),
              'shareNumber' => 2 ,
              'category'=> "Social",
            ],
        ];
        foreach($News as $new){
            News::Create($new); 
        }
    }
}
