@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')

@section('message')
{{ __('Too Many Requests') }}
<br>
<hr>
<a href="{{ route('dashboard') }}" class="text-black">{{ __('Back')}}</a>
@endsection
