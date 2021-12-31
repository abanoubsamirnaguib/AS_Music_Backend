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
                'name'=>'mikeal',
                'job'=>'musicion',
                'description'=>'he is a great producer',
                'likes'=>20,
                'image' => 'default.png'
            ],
            [
                'name'=>'Abanoub Samir',
                'job'=>'singer',
                'description'=>'Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.',
                'likes'=>7,
                'image' => 'default.png'
            ],
            [
                'name'=>'Abanoub',
                'job'=>'singer',
                'description'=>'Turns out semicolon-less style is easier and safer in TS .',
                'likes'=>10,
                'image' => 'default.png'
            ],
            [
                'name'=>'mero',
                'job'=>'bassiest',
                'description'=>'Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.',
                'likes'=>14,
                'image' => 'default.png'
            ],
            [
                'name'=>'Abanoub Samir',
                'job'=>'musicion',
                'description'=>'Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.</p>\r\n\r\n<p>Turns out semicolon-less style is easier and safer in TS because most gotcha edge cases are type invalid as well.',
                'likes'=>6,
                'image' => 'default.png'
            ],
        ];
        foreach($testimonials as $testimonial){
            testimonials::Create($testimonial); 

        }
    }
}
