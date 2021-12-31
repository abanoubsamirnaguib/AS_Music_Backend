<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\productController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\Clients\OrderController;
use App\Http\Controllers\Dashboard\orderController as OrderController2 ;
use App\Http\Controllers\Dashboard\TestimonialsController;
use App\Http\Controllers\Dashboard\NewsController;
use App\Http\Controllers\Dashboard\MusicController;
use App\Http\Controllers\Dashboard\ContactMeController;
use App\Http\Controllers\Dashboard\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::prefix('Dashboard')->middleware(['auth'])->group(function () {
        
        Route::get('index', [DashboardController::class, "index"])->name('dashboard.welcome');
        
        //user
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, "index"])->name('dashboard.users.welcome');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
            Route::get('/create', [UserController::class, "create"])->name('dashboard.users.create');
            Route::post('/store', [UserController::class, "store"])->name('dashboard.users.store');
            Route::get('/edit/{user}', [UserController::class, "edit"])->name('dashboard.users.edit');
            Route::post('/update/{user}', [UserController::class, "update"])->name('dashboard.users.update');
            Route::post('/delete/{user}', [UserController::class, "destroy"])->name('dashboard.users.destroy');   
        });

        Route::prefix('testimonials')->group(function () {
            Route::get('/', [TestimonialsController::class, "index"])->name('dashboard.testimonials.index');
            Route::get('/create', [TestimonialsController::class, "create"])->name('dashboard.testimonials.create');
            Route::post('/store', [TestimonialsController::class, "store"])->name('dashboard.testimonials.store');
            Route::get('/edit/{testimonial}', [TestimonialsController::class, "edit"])->name('dashboard.testimonials.edit');
            Route::post('/update/{testimonial}', [TestimonialsController::class, "update"])->name('dashboard.testimonials.update');
            Route::delete('/delete/{testimonial}', [TestimonialsController::class, "destroy"])->name('dashboard.testimonials.destroy');   
        });
        
        Route::prefix('News')->group(function () {
            Route::get('/', [NewsController::class, "index"])->name('dashboard.News.index');
            Route::get('/create', [NewsController::class, "create"])->name('dashboard.News.create');
            Route::post('/store', [NewsController::class, "store"])->name('dashboard.News.store');
            Route::get('/edit/{New}', [NewsController::class, "edit"])->name('dashboard.News.edit');
            Route::post('/update/{New}', [NewsController::class, "update"])->name('dashboard.News.update');
            Route::delete('/delete/{New}', [NewsController::class, "destroy"])->name('dashboard.News.destroy');   
        });

        Route::prefix('ContactMe')->group(function () {
            Route::get('/', [ContactMeController::class, "index"])->name('dashboard.ContactMe.index');
            Route::get('/mail/{replyMsg}', [ContactMeController::class, "Mail"])->name('dashboard.ContactMe.mail');

            Route::get('/repliedMsg/{Msgs}', [ContactMeController::class, "repliedMsg"])->name('dashboard.ContactMe.repliedMsg');
            Route::get('/reply/{Message}', [ContactMeController::class, "reply"])->name('dashboard.ContactMe.reply');
            Route::post('/sent/{Message}', [ContactMeController::class, "sent"])->name('dashboard.ContactMe.sent');
            Route::delete('/deleteReplyMsg/{replyMsg}', [ContactMeController::class, "destroyReplyMsg"])->name('dashboard.ContactMe.destroyReplyMsg');
            Route::delete('/delete/{Message}', [ContactMeController::class, "destroy"])->name('dashboard.ContactMe.destroy');   
        });
         
        Route::prefix('Music')->group(function () {
            Route::get('/', [MusicController::class, "index"])->name('dashboard.Music.index');
            Route::get('/create', [MusicController::class, "create"])->name('dashboard.Music.create');
            Route::post('/store', [MusicController::class, "store"])->name('dashboard.Music.store');
            Route::get('/edit/{track}', [MusicController::class, "edit"])->name('dashboard.Music.edit');
            Route::post('/update/{track}', [MusicController::class, "update"])->name('dashboard.Music.update');
            Route::delete('/delete/{track}', [MusicController::class, "destroy"])->name('dashboard.Music.destroy');   
        });

        Route::prefix('comments')->group(function () {
            Route::get('/', [CommentController::class, "index"])->name('dashboard.comments.index');
            Route::get('/create', [CommentController::class, "create"])->name('dashboard.comments.create');
            Route::post('/store', [CommentController::class, "store"])->name('dashboard.comments.store');
            Route::get('/edit/{comment}', [CommentController::class, "edit"])->name('dashboard.comments.edit');
            Route::post('/update/{comment}', [CommentController::class, "update"])->name('dashboard.comments.update');
            Route::delete('/delete/{comment}', [CommentController::class, "destroy"])->name('dashboard.comments.destroy');   
        });

        
        // rest routs
        Route::get('get', function() {
            // $filename = 'default.png';
            $filename = 'demo 6.mp3';
        
            // $dir = '/1Umjh6NEblkvfOV2vd-G87SqF7ycI5FaO';
            $dir = '/1R-PdZQb5XIeycPWgntlfqxLWQl3Z8_da';
            $recursive = false; // Get subdirectories also?
            $contents = collect(\Storage::disk("google")->listContents($dir, $recursive));

            $file = $contents
                ->where('type', '=', 'file')
                ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
                ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
                ->first(); // there can be duplicate file names!
                // dd($file);
        
            return    $rawData = \Storage::disk("google")->url($file['path']);
            // https://drive.google.com/uc?id=1grhQQInDkBXzn0leYSGUPXHekPslSKBu&export=media
            
            dd (response($rawData, 200)
                ->header('ContentType', $file['mimetype'])
                ->header('Content-Disposition', "attachment; filename='$filename'") );

             response($rawData, 200)
                ->header('ContentType', $file['mimetype'])
                ->header('Content-Disposition', "attachment; filename='$filename'");
        });

        Route::get('delete', function() {
            $filename = 'photo3.jpg';
            $dir = '/1Umjh6NEblkvfOV2vd-G87SqF7ycI5FaO';
            $recursive = false; // Get subdirectories also?
            $contents = collect(Storage::disk('google')->listContents($dir, $recursive));
        
               $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!
    
            if ( ! $dir) {
                return 'Directory does not exist!';
            }        
            Storage::disk('google')->delete($file['path'] );      
        
        });

    });
});



