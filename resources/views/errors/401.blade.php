@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')

@section('message')
{{__($exception->getMessage() ?: 'Unauthorized')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection