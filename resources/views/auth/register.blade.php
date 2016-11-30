@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

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
          <form id="registration-form" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}

            <div
              class="form-group"
              :class="errors.first_name.status != errors.first_name.changed ? 'has-error' : ''"
            >
              <label for="first-name" class="col-md-4 control-label">First Name</label>

              <div class="col-md-6">
                <input
                  id="first-name"
                  type="text"
                  class="form-control"
                  name="first_name"
                  value="{{ old('first_name') }}"
                  required
                  v-model.trim="first_name"
                  @keyup.enter="focusMiddleName"
                >

                <span class="help-block" v-if="errors.first_name.status != errors.first_name.changed">
                  <strong>@{{errors.first_name.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.middle_name.status != errors.middle_name.changed ? 'has-error' : ''"
            >
              <label for="middle-name" class="col-md-4 control-label">Middle Name</label>

              <div class="col-md-6">
                <input
                  id="middle-name"
                  type="text"
                  class="form-control"
                  name="middle_name"
                  value="{{ old('middle_name') }}"
                  v-model.trim="middle_name"
                  @keyup.enter="focusLastName"
                >

                <span class="help-block" v-if="errors.middle_name.status != errors.middle_name.changed">
                  <strong>@{{errors.middle_name.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.last_name.status != errors.last_name.changed ? 'has-error' : ''"
            >
              <label for="last-name" class="col-md-4 control-label">Last Name</label>

              <div class="col-md-6">
                <input
                  id="last-name"
                  type="text"
                  class="form-control"
                  name="last_name"
                  value="{{ old('last_name') }}"
                  required
                  v-model.trim="last_name"
                  @keyup.enter="focusEmail"
                >

                <span class="help-block" v-if="errors.last_name.status != errors.last_name.changed">
                  <strong>@{{errors.last_name.text}}</strong>
                </span>
              </div>
            </div>                        

            <div
              class="form-group"
              :class="errors.email.status != errors.email.changed ? 'has-error' : ''"
            >
              <label for="email" class="col-md-4 control-label">E-Mail Address</label>

              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  value="{{ old('email') }}"
                  required
                  v-model="email"
                  @keyup.enter="focusPassword"
                >

                <span class="help-block" v-if="errors.email.status != errors.email.changed">
                  <strong>@{{errors.email.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.password.status != errors.password.changed ? 'has-error' : ''"
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
                  @keyup.enter="focusPasswordConfirm"
                >

                <span class="help-block" v-if="errors.password.status != errors.password.changed">
                  <strong>@{{errors.password.text}}</strong>
                </span>
              </div>
            </div>

            <div
              class="form-group"
              :class="errors.password_confirm.status != errors.password_confirm.changed ? 'has-error' : ''"
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
                  @keyup.enter="submitRegistrationForm"
                >

                <span class="help-block" v-if="errors.password_confirm.status != errors.password_confirm.changed">
                  <strong>@{{errors.password_confirm.text}}</strong>
                </span>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" @click.prevent="submitRegistrationForm" :disabled="btnDisabled">
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
