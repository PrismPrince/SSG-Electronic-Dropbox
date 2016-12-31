@extends('layouts.app')

@section('content')

<div class="modal fade" id="post-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#post-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Write a Post</h4>
        </div>

        <div class="modal-body">
          <div class="row">

            <div class="col-sm-12">
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
                  @keyup.enter.prevent="focus('#post-desc')"
                >
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="post-desc" class="control-label">Description</label>
                <textarea
                  id="post-desc"
                  class="form-control"
                  placeholder="Write about it"
                  v-model.trim="post.desc"
                ></textarea>
              </div>
            </div>

          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-post-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-post-modal')"><span aria-hidden="true">&times;</span></button>
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
          <button type="button" class="btn btn-default" @click="hideModal('#confirm-post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="destroy">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="poll-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#poll-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create a Poll</h4>
        </div>

        <div class="modal-body">
          <div class="row">

            <div class="col-sm-12">
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
                  @keyup.enter.prevent="focus('#poll-start')"
                >
              </div>
            </div>

            <div class="col-sm-5">
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
                  @keyup.enter.prevent="focus('#poll-end')"
                >
              </div>
            </div>

            <div class="col-sm-5">
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
                  @keyup.enter.prevent="focus('#poll-status')"
                >
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label for="poll-status" class="control-label">Status</label>
                <input
                  id="poll-status"
                  type="text"
                  class="form-control"
                  placeholder="Status"
                  maxlength="255"
                  required
                  readonly
                  v-model.trim="poll.status"
                  @keyup.enter.prevent="focus('#poll-type')"
                >
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label class="control-label">Type</label>
                <select
                  id="poll-type"
                  class="form-control"
                  required
                  v-model.trim="poll.type"
                  @keyup.enter.prevent="focus('#poll-desc')"
                >
                  <option value="" disabled hidden>Choose how the users vote</option>
                  <option value="once">One answer</option>
                  <option value="multi">Multiple answers</option>
                </select>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="poll-desc" class="control-label">Description</label>
                <textarea
                  id="poll-desc"
                  class="form-control"
                  placeholder="Write about it"
                  v-model.trim="poll.desc"
                ></textarea>
              </div>
            </div>

            <div class="col-sm-12">
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
            </div>

          <div class="col-sm-12">
            <ul class="list-group">
              <li class="list-group-item" v-for="(answer, key) in poll.answers">
                <button v-if="poll.answers.length > 2" class="remove btn btn-xs btn-danger" type="button" @click="removeAnswer(key)">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
                @{{answer.answer}}
              </li>
            </ul>
          </div>

          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#poll-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-poll-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-poll-modal')"><span aria-hidden="true">&times;</span></button>
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
          <button type="button" class="btn btn-default" @click="hideModal('#confirm-poll-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="destroy">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="suggestion-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#suggestion-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Send a Suggestion</h4>
        </div>

        <div class="modal-body">
          <div class="row">

            <div class="col-sm-12">
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
                  @keyup.enter.prevent="focus('#suggestion-direct')"
                >
              </div>
            </div>

            <div class="col-sm-12">
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
                  @keyup.enter.prevent="focus('#suggestion-message')"
                >
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-group">
                <label for="suggestion-message" class="control-label">Message</label>
                <textarea
                  id="suggestion-message"
                  class="form-control"
                  placeholder="Write about it"
                 
                  v-model.trim="suggestion.message"
                ></textarea>
              </div>
            </div>

          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#suggestion-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="modal fade" id="confirm-suggestion-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#confirm-suggestion-modal')"><span aria-hidden="true">&times;</span></button>
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
          <button type="button" class="btn btn-default" @click="hideModal('#confirm-suggestion-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" @click.prevent="destroy">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">

      <div class="row">
        <div v-if="active == 'post'" class="col-xs-12">
          <button type="button" class="btn btn-block btn-default" @click="showModal('#post-modal', 'Post')">Write a Post</button>
        </div>

        <div v-if="active == 'poll'" class="col-xs-12">
          <button type="button" class="btn btn-block btn-default" @click="showModal('#poll-modal', 'Create')">Create a Poll</button>
        </div>

        <div v-if="active == 'suggestion'" class="col-xs-12">
          <button type="button" class="btn btn-block btn-default" @click="showModal('#suggestion-modal', 'Send')">Send a Suggest</button>
        </div>
      </div> {{-- .row --}}

      <div class="panel panel-default">
        <div class="list-group">
          <button v-if="active != 'post'" class="list-group-item" @click="switchActivity('post')">Posts</button>
          <span class="list-group-item active" v-else>Posts</span>
          <button v-if="active != 'poll'" class="list-group-item" @click="switchActivity('poll')">Polls</button>
          <span class="list-group-item active" v-else>Polls</span>
          <button v-if="active != 'suggestion'" class="list-group-item" @click="switchActivity('suggestion')">Suggestions</button>
          <span class="list-group-item active" v-else>Suggestions</span>
        </div>
      </div> {{-- .panel --}}

    <pre>@{{$data}}</pre>
    </div> {{-- .col-sm-4 --}}

    <div id="activity" class="col-sm-8">

      <div v-if="active == 'post'">
        <transition-group name="list">
          <panel-post
            v-for="post in posts"
            :key="post.id"
            :profile="'{{ url('/profile') }}/' + post.user.id"
            :image="'/images/user.jpg'"
            :fullname="post.user.fname + ' ' + post.user.lname"
            :date="post.created_at"
            :title="post.title"
            :desc="post.desc"
            :opt="post.user.id == user.id ? true : false">
            <ul slot="dropdown-menu" class="dropdown-menu">
              <li><a href="#" @click.prevent="edit(post.id)">Edit</a></li>
              <li><a href="#" @click.prevent="showModal('#confirm-post-modal', 'Delete', post.id)">Delete</a></li>
            </ul>
          </panel-post>
        </transition-group>

        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a v-if="!full" href="#" @click.prevent="getAct">Load more...</a>
            <span v-else>No more post</span>
          </div>
        </div>
      </div>

      <div v-else-if="active == 'poll'">
        <transition-group name="list">
          <panel-poll
            v-for="poll in polls"
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
            :type="poll.type"
            :answers="poll.answers"
            :opt="poll.user.id == user.id ? true : false">
            <ul slot="dropdown-menu" class="dropdown-menu">
              <li><a href="#" @click.prevent="edit(poll.id)">Edit</a></li>
              <li><a href="#" @click.prevent="showModal('#confirm-poll-modal', 'Delete', poll.id)">Delete</a></li>
            </ul>
          </panel-poll>
        </transition-group>

        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a v-if="!full" href="#" @click.prevent="getAct">Load more...</a>
            <span v-else>No more poll</span>
          </div>
        </div>
      </div>

      <div v-else-if="active == 'suggestion'">
        <transition-group name="list">
          <panel-suggestion
            v-for="suggestion in suggestions"
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
              <li><a href="#" @click.prevent="edit(suggestion.id)">Edit</a></li>
              <li><a href="#" @click.prevent="showModal('#confirm-suggestion-modal', 'Delete', suggestion.id)">Delete</a></li>
            </ul>
          </panel-suggestion>
        </transition-group>

        <div class="panel panel-default">
          <div class="panel-body text-center">
            <a v-if="!full" href="#" @click.prevent="getAct">Load more...</a>
            <span v-else>No more suggestion</span>
          </div>
        </div>
      </div>

      <div v-else>
        Invalid!
      </div>

    </div> {{-- #activity --}} 

  </div> {{-- .row --}}
</div> {{-- .container --}}

@endsection

@push('scripts')
  <script src="/js/home.js"></script>
  <script src="/js/bootstrap-datetimepicker.min.js"></script>
@endpush

@push('styles')
  <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@endpush