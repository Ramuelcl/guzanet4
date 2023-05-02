@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')

@section('message')
{{__($exception->getMessage() ?: 'Payment Required')}}
<br>
<br>
<a href="{{ route('home') }}">{{__('Volver al inicio')}}</a>
@endsection