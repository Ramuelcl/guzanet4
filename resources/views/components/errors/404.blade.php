@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')

@section('message')
{{ __('Not Found') }}
<br>
<hr>
<a href="{{ route('dashboard') }}" class="text-black">{{ __('Back')}}</a>
@endsection
