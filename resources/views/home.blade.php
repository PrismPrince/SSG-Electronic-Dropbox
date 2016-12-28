@extends('layouts.app')

@section('content')

<div class="modal fade" id="post-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="post.disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hidePostModal('#post-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Write a Post</h4>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="post-title" class="control-label">Title</label>
            <input
              id="post-title"
              type="text"
              class="form-control"
              placeholder="Write the title"
              maxlength="255"
              required
              v-model.trim="post.title"
              @keyup.enter.prevent="focusNext('#post-desc')"
            >
          </div>

          <div class="form-group">
            <label for="post-desc" class="control-label">Description</label>
            <textarea
              id="post-desc"
              class="form-control"
              placeholder="Write about it"
              v-model.trim="post.desc"
            ></textarea>
          </div>

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hidePostModal('#post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" id="post-submit" @click.prevent="submitPost()">@{{post.action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-post-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="post.disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hidePostModal('#confirm-post-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Post</h4>
        </div>

        <div class="modal-body">
          <div class="row" slot="modal-body">
            <div class="col-xs-12">
              Are you sure you want to delete this?
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hidePostModal('#confirm-post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="deletePost()">@{{post.action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="poll-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="poll.disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hidePollModal('#poll-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create a Poll</h4>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="poll-title" class="control-label">Title</label>
            <input
              id="poll-title"
              type="text"
              class="form-control"
              placeholder="Write the title"
              maxlength="255"
              required
              v-model.trim="poll.title"
              @keyup.enter.prevent="focusNext('#poll-start')"
            >
          </div>

          <div class="form-group">
            <label for="poll-start" class="control-label">Start Date</label>
            <input
              id="poll-start"
              type="text"
              class="form-control"
              placeholder="When the poll starts"
              maxlength="255"
              required
              v-model.trim="poll.start"
              @keyup.enter.prevent="focusNext('#poll-end')"
            >
          </div>

          <div class="form-group">
            <label for="poll-end" class="control-label">End Date</label>
            <input
              id="poll-end"
              type="text"
              class="form-control"
              placeholder="When the poll ends"
              maxlength="255"
              required
              v-model.trim="poll.end"
              @keyup.enter.prevent="focusNext('#poll-type')"
            >
          </div>

          <div class="form-group">
            <label class="control-label">Type</label>
            <select
              id="poll-type"
              class="form-control"
              required
              v-model.trim="poll.type"
              @keyup.enter.prevent="focusNext('#poll-desc')"
            >
              <option value="" disabled hidden>Choose how the users vote</option>
              <option value="once">One answer</option>
              <option value="multi">Multiple answers</option>
            </select>
          </div>

          <div class="form-group">
            <label for="poll-desc" class="control-label">Description</label>
            <textarea
              id="poll-desc"
              class="form-control"
              placeholder="Write about it"
              v-model.trim="poll.desc"
            ></textarea>
          </div>

          <div class="form-group">
            <label for="poll-answers" class="control-label">Answers</label>
            <div class="input-group">
              <input
                id="poll-answers"
                type="text"
                class="form-control"
                placeholder="Add an answer"
                maxlength="255"
                required
                v-model.trim="poll.answer"
                @keyup.enter.prevent="addAnswer(poll.answer)"
              >
              <span class="input-group-btn">
                <button class="btn btn-info" type="button" @click="addAnswer(poll.answer)">
                  <span class="glyphicon glyphicon-plus"></span>
                </button>
              </span>
            </div>
          </div>

          <ul>
            <li
              v-for="(answer, key) in poll.answers"
            >
              <button v-if="poll.answers.length > 2" class="btn btn-xs btn-info" type="button" @click="removeAnswer(key)">
                <span class="glyphicon glyphicon-remove"></span>
              </button>
              @{{answer}}
            </li>
          </ul>

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hidePollModal('#poll-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" id="poll-submit" @click.prevent="submitPoll()">@{{poll.action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-poll-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="poll.disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hidePollModal('#confirm-poll-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Poll</h4>
        </div>

        <div class="modal-body">
          <div class="row" slot="modal-body">
            <div class="col-xs-12">
              Are you sure you want to delete this?
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hidePollModal('#confirm-poll-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="deletePoll()">@{{poll.action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="suggestion-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="suggestion.disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideSuggestionModal('#suggestion-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Send a Suggestion</h4>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label for="suggestion-title" class="control-label">Title</label>
            <input
              id="suggestion-title"
              type="text"
              class="form-control"
              placeholder="Write the title"
              maxlength="255"
              required
             
              v-model.trim="suggestion.title"
              @keyup.enter.prevent="focusNext('#suggestion-direct')"
            >
          </div>

          <div class="form-group">
            <label for="suggestion-direct" class="control-label">Direct</label>
            <input
              id="suggestion-direct"
              type="text"
              class="form-control"
              placeholder="To whom is the concern"
              maxlength="255"
              required
             
              v-model.trim="suggestion.direct"
              @keyup.enter.prevent="focusNext('#suggestion-message')"
            >
          </div>

          <div class="form-group">
            <label for="suggestion-message" class="control-label">Message</label>
            <textarea
              id="suggestion-message"
              class="form-control"
              placeholder="Write about it"
             
              v-model.trim="suggestion.message"
            ></textarea>
          </div>

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hidePostModal('#suggestion-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" id="suggestion-submit" @click.prevent="submitSuggestion()">@{{suggestion.action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-suggestion-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="suggestion.disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideSuggestionModal('#confirm-suggestion-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Suggestion</h4>
        </div>

        <div class="modal-body">
          <div class="row" slot="modal-body">
            <div class="col-xs-12">
              Are you sure you want to delete this?
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideSuggestionModal('#confirm-suggestion-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="deleteSuggestion()">@{{suggestion.action}}</button>
        </div>

      </fieldset>
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
          <button type="button" class="btn btn-block btn-default" @click="showPollModal('#poll-modal', 'Create')">Create a Poll</button>
        </div>

        <div class="col-xs-12">
          <button type="button" class="btn btn-block btn-default" @click="showSuggestionModal('#suggestion-modal', 'Send')">Send a Suggest</button>
        </div>
      </div> {{-- .row --}}

      <div class="panel panel-default">
        <ul class="list-group">
          <li class="list-group-item">
            {{-- URL to load posts --}}
            <input type="hidden" id="get-posts" value="{{ url('/api/post') }}">
            <a v-if="active != 'post'" href="#" @click.prevent="switchActivity('post')">Posts</a>
            <span v-else>Posts</span>
          </li>
          <li class="list-group-item">
            {{-- URL to load polls --}}
            <input type="hidden" id="get-polls" value="{{ url('/api/poll') }}">
            <a v-if="active != 'poll'" href="#" @click.prevent="switchActivity('poll')">Polls</a>
            <span v-else>Polls</span>
          </li>
          <li class="list-group-item">
            {{-- URL to load suggestions --}}
            <input type="hidden" id="get-suggestions" value="{{ url('/api/suggestion') }}">
            <a v-if="active != 'suggestion'" href="#" @click.prevent="switchActivity('suggestion')">Suggestions</a>
            <span v-else>Suggestions</span>
          </li>
        </ul>
      </div> {{-- .panel --}}

      <pre>@{{$data}}</pre>
    </div> {{-- .col-sm-4 --}}

    <div id="activity" class="col-sm-8">

      <div v-if="active == 'post'">
        <transition-group name="list">
          <panel-post
            v-for="post in posts.data"
            :key="post.id"
            :profile="'{{ url('/profile') }}/' + post.user.id"
            :image="'/images/user.jpg'"
            :fullname="post.user.fname + ' ' + post.user.lname"
            :date="post.created_at"
            :title="post.title"
            :desc="post.desc"
            :opt="post.user.id == user.id ? true : false">
            <ul slot="dropdown-menu" class="dropdown-menu">
              <li><a href="#" @click="editPost(post.id)">Edit</a></li>
              <li><a href="#" @click="confirmDeletePost(post.id)">Delete</a></li>
            </ul>
          </panel-post>
        </transition-group>

        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a v-if="!posts.full" href="#" @click.prevent="getPosts">Load more...</a>
            <span v-else>No more post</span>
          </div>
        </div>
      </div>

      <div v-else-if="active == 'poll'">
        <transition-group name="list">
          <panel-poll
            v-for="poll in polls.data"
            :key="poll.id"
            :profile="'{{ url('/profile') }}/' + poll.user.id"
            :image="'/images/user.jpg'"
            :fullname="poll.user.fname + ' ' + poll.user.lname"
            :date="poll.created_at"
            :title="poll.title"
            :desc="poll.desc"
            :start="poll.start"
            :end="poll.end"
            :status="poll.status"
            :opt="poll.user.id == user.id ? true : false">
            <ul slot="dropdown-menu" class="dropdown-menu">
              <li><a href="#" @click="editPoll(poll.id)">Edit</a></li>
              <li><a href="#" @click="confirmDeletePoll(poll.id)">Delete</a></li>
            </ul>
          </panel-poll>
        </transition-group>

        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a v-if="!polls.full" href="#" @click.prevent="getPolls">Load more...</a>
            <span v-else>No more poll</span>
          </div>
        </div>
      </div>

      <div v-else-if="active == 'suggestion'">
        <transition-group name="list">
          <panel-suggestion
            v-for="suggestion in suggestions.data"
            :key="suggestion.id"
            :profile="'{{ url('/profile') }}/' + suggestion.user.id"
            :image="'/images/user.jpg'"
            :fullname="suggestion.user.fname + ' ' + suggestion.user.lname"
            :date="suggestion.created_at"
            :title="suggestion.title"
            :direct="suggestion.direct"
            :message="suggestion.message"
            :opt="suggestion.user.id == user.id ? true : false">
            <ul slot="dropdown-menu" class="dropdown-menu">
              <li><a href="#" @click="editSuggestion(suggestion.id)">Edit</a></li>
              <li><a href="#" @click="confirmDeleteSuggestion(suggestion.id)">Delete</a></li>
            </ul>
          </panel-suggestion>
        </transition-group>

        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a v-if="!suggestions.full" href="#" @click.prevent="getSuggestions">Load more...</a>
            <span v-else>No more suggestion</span>
          </div>
        </div>
      </div>

      <div v-else>
      </div>

    </div> {{-- #activity --}} 

  </div> {{-- .row --}}
</div> {{-- .container --}}
@endsection

@push('scripts')
  <script src="/js/home.js"></script>
@endpush