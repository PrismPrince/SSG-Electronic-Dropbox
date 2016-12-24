Vue.mixin({
  data() {
    return {
      post: {
        id: null,
        title: '',
        description: ''
        // error: {}
      },
      posts: {
        skip: 0,
        take: 5,
        data: []
      }
    }
  },
  methods: {
    focusDesc() {
      document.getElementById('post-desc').focus()
    },
    showPostModal(selector, action = '', id = null, title = '', desc = '') {
      this.action = action
      this.post.id = id
      this.post.title = title
      this.post.description = desc

      $(selector).modal('show')
    },
    hidePostModal(selector, action = '', id = null, title = '', desc = '') {
      var vm = this

      $(selector).modal('hide')

      $(selector).on('hidden.bs.modal', function () {
        vm.action = action
        vm.post.id = id
        vm.post.title = title
        vm.post.description = desc

        document.getElementById('post-title').disabled = false;
        document.getElementById('post-desc').disabled = false;
        document.getElementById('post-submit').disabled = false;
      })
    },
    submitPost() {
      var vm = this

      if (vm.action != 'Update') {
        // disable input fields and button
        document.getElementById('post-title').disabled = true;
        document.getElementById('post-desc').disabled = true;
        document.getElementById('post-submit').disabled = true;

        // post request with the input data
        vm.$http.post(document.getElementById('get-posts').value,
        {
          id: vm.user.id,
          title: vm.post.title,
          desc: vm.post.description,
        }).then((response) => {

          vm.posts.skip++

          vm.hidePostModal('#post-modal')

          vm.posts.data.splice(0, 0, response.data)

        }).catch((response) => {

          console.error(response.error)

          // vm.action = ''
          // vm.post.title = ''
          // vm.post.description = ''

          // document.getElementById('post-title').disabled = false;
          // document.getElementById('post-desc').disabled = false;
          // document.getElementById('post-submit').disabled = false;

        })
      } else {
        // disable input fields and button
        document.getElementById('post-title').disabled = true;
        document.getElementById('post-desc').disabled = true;
        document.getElementById('post-submit').disabled = true;

        // put request with the updated data
        vm.$http.put(document.getElementById('get-posts').value + '/' + vm.post.id, {
          title: vm.post.title,
          desc: vm.post.description
        }).then((response) => {

          vm.hidePostModal('#post-modal')

          var i = _.indexOf(vm.posts.data, _.find(vm.posts.data, {id: response.data.id}))
          vm.posts.data.splice(i, 1, response.data)

        }).catch((response) => {
          console.error(response.error)

          // vm.action = ''
          // vm.post.id = null
          // vm.post.title = ''
          // vm.post.description = ''

          // document.getElementById('post-title').disabled = false;
          // document.getElementById('post-desc').disabled = false;
          // document.getElementById('post-submit').disabled = false;
        })
      }
    },
    getPosts() {
      this.$http.get(document.getElementById('get-posts').value + '?skip=' + this.posts.skip + '&take=' + this.posts.take)
        .then((response) => {
          if (response.data.length == 0) {
            // something to stop the button to load more.....
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
      this.$http.get(document.getElementById('get-posts').value + '/' + id + '/edit')
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
      this.$http.delete(document.getElementById('get-posts').value + '/' + this.post.id)
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