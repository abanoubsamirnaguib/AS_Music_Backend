@extends('layouts.dashboard.app')
@section('title')
@lang('site.add') @lang('site.comments')
@endsection
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('site.comments')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.comments.index') }}"> @lang('site.comments')</a></li>
            <li class="active">@lang('site.add')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.add')</h3>
            </div><!-- end of box header -->
            <div class="box-body">

                @include('partials._errors')

                <form action="{{ route('dashboard.comments.store') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('post') }}

                    <div class="form-group">
                        <label>@lang('site.categories')</label>
                        <select name="type" class="form-control">
                            @foreach ($enumoption as $type)
                                <option value="{{ $type }}" {{ old('type') == $type? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>      
                    </div>

                    <div class="form-group">
                        <label>@lang('site.name')</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    
                    <div class="form-group">
                        <label>@lang('site.message')</label>
                        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>@lang('site.color')</label>
                        <input type="text" name="color" class="form-control" value="{{ old('color') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.Number')</label>
                        <input type="number" name="Number" step="1" class="form-control" value="{{ old('Number') }}">
                    </div>

                    <div class="form-group">
                        <label>@lang('site.Date')</label>
                        <input type="datetime-local" name="created_at" class="form-control" value="{{ old('created_at') }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                            @lang('site.add')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection