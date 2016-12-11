@extends('layouts.app')

@section('content')
<div class="modal fade" id="create-post" tabindex="-1" role="dialog" aria-labelledby="createPost">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createPost">Modal title</h4>
      </div>
      <div class="modal-body">
        <div
          class="form-group"
          :class="errors.email.status != errors.email.changed ? 'has-error' : ''"
        >  
          <div class="col-md-6">
            <input
              id="title"
              type="text"
              class="form-control"
              name="title"
              required
              v-model="title"
              @keyup.enter.prevent="focusDesc"
            >
  
            <span class="help-block" v-if="errors.email.status != errors.email.changed">
              <strong>@{{errors.email.text}}</strong>
            </span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Post</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">

      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-xs-6">
            <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#create-post">Write a Post</button>
          </div>
          <div class="col-xs-6">
            <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#">Create a Poll</button>
          </div>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-body">
          <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#">Suggest</button>
        </div>
      </div>

      <div class="panel panel-default">
        <ul class="list-group">
          <li class="list-group-item"><a href="#">Posts</a></li>
          <li class="list-group-item"><a href="#">Polls</a></li>
          <li class="list-group-item"><a href="#">Suggestions</a></li>
        </ul>
      </div>

    </div>

    <div class="col-sm-8">

      <panel-media :fullname="'Dave Dane P'" :image="'/images/user.jpg'" v-for="n in 5">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum accusantium esse repellat quasi placeat, labore atque autem minima, sit est error sunt voluptatem nobis quas quis, molestias tempore animi ipsam.
      </panel-media>

      <div class="panel panel-default">
        <div class="panel-body">
          Load more...
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="/js/logout.js"></script>
@endpush