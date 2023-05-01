@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')

@section('message')
{{ __($exception->getMessage() ?: 'Forbidden') }}
<br>
<hr>
<a href="{{ route('dashboard') }}" class="text-black">{{ __('Back') }}</a>
@endsection
