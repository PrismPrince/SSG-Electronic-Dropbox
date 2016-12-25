@extends('layouts.app')

@section('content')

<div class="modal fade" id="post-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" aria-label="Close" :disabled="post.disabled" @click="hidePostModal('#post-modal')"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Write a Post</h4>
      </div>

      <div class="modal-body">
        <div class="row">
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
                    :disabled="post.disabled"
                    v-model="post.title"
                    @keyup.enter.prevent="focusDesc"
                  >
                </h4>
                <textarea id="post-desc" class="form-control" placeholder="Write about it" :disabled="post.disabled" v-model="post.description"></textarea>
              </div>

            </div> {{-- .media --}}
          </div> {{-- .col-xs-12 --}}
        </div> {{-- .row --}}
      </div> {{-- .modal-body --}}

      <div class="modal-footer">
        <button type="button" class="btn btn-default" :disabled="post.disabled" @click="hidePostModal('#post-modal')">Cancel</button>
        <button type="button" class="btn btn-primary" id="post-submit" :disabled="post.disabled" @click.prevent="submitPost()">@{{action}}</button>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="confirm-post-modal" tabindex="-1" role="dialog" aria-labelledby="createPost">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" aria-label="Close" :disabled="post.disabled" @click="hidePostModal('#confirm-post-modal')"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createPost">Delete Post</h4>
      </div>

      <div class="modal-body">
        <div class="row" slot="modal-body">
          <div class="col-xs-12">
            Are you sure you want to delete this?
          </div>
        </div> {{-- .row --}}
      </div> {{-- .modal-body --}}

      <div class="modal-footer">
        <button type="button" class="btn btn-default" :disabled="post.disabled" @click="hidePostModal('#confirm-post-modal')">Cancel</button>
        <button type="button" class="btn btn-primary" :disabled="post.disabled" @click.prevent="deletePost()">@{{action}}</button>
      </div>

    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">

      <div class="row">
        <div class="col-xs-6">
          <button type="button" class="btn btn-block btn-default" @click="showPostModal('#post-modal', 'Post')">Write a Post</button>
        </div>

        <div class="col-xs-6">
          <button type="button" class="btn btn-block btn-default" @click="showPollModal('Create')">Create a Poll</button>
        </div>

        <div class="col-xs-12">
          <button type="button" class="btn btn-block btn-default" @click="showSuggestModal('Send')">Suggest</button>
        </div>
      </div> {{-- .row --}}

      <div class="panel panel-default">
        <ul class="list-group">
          <li class="list-group-item">
            {{-- URL to load posts --}}
            <input type="hidden" id="get-posts" value="{{ url('/api/post') }}">
            <a href="#">Posts</a>
          </li>
          <li class="list-group-item">
            {{-- URL to load polls --}}
            <input type="hidden" id="get-polls" value="{{ url('/api/poll') }}">
            <a href="#">Polls</a>
          </li>
          <li class="list-group-item">
            {{-- URL to load suggestions --}}
            <input type="hidden" id="get-suggestions" value="{{ url('/api/suggestion') }}">
            <a href="#">Suggestions</a>
          </li>
        </ul>
      </div> {{-- .panel --}}

      <pre>@{{$data}}</pre>
    </div> {{-- .col-sm-4 --}}

    <div id="activity" class="col-sm-8">


      <transition-group name="list">
        <panel-media
          :key="post.id"
          :profile="'{{ url('/profile') }}/' + post.user.id"
          :image="'/images/user.jpg'"
          :fullname="post.user.fname + ' ' + post.user.lname"
          :date="post.created_at"
          :opt="post.user.id == user.id ? true : false"
          v-for="post in posts.data">
          <ul slot="dropdown-menu" class="dropdown-menu">
            <li><a href="#" @click="editPost(post.id)">Edit</a></li>
            <li><a href="#" @click="confirmDeletePost(post.id)">Delete</a></li>
          </ul>
          <h5>@{{post.title}}</h5>
          <p>@{{post.desc}}</p>
        </panel-media>
      </transition-group>

      <div class="panel panel-default">
        <div class="panel-body">
          <a href="#" @click.prevent="getPosts">Load more...</a>
        </div>
      </div>

    </div> {{-- #activity --}} 

  </div> {{-- .row --}}
</div> {{-- .container --}}
@endsection

@push('scripts')
  <script src="/js/home.js"></script>
@endpush