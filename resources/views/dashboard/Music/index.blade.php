@extends('layouts.dashboard.app')

@section('title')
@lang('site.Music')
@endsection

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.Music')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('site.Music')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.Music') <small>{{ $Music->total() }}</small>
                </h3>

                <form action="{{ route('dashboard.Music.index') }}" method="get">

                    <div class="row">


                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                            </div>
                            
                            <div class="col-md-4">
                            <select name="field" class="form-control">
                                {{-- <option value="">@lang('site.all categories')</option> --}}
                                @foreach ($fields as $field)
                                    <option class="text-capitalize" value="{{ $field }}" {{ request()->field == $field ? 'selected' : '' }}>{{ $field }}</option>
                                @endforeach
                            </select>
                            </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_Music'))
                            <a href="{{ route('dashboard.Music.create') }}" class="btn btn-primary"><i
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

                @if ($Music->count() > 0)

                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('site.title')</th>
                            <th>@lang('site.artist')</th>
                            <th>@lang('site.Label')</th>
                            <th>@lang('site.description')</th>
                            <th>@lang('site.likes')</th>
                            <th>@lang('site.share')</th>
                            <th>@lang('site.shareLink')</th>
                            <th>@lang('site.Released')</th>
                            <th style="width:70%">@lang('site.image')</th>
                            <th>@lang('site.track')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($Music as $index=>$track)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $track ->Title }}</td>
                            <td>{{ $track->Artist }}</td>
                            <td>{{ $track->Label }}</td>
                            <td>{!! $track->description !!}</td>
                            <td>{{$track->likesNumber}}</td>
                            <td>{{$track->shareNumber}}</td>
                            <td>{{$track->shareLink}}</td>
                            <td>{{ date( "d-m-Y h:i:s a" , strtotime ($track->Released) ) }}</td>

                            <td style="width:70%"><img src="{{ $track->image_path }}" style="width: 200px" class="" alt=""></td>
                            <td>
                                <audio controls >
                                    <source src="{{ $track->track_path }}" type="audio/mp3" >
                                  Your browser does not support the audio element.
                                  </audio>
                                </td>

                            <td>
                                @if (auth()->user()->hasPermission('update_Music'))
                                <a href="{{ route('dashboard.Music.edit', $track->id) }}" class="btn btn-info btn-sm"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('delete_Music'))
                                <form action="{{ route('dashboard.Music.destroy', $track->id) }}" method="post"
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

                {{ $Music->appends(request()->query())->links() }}

                @else

                <h2>@lang('site.no_data_found')</h2>

                @endif

            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection