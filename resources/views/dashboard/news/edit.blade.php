@extends('layouts.dashboard.app')
@section('title')
@lang('site.edit') @lang('site.News')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.News')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.News.index') }}"> @lang('site.News')</a></li>
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

                    <form action="{{ route('dashboard.News.update', $New->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="category" class="form-control">
                                @foreach ($enumoption as $category)
                                    <option value="{{ $category }}" {{ $New->category == $category? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>      
                        </div>

                            <div class="form-group">
                                <label>@lang('site.title')</label>
                                <input type="text" name="title" class="form-control" value="{{ $New->title }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.subTitle')</label>
                                <input type="text" name="subTitle" class="form-control" value="{{ $New->subTitle }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.description')</label>
                                <textarea name="description" class="form-control ckeditor">{{ $New->description }}</textarea>
                            </div>


                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                            <img src="{{ $New->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.likesNumber')</label>
                            <input type="number" name="likesNumber" step="1" class="form-control" value="{{ $New->likesNumber }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.shareNumber')</label>
                            <input type="number" name="shareNumber" step="1" class="form-control" value="{{ $New->shareNumber }}">
                        </div>
    
                        <div class="form-group">
                            <label>@lang('site.Date')</label>
                            <input type="datetime-local" name="Date" class="form-control" value="{{ $New->Date }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.shareLink')</label>
                            <input type="text" name="shareLink" class="form-control" value="{{ $New->shareLink }}">
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
