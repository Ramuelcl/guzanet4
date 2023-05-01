@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@section('message')
{{ __('Service Unavailable') }}
<br>
<hr>
<a href="{{ route('dashboard') }}" class="text-black">{{ __('Back')}}</a>
@endsection
