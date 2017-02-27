@extends('layouts.error')

@section('error-title', 'Bad Request')

@section('error-code', '400')

@section('error-message')
The server cannot process the request due to something that is perceived to be a client error.<br>Go back to <a href="{{ url('/home') }}">Homepage</a>.
@endsection
