@extends('layouts.app')

@section('content')

@if ($profile->role != 'student')

  @include('partials.modals._post-photos-modal')

  @if ($profile->id == Auth::id())

    @include('partials.modals._post-modal')
    @include('partials.modals._confirm-post-modal')
    @include('partials.modals._poll-modal')
    @include('partials.modals._post-photos-modal')
    @include('partials.modals._confirm-poll-modal')

  @endif

@else

  @if ($profile->id == Auth::id())

    @include('partials.modals._suggestion-modal')
    @include('partials.modals._confirm-suggestion-modal')

  @endif

@endif

@if (Auth::id() == $profile->id)

  @include('partials.modals._upload-profile-modal')

@endif

<nav class="navbar navbar-inverse navbar-fixed-bottom visible-xs-block" v-cloak>
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      @if ($profile->role != 'student')

        <li role="presentation" v-if="active != 'post'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('post')">Posts</a></li>
        <li role="presentation" v-else class="active"><a href="#" @click.prevent>Posts</a></li>

        <li role="presentation" v-if="active != 'poll'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('poll')">Polls</a></li>
        <li role="presentation" v-else class="active"><a href="#" @click.prevent>Polls</a></li>

      @else

        <li role="presentation" v-if="active != 'suggestion'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('suggestion')">Suggestions</a></li>
        <li role="presentation" v-else class="active"><a href="#" @click.prevent>Suggestions</a></li>

      @endif
    </ul>
  </div>
</nav>

<div class="container root-content nav-xs">

  <div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
      <div class="panel panel-default profile-top" v-cloak>

        <div v-if="!profile" class="panel-body">
          <div class="loading-circle"><span class="sr-only">loading...</span></div>
        </div> {{-- .panel-body --}}

        <div v-else class="panel-body">
          <div class="media">

            <div class="media-left">
              @if (Auth::id() == $profile->id)
                <a class="upload" href="#" @click.prevent="showModal('#upload-profile-modal', 'Upload')">
                  <span class="glyphicon glyphicon-camera"></span>
                </a>
              @endif

              <img class="media-image" :src="'{{ url('/image/user') }}/' + profile.id + '?wh=150'" :alt="profile.fname + ' ' + profile.lname">
            </div>

            <div class="media-body">
              <h1 class="media-heading">@{{profile.fname + ' ' + profile.lname}}</h1>
              <span class="text-capitalize text-muted">@{{profile.role}}</span>
            </div>

            @if (Auth::user()->role == 'administrator')

              <div class="media-right">
                <div class="dropdown pull-right">
                  <button class="btn btn-block btn-default dropdown-toggle" type="button" id="change-role" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Change Role <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="change-role">
                    <li v-if="profile.role != 'administrator'"><a href="#" @click.prevent="changeUserRole(profile.id, 'administrator')">Administrator</a></li>
                    <li v-if="profile.role != 'moderator'"><a href="#" @click.prevent="changeUserRole(profile.id, 'moderator')">Moderator</a></li>
                    <li v-if="profile.role != 'student'"><a href="#" @click.prevent="changeUserRole(profile.id, 'student')">Student</a></li>
                  </ul>
                </div>
              </div>

            @endif

          </div> {{-- .media --}}
        </div> {{-- .panel-body --}}

      </div> {{-- .panel --}}
    </div> {{-- .col-sm-12 --}}
  </div> {{-- .row --}}

  <div class="row">

    <div id="activity" class="col-sm-8 col-md-7 col-md-offset-1" v-cloak>

      @if ($profile->role != 'student')

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

        </div> {{-- .panel-group --}}

        <div class="panel-group" id="accordion-poll" role="tablist" aria-multiselectable="true" v-if="active == 'poll'">

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

        </div> {{-- .panel-group --}}

      @else

        <div class="panel-group" id="accordion-suggestion" role="tablist" aria-multiselectable="true" v-if="active == 'suggestion'">

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

        </div> {{-- .panel-group --}}

      @endif

    </div> {{-- .col-sm-8 --}}

    <div class="col-sm-4 col-md-3 hidden-xs" v-cloak>

      <div class="affix profile" data-offset-top="202" data-spy="affix">

        <ul class="nav nav-pills nav-stacked">

          @if ($profile->role != 'student')

            <li role="presentation" v-if="active != 'post'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('post')">Posts</a></li>
            <li role="presentation" v-else class="active"><a href="#" @click.prevent>Posts</a></li>

            <li role="presentation" v-if="active != 'poll'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('poll')">Polls</a></li>
            <li role="presentation" v-else class="active"><a href="#" @click.prevent>Polls</a></li>

          @else

            <li role="presentation" v-if="active != 'suggestion'" :class="{disabled: full == 'loading'}"><a href="#" @click.prevent="switchActivity('suggestion')">Suggestions</a></li>
            <li role="presentation" v-else class="active"><a href="#" @click.prevent>Suggestions</a></li>

          @endif

        </ul>

      </div> {{-- .affix --}}

    </div> {{-- .col-sm-4 --}}

  </div> {{-- .row --}}
</div> {{-- .container --}}

@stop

@push('scripts')
  <script src="{{ asset('/js/profile.min.js') }}"></script>
@endpush
