@extends('layouts.app')

@section('content')

<modal modal-id="create-post" aria-labelled-by="createPost" modal-title="Write a Post" @close=''>
  <div class="row" slot="modal-body">
    <div class="col-xs-12">
    <div class="media">
      <div class="media-left">
        <a href="#">
          <img class="media-object" src="/images/user.jpg" alt="hehe">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">
          <input 
            id="post-title"
            type="text"
            class="form-control"
            placeholder="Write the title"
            required
            v-model="post.title"
            @keyup.enter.prevent="focusDesc"
          >
        </h4>
        <textarea id="post-desc" class="form-control" placeholder="Write about it" v-model="post.description"></textarea>
      </div>
    </div>
    </div>
  </div>

  <div slot="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="post-submit" @click.prevent="submitPost('{{ url('api/post/create') }}')">Post</button>
  </div>
</modal>

<input type="hidden" id="get-posts" value="{{ url('/api/post') }}">
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

      <transition-group name="fade">
        <panel-media :key="post.id" :fullname="post.user.fname + ' ' + post.user.lname" :date="post.created_at" :image="'/images/user.jpg'" v-for="post in posts.data">
          <h5>@{{post.title}}</h5>
          @{{post.desc}}
        </panel-media>
      </transition-group>

      <div class="panel panel-default">
        <div class="panel-body">
          <a href="#" @click.prevent="getPosts">Load more...</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script src="/js/home.js"></script>
@endpush