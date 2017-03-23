@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container root-content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2" v-cloak>

      @if (session('status'))
        <div class="alert alert-success">
          <span class="glyphicon glyphicon-ok-sign"></span>
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->has('email'))
        <alert-danger>
          <span class="glyphicon glyphicon-exclamation-sign"></span>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('email'))
              <li>{{ $errors->first('email') }}</li>
            @endif
          </ul>
        </alert-danger>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Reset Password</div>
        <div class="panel-body">
          <input type="hidden" id="errEmail" value="{{ old('email') }}">
          <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}

            <div
              class="form-group"
              :class="errors.email.status != errors.email.dirty ? 'has-error' : ''"
            >

              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  required
                  v-model="email"
                >

                <span class="help-block" v-if="errors.email.status != errors.email.dirty">
                  <strong>@{{errors.email.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Send Password Reset Link
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('/js/email.min.js') }}"></script>
@endpush
