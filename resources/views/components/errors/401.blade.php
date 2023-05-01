@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message')
    {{ __('Unauthorized') }}
    <br>
    <hr>
    <a href="{{ route('dashboard') }}" class="text-black">{{ __('Back') }}</a>
@endsection
