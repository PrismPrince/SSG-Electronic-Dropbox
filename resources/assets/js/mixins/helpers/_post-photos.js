Vue.mixin({

  data() {

    return {

      carousel: {
        photos: [],
        photo: null
      }

    }

  }, // data

  methods: {

    showPostPhotosModal(photos, photo) {


      this.carousel.photos = photos
      this.carousel.photo = photo

      $('#post-photos-modal').modal('show')

    }, // showPostPhotosModal

    hidePostPhotosModal() {

      this.carousel.photos = []
      this.carousel.photo = null

      $('#post-photos-modal').modal('hide')

    } // hidePostPhotosModal


  } // methods

})