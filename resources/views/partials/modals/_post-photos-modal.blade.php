<div class="modal fade" id="post-photos-modal" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" @click="hidePostPhotosModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">@{{carousel.title}}</h4>
      </div>
      <div id="carousel-post-photos" class="carousel" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li
            v-for="(photo, key) in carousel.photos"
            :class="{active: photo.id == carousel.photo.id}"
            :style="'background-image: url(\'{{ url('/image/post') }}/' + photo.name + '\')'"
            data-target="#carousel-post-photos"
            :data-slide-to="key"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div v-for="photo in carousel.photos" class="item" :class="{active: photo.id == carousel.photo.id}">
            <span></span><img :src="'{{ url('/image/post') }}/' + photo.name" :alt="photo.name">
          </div>
        </div>

        <!-- Controls -->
        <a v-if="carousel.photos.length > 1" class="left carousel-control" href="#carousel-post-photos" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a v-if="carousel.photos.length > 1" class="right carousel-control" href="#carousel-post-photos" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
