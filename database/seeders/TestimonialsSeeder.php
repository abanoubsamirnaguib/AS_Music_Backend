<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\testimonials;


class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testimonials=[
            [
                'name'=>'Haider Ali Ahmed',
                'job'=>'Singer',
                'description'=>'he is a great producer , I Loved to work With him',
                'likes'=>2,
                'image' => 'haideraliahmed.jpg'
            ],
            [
                'name'=>'May Magdy',
                'job'=>'Video Producer',
                'description'=>'I loved my experience. Actually I believe he is a rising star. Very pleasant to work with, takes any comments and works his best to get you satisfied.',
                'likes'=>7,
                'image' => 'maymagdy.jpg'
            ],
            [
                'name'=>'Houda Belhadj',
                'job'=>'Singer',
                'description'=>'very responsive and great quality of work , I hope to work again',
                'likes'=>10,
                'image' => 'houdabelhadj.jpeg'
            ],
            [
                'name'=>'zinga',
                'job'=>'Music Producer',
                'description'=>'Great Musicion - good quality and vision. Will work again',
                'likes'=>14,
                'image' => 'zinga.jfif'
            ],
            [
                'name'=>'kamalhlk',
                'job'=>'Songwriter',
                'description'=>'Amazing composer, I Really Like his music , his Imagination , he has unique style',
                'likes'=>6,
                'image' => 'kamalhlk.jpg'
            ],
            [
                'name'=>'Ebrahem Abo Toama',
                'job'=>'Singer',
                'description'=>'I Worked with him for more than 2 years, and he always make me happy with his amazing Music ,really he is best Music Producer Ever',
                'likes'=>6,
                'image' => 'EbrahemAboToama.jpg'
            ],
        ];
        foreach($testimonials as $testimonial){
            testimonials::Create($testimonial); 

        }
    }
}
