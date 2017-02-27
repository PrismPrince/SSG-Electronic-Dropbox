@extends('layouts.error')

@section('error-title', 'Webservice Currently Unavailable')

@section('error-code', '502')

@section('error-message')
We've got some trouble with our backend upstream cluster.<br>Our service team has been dispatched to bring it back online.
@endsection
