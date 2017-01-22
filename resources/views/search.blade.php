@extends('layouts.app')

@section('content')

<div class="container root-content">

  <div class="row">

    <div class="col-md-8 col-md-offset-2 search">
      <ul class="nav nav-tabs">
        <li role="presentation" :class="{active: active == 'user' ? true : false}"><a href="#" @click.prevent="switchActivity('user')">Users</a></li>
        <li role="presentation" :class="{active: active == 'post' ? true : false}"><a href="#" @click.prevent="switchActivity('post')">Posts</a></li>
        <li role="presentation" :class="{active: active == 'poll' ? true : false}"><a href="#" @click.prevent="switchActivity('poll')">Polls</a></li>
        <li role="presentation" :class="{active: active == 'suggestion' ? true : false}"><a href="#" @click.prevent="switchActivity('suggestion')">Suggestions</a></li>
      </ul>

      <div v-if="active == 'user'" class="list-group">
        <transition-group name="list">
          <panel-search
            v-for="user in users"
            :key="user.id"
            :url="'profile/' + user.id"
            :head="hl(user.fname + ' ' + user.lname)"
            :body="user.role"
          ></panel-search>
        </transition-group>

        <div v-if="!full" class="text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="loading-circle"><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="text-center"><span class="full"></span><span class="sr-only">No more users</span></div>
      </div>

      <div v-else-if="active == 'post'" class="list-group">
        <transition-group name="list">
          <panel-search
            v-for="post in posts"
            :key="post.id"
            :url="'post/' + post.id"
            :head="hl(post.title)"
            :body="hl(post.desc)"
          ></panel-search>
        </transition-group>

        <div v-if="!full" class="text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="loading-circle"><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="text-center"><span class="full"></span><span class="sr-only">No more post</span></div>
      </div>

      <div v-else-if="active == 'poll'" class="list-group">
        <transition-group name="list">
          <panel-search
            v-for="poll in polls"
            :auth-user="user"
            :key="poll.id"
            :url="'poll/' + poll.id"
            :head="hl(poll.title)"
            :body="hl(poll.desc)"
          ></panel-search>
        </transition-group>

        <div v-if="!full" class="text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="loading-circle"><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="text-center"><span class="full"></span><span class="sr-only">No more poll</span></div>
      </div>

      <div v-else-if="active == 'suggestion'" class="list-group">
        <transition-group name="list">
          <panel-search
            v-for="suggestion in suggestions"
            :key="suggestion.id"
            :url="'suggestion/' + suggestion.id"
            :head="hl(suggestion.title)"
            :body="hl(suggestion.message)"
          ></panel-search>
        </transition-group>

        <div v-if="!full" class="text-center"><a href="#" @click.prevent="getAct">Load more...</a></div>
        <div v-else-if="full == 'loading'" class="loading-circle"><span class="sr-only">loading...</span></div>
        <div v-else-if="full" class="text-center"><span class="full"></span><span class="sr-only">No more suggestion</span></div>
      </div>

      <div v-else class="text-center">
        No Activities!
      </div>

    </div> {{-- .col-md-8 --}}
  </div> {{-- .row --}}
</div> {{-- .contaiiner --}}

@endsection

@push('scripts')
  <script src="/js/search.js"></script>
@endpush