<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Resources\testimonialsResource;
use App\Models\testimonials;

class TestimonialsController extends Controller
{

    public function addLike(testimonials $testimonial)
    {
        $testimonial->likes++;
        $testimonial->save();
        return new testimonialsResource(testimonials::findOrFail($testimonial->id));;
    }
    public function subLike(Request $request,testimonials $testimonial)
    {
        $testimonial->likes--;
        $testimonial->save();
        return new testimonialsResource(testimonials::findOrFail($testimonial->id));;
    }
}

