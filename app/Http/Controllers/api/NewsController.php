<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\News;
use App\Http\Resources\NewsResource;


class NewsController extends Controller
{
    public function addLike(News $New)
    {
        $New->likesNumber++;
        $New->save();
        return new NewsResource(News::findOrFail($New->id));;
    }
    public function subLike(Request $request,News $New)
    {
        $New->likesNumber--;
        $New->save();
        return new NewsResource(News::findOrFail($New->id));;
    }
    public function addShare(News $New)
    {
        $New->shareNumber++;
        $New->save();
        return new NewsResource(News::findOrFail($New->id));;
    }
}
