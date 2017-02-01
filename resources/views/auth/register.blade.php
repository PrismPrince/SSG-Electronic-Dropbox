@extends('layouts.app')

@section('content')

<div class="container root-content">
  <div class="row">
    <div class="col-md-8 col-md-offset-2" v-cloak>

      @if (
        $errors->has('first_name') ||
        $errors->has('middle_name') ||
        $errors->has('last_name') ||
        $errors->has('email') ||
        $errors->has('password')
      )
        <alert-danger>
          <strong>Error!</strong>
          <ul>
            @if ($errors->has('first_name'))
              <li>{{ $errors->first('first_name') }}</li>
            @endif
            @if ($errors->has('middle_name'))
              <li>{{ $errors->first('middle_name') }}</li>
            @endif
            @if ($errors->has('last_name'))
              <li>{{ $errors->first('last_name') }}</li>
            @endif
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
        <div class="panel-heading">Register</div>
        <div class="panel-body">
          <input type="hidden" id="errFname" value="{{ old('first_name') }}">
          <input type="hidden" id="errMname" value="{{ old('middle_name') }}">
          <input type="hidden" id="errLname" value="{{ old('last_name') }}">
          <input type="hidden" id="errEmail" value="{{ old('email') }}">
          <form id="registration-form" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div
              class="form-group"
              :class="errors.first_name.status != errors.first_name.dirty ? 'has-error' : ''"
            >
              <label for="first-name" class="col-md-4 control-label">First Name</label>

              <div class="col-md-6">
                <input
                  id="first-name"
                  type="text"
                  class="form-control"
                  name="first_name"
                  required
                  v-model.trim="first_name"
                  @keyup.enter.prevent="focusMiddleName"
                >

                <span class="help-block" v-if="errors.first_name.status != errors.first_name.dirty">
                  <strong>@{{errors.first_name.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.middle_name.status != errors.middle_name.dirty ? 'has-error' : ''"
            >
              <label for="middle-name" class="col-md-4 control-label">Middle Name</label>

              <div class="col-md-6">
                <input
                  id="middle-name"
                  type="text"
                  class="form-control"
                  name="middle_name"
                  v-model.trim="middle_name"
                  @keyup.enter.prevent="focusLastName"
                >

                <span class="help-block" v-if="errors.middle_name.status != errors.middle_name.dirty">
                  <strong>@{{errors.middle_name.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.last_name.status != errors.last_name.dirty ? 'has-error' : ''"
            >
              <label for="last-name" class="col-md-4 control-label">Last Name</label>

              <div class="col-md-6">
                <input
                  id="last-name"
                  type="text"
                  class="form-control"
                  name="last_name"
                  required
                  v-model.trim="last_name"
                  @keyup.enter.prevent="focusEmail"
                >

                <span class="help-block" v-if="errors.last_name.status != errors.last_name.dirty">
                  <strong>@{{errors.last_name.text}}</strong>
                </span>
              </div>
            </div>

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
                  @keyup.enter.prevent="focusPassword"
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
                  @keyup.enter.prevent="focusPasswordConfirm"
                >

                <span class="help-block" v-if="errors.password.status != errors.password.dirty">
                  <strong>@{{errors.password.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.password_confirm.status != errors.password_confirm.dirty ? 'has-error' : ''"
            >
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

              <div class="col-md-6">
                <input
                  id="password-confirm"
                  type="password"
                  class="form-control"
                  name="password_confirmation"
                  required
                  v-model="password_confirm"
                >

                <span class="help-block" v-if="errors.password_confirm.status != errors.password_confirm.dirty">
                  <strong>@{{errors.password_confirm.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" :disabled="btnDisabled">
                  Register
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
  <script src="/js/register.js"></script>
@endpush