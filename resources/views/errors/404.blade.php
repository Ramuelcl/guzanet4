@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')

@section('message')
{{__($exception->getMessage() ?: 'Not Found')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection