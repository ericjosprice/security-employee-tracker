@extends('vendor.installer.layouts.master')

@section('title', trans('messages.environment.title'))
@section('container')
    @if (session('message'))
    <p class="alert">{{ session('message') }}</p>
    @endif
    <form method="post" action="{{ url('install/environment') }}">
        {!! csrf_field() !!}

        {!! Form::hidden('APP_ENV', 'local') !!}
        {!! Form::hidden('APP_DEBUG', 'true') !!}
        {!! Form::hidden('APP_ENV', 'local') !!}
        {!! Form::hidden('APP_ENV', 'local') !!}

        @if($fields['APP_URL'])
            {!! Form::label('APP_URL', 'Application URL') !!}
            {!! Form::text('APP_URL', $fields['APP_URL']) !!}
        @endif


        <div class="buttons buttons--right">
             <button class="button button--light" type="submit">{{ trans('messages.environment.save') }}</button>
        </div>
    </form>
    @if(!isset($environment['errors']))
    <div class="buttons">
        <a class="button" href="{{ route('LaravelInstaller::requirements') }}">
            {{ trans('messages.next') }}
        </a>
    </div>
    @endif
@stop