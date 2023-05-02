@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')

@section('message')
{{__($exception->getMessage() ?: 'Page Expired')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection