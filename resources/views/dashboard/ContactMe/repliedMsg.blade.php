@extends('layouts.dashboard.app')

@section('title')
@lang('site.repliedMsg')
@endsection

@section('content')

    <div class="content-wrapper" >

        <section class="content-header">

            <h1>@lang('site.repliedMsg')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.repliedMsg')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary" >

                <div class="box-header with-border">

                    {{-- <h3 class="box-title" style="margin-bottom: 15px">@lang('site.ContactMe') <small>{{ $ContactMe->total() }}</small></h3> --}}

                    {{-- <form action="{{ route('dashboard.ContactMe.repliedMsg', $ContactMe->id) }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>
                            
                            <div class="col-md-4">
                                <select name="field" class="form-control">
                                    <option value="">@lang('site.all categories')</option>
                                    @foreach ($fields as $field)
                                        <option value="{{ $field }}" {{ request()->field == $field ? 'selected' : '' }}>{{ $field }}</option>
                                    @endforeach

                                </select>
                                </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                            </div>

                        </div>
                    </form><!-- end of form --> --}}

                </div><!-- end of box header -->

                <div class="box-body" style="overflow-x: scroll">

                    {{-- @if ($Msgs->count() > 0) --}}

                        <table class="table table-hover" >

                            <thead>
                            <tr>
                                {{-- <th>#</th> --}}

                                <th class="text-capitalize">@lang('site.title')</th>
                                <th class="text-capitalize">@lang('site.Message')</th>
                                <th class="text-capitalize">@lang('site.Date')</th>
                                <th class="text-capitalize">@lang('site.action')</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($Msgs as $index=>$message)
                                <tr>
                                    <td>{{ $index + 1 }}</td>

                                    <td>{{ $message->title }}</td>
                                    <td>{!! $message->Message !!}</td>
                                    <td>{!! $message->created_at !!}</td>                                   
                                    <td>
                                        {{-- READ MSG --}}
                                        @if ( $message->id )
                                            <a href="{{ route('dashboard.ContactMe.mail', $message->id ) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-edit"></i> @lang('site.repliedMsg')</a>
                                        @else
                                            <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.repliedMsg')</a>
                                        @endif

                                        @if (auth()->user()->hasPermission('delete_Message'))
                                            <form action="{{ route('dashboard.ContactMe.destroyReplyMsg', $message->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                                                                                
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{-- {{ $Msgs->appends(request()->query())->links() }} --}}
                        
                    {{-- @else --}}
                        
                        {{-- <h2>@lang('site.no_data_found')</h2> --}}
                        
                    {{-- @endif --}}
                    
                    <a class="btn btn-success btn-sm" href="{{ route('dashboard.ContactMe.index') }}"><i class="fa fa-backward"></i> @lang('site.back')</a>
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
