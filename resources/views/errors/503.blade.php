@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')

@section('message')
{{__($exception->getMessage() ?: 'Service Unavailable')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection