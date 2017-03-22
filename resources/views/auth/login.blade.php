@extends('layouts.app')

@section('content')

<div class="container root-content">
  <div class="row" v-cloak>
    <div class="col-md-8 col-md-offset-2">

      @if ($errors->has('email') || $errors->has('password'))
        <alert-danger>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('email'))
              <li>{{ $errors->first('email') }}</li>
            @endif
            @if ($errors->has('password'))
              <li>{{ $errors->first('password') }}</li>
            @endif
          </ul>
        </alert-danger>
      @endif

      <div class="panel panel-default">
        <div class="panel-heading">Login</div>
        <div class="panel-body">
          <input type="hidden" id="errEmail" value="{{ old('email') }}">
          <form id="login-form" class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
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
                  @keyup.enter.prevent="focus('#password')"
                >

                <span class="help-block" v-if="errors.email.status != errors.email.dirty">
                  <strong>@{{errors.email.text}}</strong>
                </span>
              </div>
            </div>
      
            <div
              class="form-group"
              :class="errors.password.status != errors.password.dirty ? 'has-error' : ''"
            >
              <label for="password" class="col-md-4 control-label">Password</label>
      
              <div class="col-md-6">
                <input
                  id="password"
                  type="password"
                  class="form-control"
                  name="password"
                  required
                  v-model="password"
                >
      
                <span class="help-block" v-if="errors.password.status != errors.password.dirty">
                  <strong>@{{errors.password.text}}</strong>
                </span>
              </div>
            </div>
      
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input
                      id="remember"
                      type="checkbox"
                      name="remember"
                    > Remember Me
                  </label>
                </div>
              </div>
            </div>
      
            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Login
                </button>
      
                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                  Forgot Your Password?
                </a>
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
  <script src="{{ asset('/js/login.min.js') }}"></script>
@endpush