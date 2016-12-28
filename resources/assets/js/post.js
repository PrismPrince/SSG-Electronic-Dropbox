Vue.mixin({
  data() {
    return {
      post: {
        id: null,
        title: '',
        desc: '',
        action: '',
        disabled: true
        // error: {}
      },
      posts: {
        skip: 0,
        take: 5,
        full: false,
        data: []
      }
    }
  },
  methods: {
    showPostModal(selector, action = '', id = null, title = '', desc = '') {
      this.post.action = action
      this.post.id = id
      this.post.title = title
      this.post.desc = desc

      this.enablePostInput()

      $(selector).modal('show')
    },
    hidePostModal(selector, action = '', id = null, title = '', desc = '') {
      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.post.action = action
        vm.post.id = id
        vm.post.title = title
        vm.post.desc = desc
      })
    },
    disablePostInput() {
      this.post.disabled = true
    },
    enablePostInput() {
      this.post.disabled = false
    },
    submitPost() {
      var vm = this

      if (vm.post.action != 'Update') {
        // disable input fields and button
        vm.disablePostInput()

        // post request with the input data
        vm.$http.post(window.location.origin + '/api/post', {
          title: vm.post.title,
          desc: vm.post.desc
        }).then((response) => {

          vm.posts.skip++

          vm.hidePostModal('#post-modal')
          vm.enablePostInput()

          vm.posts.data.splice(0, 0, response.data)

        }).catch((response) => {
          console.error(response.error)
        })
      } else {
        // disable input fields and button
        vm.disablePostInput()

        // put request with the updated data
        vm.$http.put(window.location.origin + '/api/post/' + vm.post.id, {
          title: vm.post.title,
          desc: vm.post.desc
        }).then((response) => {

          vm.hidePostModal('#post-modal')
          vm.enablePostInput()

          var i = _.indexOf(vm.posts.data, _.find(vm.posts.data, {id: response.data.id}))
          vm.posts.data.splice(i, 1, response.data)

        }).catch((response) => {
          console.error(response.error)
        })
      }
    },
    getPosts() {
      this.$http.get(window.location.origin + '/api/post?skip=' + this.posts.skip + '&take=' + this.posts.take)
        .then((response) => {
          if (response.data.length == 0 || response.data.length < 5) {
            this.posts.full = true
          }

          this.posts.skip += 5

          for (var i = 0; i <= response.data.length - 1; i++) {
            this.posts.data.push(response.data[i])
          }

        }).catch((response) => {
          console.error(response.error)
        })
    },
    editPost(id) {
      this.$http.get(window.location.origin + '/api/post/' + id + '/edit')
        .then((response) => {
          this.showPostModal('#post-modal', 'Update', response.data.id, response.data.title, response.data.desc)
        }).catch((response) => {
          console.error(response.error)
        })
    },
    confirmDeletePost(id) {
      this.showPostModal('#confirm-post-modal', 'Delete', id)
    },
    deletePost() {
      this.$http.delete(window.location.origin + '/api/post/' + this.post.id)
        .then((response) => {
          this.posts.skip--

          var i = _.indexOf(this.posts.data, _.find(this.posts.data, {id: response.data.id}))
          this.posts.data.splice(i, 1)

          this.hidePostModal('#confirm-post-modal')
        }).catch((response) => {
          console.error(response.error)
        })
    }
  }
})