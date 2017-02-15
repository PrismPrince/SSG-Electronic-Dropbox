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
                :class="{'has-error': post.errors.title.status != post.errors.title.dirty}"
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
                :class="{'has-error': post.errors.desc.status != post.errors.desc.dirty}"
              >
                <label for="post-desc" class="control-label">Description</label>
                <textarea
                  id="post-desc"
                  class="form-control"
                  placeholder="Write about it"
                  required
                  v-model.trim="post.desc"
                  @keyup.enter.prevent="focus('#post-photos')"
                ></textarea>

                <span class="help-block" v-if="post.errors.desc.status != post.errors.desc.dirty">
                  <strong>@{{post.errors.desc.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div class="row" v-if="action != 'Update'">

            <div class="col-sm-12">

              <div
                class="form-group"
                :class="{'has-error': post.errors.photos.status}"
              >
                <span class="post-photos-uploaded" v-for="(photo, key) in post.photos.data" :style="'background-image: url(\'' + photo + '\')'">
                  <button type="button" class="close" aria-label="Close" @click="removePhoto(key)">&times;</button>
                </span>
                <label v-if="post.photos.data.length < 15" for="post-photos" class="btn image-up-btn">Add photos
                  <input
                    id="post-photos"
                    type="file"
                    class="sr-only"
                    accept="image/*"
                    multiple
                    @change="onFileChange"
                  >
                </label>

                <span class="help-block" v-if="post.errors.photos.status">
                  <strong>@{{post.errors.photos.text}}</strong>
                </span>

              </div>
            </div>

          </div> {{-- .row --}}

          <div v-if="post.photos.uploading" class="row">
            <div class="col-sm-12">
              <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" :aria-valuenow="post.photos.loaded" aria-valuemin="0" aria-valuemax="100" :style="'width: ' +  post.photos.loaded + '%'">
                  @{{post.photos.loaded}}%
                  <span class="sr-only">@{{post.photos.loaded}}% Complete</span>
                </div>
              </div>
            </div>
          </div>

        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#post-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" :disabled="btnPostDisabled" @click.prevent="submitAct">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>
