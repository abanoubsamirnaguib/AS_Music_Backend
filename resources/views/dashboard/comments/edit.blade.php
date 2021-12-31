@extends('layouts.dashboard.app')
@section('title')
@lang('site.edit') @lang('site.comments')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.comments')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.comments.index') }}"> @lang('site.comments')</a></li>
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

                    <form action="{{ route('dashboard.comments.update', $comment->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>@lang('site.categories')</label>
                            <select name="type" class="form-control">
                                @foreach ($enumoption as $type)
                                    <option value="{{ $type }}" {{ $comment->type == $type? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>      
                        </div>

                            <div class="form-group">
                                <label>@lang('site.title')</label>
                                <input type="text" name="name" class="form-control" value="{{ $comment->name }}">
                            </div>

                            <div class="form-group">
                                <label>@lang('site.description')</label>
                                <textarea name="message" class="form-control">{{ $comment->message }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>@lang('site.subTitle')</label>
                                <input type="text" name="color" class="form-control" value="{{ $comment->color }}">
                            </div>

        
                        <div class="form-group">
                            <label>@lang('site.Number')</label>
                            <input type="number" name="Number" step="1" class="form-control" value="{{ $comment->Number }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.Date')</label>
                            <input type="datetime-local" name="created_at" class="form-control" value="{{ $comment->created_at }}">
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
