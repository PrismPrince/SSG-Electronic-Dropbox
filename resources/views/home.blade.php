@extends('layouts.app')

@section('content')

@include('partials.modals._post-photos-modal')

@if (Auth::user()->role != 'student')

  @include('partials.modals._post-modal')
  @include('partials.modals._confirm-post-modal')
  @include('partials.modals._poll-modal')
  @include('partials.modals._confirm-poll-modal')

@else

  @include('partials.modals._suggestion-modal')
  @include('partials.modals._confirm-suggestion-modal')

@endif

<nav class="navbar navbar-inverse navbar-fixed-bottom visible-xs-block" v-cloak>
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li v-if="active != 'post'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('post')"><span class="glyphicon glyphicon-blackboard"></span><span class="sr-only">Posts</span></a></li>
      <li v-else class="active"><a href="#" @click.prevent><span class="glyphicon glyphicon-blackboard"></span><span class="sr-only">Posts</span></a></li>

      <li v-if="active != 'poll'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('poll')"><span class="glyphicon glyphicon-stats"></span><span class="sr-only">Polls</span></a></li>
      <li v-else class="active"><a href="#" @click.prevent><span class="glyphicon glyphicon-stats"></span><span class="sr-only">Polls</span></a></li>

      <li v-if="active != 'suggestion'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('suggestion')"><span class="glyphicon glyphicon-comment"></span><span class="sr-only">Suggestions</span></a></li>
      <li v-else class="active"><a href="#" @click.prevent><span class="glyphicon glyphicon-comment"></span><span class="sr-only">Suggestions</span></a></li>
    </ul>

    @if (Auth::user()->role != 'student')

        <button
          v-if="active == 'post'"
          type="button"
          class="btn btn-primary btn-sm navbar-btn"
          @click="showModal('#post-modal', 'Post')"
        ><span class="glyphicon glyphicon-pencil"></span><span class="sr-only">Write a Post</</span></button>

        <button
          v-if="active == 'poll'"
          type="button"
          class="btn btn-primary btn-sm navbar-btn"
          @click="showModal('#poll-modal', 'Create')"
        ><span class="glyphicon glyphicon-list-alt"></span><span class="sr-only">Create a Poll</</span></button>

    @else

        <button
          v-if="active == 'suggestion'"
          type="button"
          class="btn btn-primary btn-sm navbar-btn"
          @click="showModal('#suggestion-modal', 'Send')"
        ><span class="glyphicon glyphicon-send"></span><span class="sr-only">Send a Suggestion</span></button>

    @endif
  </div>
</nav>

<div class="container root-content nav-xs">
  <div class="row">

    <div id="activity" class="col-sm-8 col-md-7 col-md-offset-1" v-cloak>

      <div class="panel-group" id="accordion-post" role="tablist" aria-multiselectable="true" v-if="active == 'post'">
        <transition-group name="list">
          <accordion-post
            v-for="post in posts"
            :key="post.id"
            :post-act="post"
            v-on:show-carousel-modal="showPostPhotosModal"
          >
            <div v-if="post.user.id == user.id" slot="dropdown-menu" class="media-right">
              <div class="dropdown pull-right">
                <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <span></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#" @click.prevent="edit(post.id)">Edit</a></li>
                  <li><a href="#" @click.prevent="showModal('#confirm-post-modal', 'Delete', post.id)">Delete</a></li>
                </ul>
              </div>
            </div>
          </accordion-post>
        </transition-group>

        <div v-if="!full" class="full-option text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="full-option"><div class="loading-circle"></div><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="full-option text-center"><span class="full"></span><span class="sr-only">No more post</span></div>
      </div>

      <div class="panel-group" id="accordion-poll" role="tablist" aria-multiselectable="true" v-else-if="active == 'poll'">
        <transition-group name="list">
          <accordion-poll
            v-for="poll in polls"
            :auth-user="user"
            :key="poll.id"
            :poll-act="poll"
          >
            <div v-if="poll.user.id == user.id" slot="dropdown-menu" class="media-right">
              <div class="dropdown pull-right">
                <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <span></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#" @click.prevent="edit(poll.id)">Edit</a></li>
                  <li><a href="#" @click.prevent="showModal('#confirm-poll-modal', 'Delete', poll.id)">Delete</a></li>
                </ul>
              </div>
            </div>
          </accordion-poll>
        </transition-group>

        <div v-if="!full" class="full-option text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="full-option"><div class="loading-circle"></div><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="full-option text-center"><span class="full"></span><span class="sr-only">No more poll</span></div>
      </div>

      <div class="panel-group" id="accordion-suggestion" role="tablist" aria-multiselectable="true" v-else-if="active == 'suggestion'">
        <transition-group name="list">
          <accordion-suggestion
            v-for="suggestion in suggestions"
            :auth-user="user"
            :key="suggestion.id"
            :suggestion-act="suggestion"
          >
            <div v-if="suggestion.user.id == user.id" slot="dropdown-menu" class="media-right">
              <div class="dropdown pull-right">
                <a class="option dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                  <span></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#" @click.prevent="edit(suggestion.id)">Edit</a></li>
                  <li><a href="#" @click.prevent="showModal('#confirm-suggestion-modal', 'Delete', suggestion.id)">Delete</a></li>
                </ul>
              </div>
            </div>
          </accordion-suggestion>
        </transition-group>

        <div v-if="!full" class="full-option text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="full-option"><div class="loading-circle"></div><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="full-option text-center"><span class="full"></span><span class="sr-only">No more suggestion</span></div>
      </div>

    </div> {{-- .col-sm-8 --}}

    <div class="col-sm-4 col-md-3 hidden-xs" v-cloak>

      <div class="affix" data-offset-top="0" data-spy="affix">

        <ul class="nav nav-pills nav-stacked">
          <li role="presentation" v-if="active != 'post'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('post')"><span class="glyphicon glyphicon-blackboard"></span>Posts</a></li>
          <li role="presentation" v-else class="active"><a href="#" @click.prevent><span class="glyphicon glyphicon-blackboard"></span>Posts</a></li>

          <li role="presentation" v-if="active != 'poll'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('poll')"><span class="glyphicon glyphicon-stats"></span>Polls</a></li>
          <li role="presentation" v-else class="active"><a href="#" @click.prevent><span class="glyphicon glyphicon-stats"></span>Polls</a></li>

          <li role="presentation" v-if="active != 'suggestion'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('suggestion')"><span class="glyphicon glyphicon-comment"></span>Suggestions</a></li>
          <li role="presentation" v-else class="active"><a href="#" @click.prevent><span class="glyphicon glyphicon-comment"></span>Suggestions</a></li>
        </ul>

        @if (Auth::user()->role != 'student')

            <button
              v-if="active == 'post'"
              type="button"
              class="btn btn-primary"
              @click="showModal('#post-modal', 'Post')"
            ><span class="glyphicon glyphicon-pencil"></span>Write a Post</button>

            <button
              v-if="active == 'poll'"
              type="button"
              class="btn btn-primary"
              @click="showModal('#poll-modal', 'Create')"
            ><span class="glyphicon glyphicon-list-alt"></span>Create a Poll</button>

        @else

            <button
              v-if="active == 'suggestion'"
              type="button"
              class="btn btn-primary"
              @click="showModal('#suggestion-modal', 'Send')"
            ><span class="glyphicon glyphicon-send"></span>Send a Suggestion</button>

        @endif

      </div> {{-- .affix --}}

    </div> {{-- .col-sm-4 --}}

  </div> {{-- .row --}}
</div> {{-- .container --}}

@endsection

@push('scripts')
  <script src="{{ asset('/js/home.min.js') }}"></script>
@endpush
