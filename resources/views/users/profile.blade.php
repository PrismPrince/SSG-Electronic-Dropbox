@extends('layouts.app')

@section('content')
  <div id="profile">
    <input type="hidden" id="code" value="{{ $user }}">
    <input type="hidden" id="url" value="{{ url('/api/user') }}">
    <div class="container">
      <div class="row">

        <div class="col-md-12 profile-top">
          <div class="panel panel-default">
            <div class="img-profile">
              <a class="btn btn-block btn-lg btn-default img-upload" href="#" data-toggle="tooltip" data-placement="bottom" title="Upload a Photo">
                <span class="glyphicon glyphicon-camera"></span>
              </a>
              <img src="/images/user.jpg" alt="">
            </div>
            <div class="dropdown change-role">
              <button class="btn btn-block btn-default dropdown-toggle" type="button" id="change-role" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Change Role <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="change-role">
                <li><a href="#">Student</a></li>
                <li><a href="#">Moderator</a></li>
                <li><a href="#">Admin</a></li>
                <!-- <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li> -->
              </ul>
            </div>
            <div class="panel-body">
              <h2 class="user-full-name">
                @{{user.first_name + ' ' + user.last_name}}
                <br>
                <small class="user-role">@{{user.role}}</small>
              </h2>
            </div>
          </div>
        </div>

        <div class="col-md-4 profile-aside">
          <div class="panel panel-default">
            <div class="panel-body">
              nothing
            </div>
            <div class="btn-group-vertical" role="group" aria-label="...">
              <a href="" class="btn btn-success btn-block">nothing</a>
              <a href="" class="btn btn-success btn-block">nothing</a>
              <a href="" class="btn btn-success btn-block">nothing</a>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><a class="btn btn-success btn-block" href="#">Posts</a></li>
              <li class="list-group-item"><a class="btn btn-success btn-block" href="#">Surveys</a></li>
              <li class="list-group-item"><a class="btn btn-success btn-block" href="#">Suggestions</a></li>
            </ul>
          </div>
        </div>

        <div class="col-md-8 profile-timeline">
          <div class="panel panel-default">
            <div class="panel-body">

              <div class="media">
                <div class="media-left media-middle">
                  <a href="#">
                    <img class="media-object" src="/images/user.jpg" alt="...">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">Middle aligned media</h4>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                </div>
              </div>

              {{-- <ul class="media-list">

                <li class="media">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" src="/images/user.jpg" alt="...">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">Media heading</h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.
                  </div>
                </li>

              </ul> --}}

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@stop

@push('scripts')
  <script src="/js/profile.js"></script>
@endpush