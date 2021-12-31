@extends('layouts.dashboard.app')

@section('title')
@lang('site.News')
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.News')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.News')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.News') <small>{{ $News->total() }}</small>
                </h3>

                <form action="{{ route('dashboard.News.index') }}" method="get">

                    <div class="row">


                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                            </div>
                            
                            <div class="col-md-4">
                            <select name="category" class="form-control">
                                <option value="">@lang('site.all categories')</option>
                                @foreach ($enumoption as $category)
                                    <option value="{{ $category }}" {{ request()->category == $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_News'))
                            <a href="{{ route('dashboard.News.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body" style="overflow-x: scroll">

                @if ($News->count() > 0)

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.title')</th>
                            <th>@lang('site.subTitle')</th>
                            <th>@lang('site.category')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.likes')</th>
                            <th>@lang('site.share')</th>
                            <th>@lang('site.shareLink')</th>
                            <th>@lang('site.Date')</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($News as $index=>$New)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $New ->title }}</td>
                            <td>{{ $New->subTitle }}</td>
                            <td>{{ $New->category }}</td>
                            <td>{!! $New->description !!}</td>
                            <td>{{$New->likesNumber}}</td>
                            <td>{{$New->shareNumber}}</td>
                            <td>{{$New->shareLink}}</td>
                            <td>{{ date( "d-m-Y h:i:s a" , strtotime ($New->Date) ) }}</td>

                            <td><img src="{{ $New->image_path }}" style="width: 100px" class="img-thumbnail" alt=""></td>

                            <td>
                                @if (auth()->user()->hasPermission('update_News'))
                                <a href="{{ route('dashboard.News.edit', $New->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_News'))
                                <form action="{{ route('dashboard.News.destroy', $New->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger delete btn-sm"><i
                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                </form><!-- end of form -->
                                @else
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    @lang('site.delete')</button>
                                @endif
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                </table><!-- end of table -->

                {{ $News->appends(request()->query())->links() }}

                @else

                <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection