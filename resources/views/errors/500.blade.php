@extends('layouts.error')

@section('error-title', 'Internal Service Error')

@section('error-code', '500')

@section('error-message')
An unexpected condition was encountered.<br>Our service team has been dispatched to bring it back online.<br>Go back to <a href="{{ url('/home') }}">Homepage</a>.
@endsection
