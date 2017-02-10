<div class="modal fade" id="upload-profile-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <fieldset :disabled="disabled">

        <div class="modal-header">
          <button type="button" class="close" aria-label="Close" @click="hideModal('#upload-profile-modal')"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Upload a Photo</h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              <div class="image-up-btn-container" v-if="!imageUp.data">
                <p>
                  <label class="btn image-up-btn">
                    Upload a Photo
                    <input class="sr-only" accept="image/*" type="file" @change="onFileChange">
                  </label>
                  <span v-if="imageUp.error">@{{imageUp.error}}</span>
                </p>
              </div>
              <div class="image-up-container" v-else>

                <div v-if="imageUp.uploading" class="progress">
                  <div class="progress-bar progress-bar-striped active" role="progressbar" :aria-valuenow="imageUp.loaded" aria-valuemin="0" aria-valuemax="100" :style="'width: ' +  imageUp.loaded + '%'">
                    @{{imageUp.loaded}}%
                    <span class="sr-only">@{{imageUp.loaded}}% Complete</span>
                  </div>
                </div>

                <img v-else class="image-up" :src="imageUp.data">

              </div>
            </div>
          </div> {{-- .row --}}
        </div> {{-- .modal-body --}}

        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="hideModal('#upload-profile-modal')">Cancel</button>
          <button type="button" class="btn btn-primary" :disabled="btnImageUpDisabled" @click.prevent="uploadProfile(user.id)">@{{action}}</button>
        </div>

      </fieldset>
    </div>
  </div>
</div>
