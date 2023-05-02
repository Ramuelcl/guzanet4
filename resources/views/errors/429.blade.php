@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')

@section('message')
{{__($exception->getMessage() ?: 'Too Many Requests')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection