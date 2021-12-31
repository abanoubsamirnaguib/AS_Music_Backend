<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Music;
use App\Http\Resources\MusicResource;


class MusicController extends Controller
{
    public function addLike(Music $track)
    {
        $track->likesNumber++;
        $track->save();
        return new MusicResource(Music::findOrFail($track->id));
    }
    public function subLike(Request $request,Music $track)
    {
        $track->likesNumber--;
        $track->save();
        return new MusicResource(Music::findOrFail($track->id));
    }
    public function addShare(Music $track)
    {
        $track->shareNumber++;
        $track->save();
        return new MusicResource(Music::findOrFail($track->id));
    }
}
