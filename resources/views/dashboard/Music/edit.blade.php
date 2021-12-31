@extends('layouts.dashboard.app')
@section('title')
@lang('site.edit') @lang('site.Music')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.Music')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.Music.index') }}"> @lang('site.Music')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.Music.update', $track->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        {{-- <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="category" class="form-control">
                                @foreach ($enumoption as $category)
                                    <option value="{{ $category }}" {{ $track->category == $category? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>      
                        </div> --}}

                            <div class="form-group">
                                <label>@lang('site.title')</label>
                                <input type="text" name="Title" class="form-control" value="{{ $track->Title }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.artist')</label>
                                <input type="text" name="Artist" class="form-control" value="{{ $track->Artist }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.Label')</label>
                                <input type="text" name="Label" class="form-control" value="{{ $track->Label }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.description')</label>
                                <textarea name="description" class="form-control ckeditor">{{ $track->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>@lang('site.likesNumber')</label>
                                <input type="number" name="likesNumber" step="1" class="form-control" value="{{ $track->likesNumber }}">
                            </div>
    
                            <div class="form-group">
                                <label>@lang('site.shareNumber')</label>
                                <input type="number" name="shareNumber" step="1" class="form-control" value="{{ $track->shareNumber }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.Released')</label>
                                <input type="datetime-local" name="Released" class="form-control" value="{{ $track->Released }}">
                            </div>

                        {{-- image --}}
                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $track->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="image">
                        </div>

                        {{-- track --}}
                        <div class="form-group">
                            <label>@lang('site.track')</label>
                            <input type="file" name="track" class="form-control track">
                        </div>

                        <div class="form-group">
                            <audio controls class="track-preview">
                                <source src="{{ $track->track_path }}" type="audio/mp3"  >
                              Your browser does not support the audio element.
                              </audio>
                        </div>


                        <div class="form-group">
                            <label>@lang('site.shareLink')</label>
                            <input type="text" name="shareLink" class="form-control" value="{{ $track->shareLink }}">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
