<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// api
use App\Http\Controllers\api\ContactMeController;
// testimonials
use App\Models\testimonials;
use App\Http\Resources\testimonialsResource;
use App\Http\Controllers\api\TestimonialsController;
//News
use App\Models\News;
use App\Http\Resources\NewsResource;
use App\Http\Controllers\api\NewsController;
//Music
use App\Models\Music;
use App\Http\Resources\MusicResource;
use App\Http\Controllers\api\MusicController;
//comments
use App\Models\comment;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\api\CommentController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('ContactMe', [ContactMeController::class, "SentMessage"]);

// testimonials
Route::prefix('testimonials')->group(function () {
    Route::get('/',function () {
        return testimonialsResource::collection(testimonials::all());
    });
    Route::get('/addLike/{testimonial}', [TestimonialsController::class, "addLike"]);
    Route::get('/subLike/{testimonial}', [TestimonialsController::class, "subLike"]);
});

// News
Route::prefix('News')->group(function () {
    Route::get('/',function () {
        return NewsResource::collection(News::all());
    });
    Route::get('/addLike/{New}', [NewsController::class, "addLike"]);
    Route::get('/subLike/{New}', [NewsController::class, "subLike"]);
    Route::get('/ /{New}', [NewsController::class, "addShare"]);
});

// Music
Route::prefix('Music')->group(function () {
    Route::get('/',function () {
        return MusicResource::collection(Music::all());
    });
    Route::get('/addLike/{track}', [MusicController::class, "addLike"]);
    Route::get('/subLike/{track}', [MusicController::class, "subLike"]);
    Route::get('/addShare/{track}', [MusicController::class, "addShare"]);
});

//comments
Route::prefix('comments')->group(function () {
    Route::get('/Photos',[CommentController::class, "Photos"]);
    Route::get('/Videos',[CommentController::class, "Videos"]);
    Route::get('/Music',[CommentController::class, "Music"]);
    Route::get('/News',[CommentController::class, "News"]);

    Route::post('/addPhotoComment', [CommentController::class, "addPhotoComment"]);
    Route::post('/editPhotoComment/{comment}', [CommentController::class, "editPhotoComment"]);
    Route::post('/deletePhotoComment/{comment}', [CommentController::class, "deletePhotoComment"]);

    Route::post('/addVideoComment/', [CommentController::class, "addVideoComment"]);
    Route::post('/editVideoComment/{comment}', [CommentController::class, "editVideoComment"]);
    Route::post('/deleteVideoComment/{comment}', [CommentController::class, "deleteVideoComment"]);

    Route::post('/addMusicComment/', [CommentController::class, "addMusicComment"]);
    Route::post('/editMusicComment/{comment}', [CommentController::class, "editMusicComment"]);
    Route::post('/deleteMusicComment/{comment}', [CommentController::class, "deleteMusicComment"]);

    Route::post('/addNewsComment/', [CommentController::class, "addNewsComment"]);
    Route::post('/editNewsComment/{comment}', [CommentController::class, "editNewsComment"]);
    Route::post('/deleteNewsComment/{comment}', [CommentController::class, "deleteNewsComment"]);

});
Route::get('/photoApi', [CommentController::class, "photoApi"]);
