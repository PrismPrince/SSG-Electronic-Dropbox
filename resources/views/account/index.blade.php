@extends('layouts.app')

@section('content')

<div class="container root-content">
  <div class="row" v-cloak>
    <div class="col-md-8 col-md-offset-2">

      @if (session('status'))
        <alert-success>
          <strong>Success!</strong>
          {{ session('status') }}
        </alert-success>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Account Settings</div>
        <div class="panel-body">
          <p>You can change your informations here. Please use your real name so that people will know you.</p>
        </div>
        <ul class="list-group">
          <li class="list-group-item"><a href="{{ url('/account/name') }}">Change Name</a></li>
          <li class="list-group-item"><a href="{{ url('/account/email') }}">Change Email</a></li>
          <li class="list-group-item"><a href="{{ url('/account/password') }}">Change Password</a></li>
        </ul>
      </div>

    </div>
  </div>
</div>

@endsection

@push('scripts')
  <script src="/js/account.js"></script>
@endpush