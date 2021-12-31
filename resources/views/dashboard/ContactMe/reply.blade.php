@extends('layouts.dashboard.app')
@section('title')
@lang('site.reply') @lang('site.ContactMe')
@endsection
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.ContactMe')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.ContactMe.index') }}"> @lang('site.ContactMe')</a></li>
                <li class="active">@lang('site.reply')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.reply')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    <table class="table table-hover" >

                        <thead>
                        <tr>
                            <th class="text-capitalize">@lang('site.name')</th>
                            <th class="text-capitalize">@lang('site.email')</th>
                            <th class="text-capitalize">@lang('site.phoneNumber')</th>
                            <th class="text-capitalize">@lang('site.Message')</th>
                            <th class="text-capitalize">@lang('site.Date')</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                            <tr>
                                <td>{{ $message->Name }}</td>
                                {{-- <td>{{$message->Email}} --}}
                                <td>{{ $message->PhoneNumber }}</td>
                                <td>{!! $message->Message !!}</td>
                                <td>{!! $message->created_at !!}</td>                                   
                            </tr>                                                                            
                        </tbody>

                    </table><!-- end of table -->


                    @include('partials._errors')

                    <form action="{{ route('dashboard.ContactMe.sent' , $message->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

   
                            {{-- <div class="form-group">
                                <label class="text-capitalize">@lang('site.email')</label>
                                <input type="email" name="Email" class="form-control" value="">
                            </div> --}}

                            <div class="form-group">
                                <label class="text-capitalize">@lang('site.title')</label>
                                <input type="text" name="title" class="form-control" value="">
                            </div>


                            <div class="form-group">
                                <label class="text-capitalize">@lang('site.Message')</label>
                                <textarea name="Message" class="form-control"></textarea>
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.sent')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
