@extends('layouts.app')

@section('content')

@if (Auth::user()->role != 'student')

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
                <div
                  class="form-group"
                  :class="post.errors.title.status != post.errors.title.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="post.errors.title.status != post.errors.title.dirty">
                    <strong>@{{post.errors.title.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-12">
                <div
                  class="form-group"
                  :class="post.errors.desc.status != post.errors.desc.dirty ? 'has-error' : ''"
                >
                  <label for="post-desc" class="control-label">Description</label>
                  <textarea
                    id="post-desc"
                    class="form-control"
                    placeholder="Write about it"
                    v-model.trim="post.desc"
                  ></textarea>

                  <span class="help-block" v-if="post.errors.desc.status != post.errors.desc.dirty">
                    <strong>@{{post.errors.desc.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

          </div> {{-- .modal-body --}}

          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="hideModal('#post-modal')">Cancel</button>
            <button type="button" class="btn btn-primary" :disabled="btnPostDisabled" @click.prevent="submitAct">@{{action}}</button>
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
            <div class="row">
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
                <div
                  class="form-group"
                  :class="poll.errors.title.status != poll.errors.title.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="poll.errors.title.status != poll.errors.title.dirty">
                    <strong>@{{poll.errors.title.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-6">
                <div
                  class="form-group"
                  :class="poll.errors.start.status != poll.errors.start.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="poll.errors.start.status != poll.errors.start.dirty">
                    <strong>@{{poll.errors.start.text}}</strong>
                  </span>

                </div>
              </div>

              <div class="col-sm-6">
                <div
                  class="form-group"
                  :class="poll.errors.end.status != poll.errors.end.dirty ? 'has-error' : ''"
                >
                  <label for="poll-end" class="control-label">End Date</label>
                  <input
                    id="poll-end"
                    type="text"
                    class="form-control"
                    placeholder="When the poll ends"
                    maxlength="255"
                    required
                    v-model.trim="poll.end"
                    @keyup.enter.prevent="focus('#poll-type')"
                  >

                  <span class="help-block" v-if="poll.errors.end.status != poll.errors.end.dirty">
                    <strong>@{{poll.errors.end.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-6">
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
                    v-model.trim="pollstatus"
                  >

                </div>
              </div>

              <div class="col-sm-6">
                <div
                  class="form-group"
                  :class="poll.errors.type.status != poll.errors.type.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="poll.errors.type.status != poll.errors.type.dirty">
                    <strong>@{{poll.errors.type.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-12">
                <div
                  class="form-group"
                  :class="poll.errors.desc.status != poll.errors.desc.dirty ? 'has-error' : ''"
                >
                  <label for="poll-desc" class="control-label">Description</label>
                  <textarea
                    id="poll-desc"
                    class="form-control"
                    placeholder="Write about it"
                    v-model.trim="poll.desc"
                  ></textarea>

                  <span class="help-block" v-if="poll.errors.desc.status != poll.errors.desc.dirty">
                    <strong>@{{poll.errors.desc.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-12">
                <div
                  class="form-group"
                  :class="poll.errors.answer.status != poll.errors.answer.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="poll.errors.answer.status != poll.errors.answer.dirty">
                    <strong>@{{poll.errors.answer.text}}</strong>
                  </span>

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
            <button type="button" class="btn btn-primary" :disabled="btnPollDisabled" @click.prevent="submitAct">@{{action}}</button>
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
            <div class="row">
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

@else

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
                <div
                  class="form-group"
                  :class="suggestion.errors.title.status != suggestion.errors.title.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="suggestion.errors.title.status != suggestion.errors.title.dirty">
                    <strong>@{{suggestion.errors.title.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-12">
                <div
                  class="form-group"
                  :class="suggestion.errors.direct.status != suggestion.errors.direct.dirty ? 'has-error' : ''"
                >
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

                  <span class="help-block" v-if="suggestion.errors.direct.status != suggestion.errors.direct.dirty">
                    <strong>@{{suggestion.errors.direct.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

            <div class="row">

              <div class="col-sm-12">
                <div
                  class="form-group"
                  :class="suggestion.errors.message.status != suggestion.errors.message.dirty ? 'has-error' : ''"
                >
                  <label for="suggestion-message" class="control-label">Message</label>
                  <textarea
                    id="suggestion-message"
                    class="form-control"
                    placeholder="Write about it"
                   
                    v-model.trim="suggestion.message"
                  ></textarea>

                  <span class="help-block" v-if="suggestion.errors.message.status != suggestion.errors.message.dirty">
                    <strong>@{{suggestion.errors.message.text}}</strong>
                  </span>

                </div>
              </div>

            </div> {{-- .row --}}

          </div> {{-- .modal-body --}}

          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="hideModal('#suggestion-modal')">Cancel</button>
            <button type="button" class="btn btn-primary" :disabled="btnSuggestionDisabled" @click.prevent="submitAct">@{{action}}</button>
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
            <div class="row">
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

@endif

<div class="container root-content">
  <div class="row">

    <div id="activity" class="col-sm-8 col-md-7 col-md-offset-1" v-cloak>

      <div class="panel-group" id="accordion-post" role="tablist" aria-multiselectable="true" v-if="active == 'post'">
        <transition-group name="list">
          <accordion-post
            v-for="post in posts"
            :key="post.id"
            :post-act="post"
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

        <div class="nav-aside list-group">

          <button
            class="list-group-item"
            v-if="active != 'post'"
            :class="{disabled: full == 'loading'}"
            :disabled="full == 'loading'"
            @click="switchActivity('post')"
          >Posts</button>
          <button class="list-group-item active disabled" v-else disabled>Posts</button>

          <button
            class="list-group-item"
            v-if="active != 'poll'"
            :class="{disabled: full == 'loading'}"
            :disabled="full == 'loading'"
            @click="switchActivity('poll')"
          >Polls</button>
          <button class="list-group-item active disabled" v-else disabled>Polls</button>

          <button
            class="list-group-item"
            v-if="active != 'suggestion'"
            :class="{disabled: full == 'loading'}"
            :disabled="full == 'loading'"
            @click="switchActivity('suggestion')"
          >Suggestions</button>
          <button class="list-group-item active disabled" v-else disabled>Suggestions</button>

        </div> {{-- .nav-aside --}}

        @if (Auth::user()->role != 'student')

            <button
              v-if="active == 'post'"
              type="button"
              class="btn btn-primary"
              @click="showModal('#post-modal', 'Post')"
            >Write a Post</button>

            <button
              v-if="active == 'poll'"
              type="button"
              class="btn btn-primary"
              @click="showModal('#poll-modal', 'Create')"
            >Create a Poll</button>

        @else

            <button
              v-if="active == 'suggestion'"
              type="button"
              class="btn btn-primary"
              @click="showModal('#suggestion-modal', 'Send')"
            >Send a Suggest</button>

        @endif

      </div> {{-- .affix --}}

    </div> {{-- .col-sm-4 --}}

  </div> {{-- .row --}}
</div> {{-- .container --}}

@endsection

@push('scripts')
  <script src="/js/home.js"></script>
@endpush