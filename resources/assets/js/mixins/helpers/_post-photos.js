Vue.mixin({

  data() {

    return {

      carousel: {
        title: '',
        photos: [],
        photo: null
      }

    }

  }, // data

  methods: {

    showPostPhotosModal(title, photos, photo) {


      this.carousel.title = title
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