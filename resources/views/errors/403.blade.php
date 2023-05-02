@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
{{__($exception->getMessage() ?: 'Forbidden')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection