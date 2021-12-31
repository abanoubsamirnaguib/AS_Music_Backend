<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\comment;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments=[
            [
                'name'=> "Abanoub",
                'message'=> "great photo",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "Photo",
            ],
            [
                'name'=> "miki",
                'message'=> "amazing photos",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "Photo",
            ],
            [
                'name'=> "john",
                'message'=> "wonderful photos",
                'Number'=> 3,
                'color'=> "green",
                'type'=> "Photo",
            ],
            [
                'name'=> "Abanoub",
                'message'=> "great Video",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "Video",
            ],
            [
                'name'=> "miki",
                'message'=> "amazing Video",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "Video",
            ],
            [
                'name'=> "john",
                'message'=> "wonderful Video",
                'Number'=> 3,
                'color'=> "green",
                'type'=> "Video",
            ],
            [
                'name'=> "Abanoub",
                'message'=> "great Music",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "Music",
            ],
            [
                'name'=> "miki",
                'message'=> "amazing Music",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "Music",
            ],
            [
                'name'=> "john",
                'message'=> "wonderful Music",
                'Number'=> 3,
                'color'=> "green",
                'type'=> "Music",
            ],
            [
                'name'=> "Abanoub",
                'message'=> "great News",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "News",
            ],
            [
                'name'=> "miki",
                'message'=> "amazing News",
                'Number'=> 6,
                'color'=> "green",
                'type'=> "News",
            ],
            [
                'name'=> "john",
                'message'=> "wonderful News",
                'Number'=> 3,
                'color'=> "green",
                'type'=> "News",
            ],
            ];
        foreach($comments as $comment){
            comment::Create($comment); 
        }
    }
}
