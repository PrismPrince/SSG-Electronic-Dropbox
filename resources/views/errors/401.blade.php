@extends('layouts.error')

@section('error-title', 'Unauthorized')

@section('error-code', '401')

@section('error-message')
The requested resource requires an authentication.<br>Go back to <a href="{{ url('/home') }}">Homepage</a>.
@endsection
