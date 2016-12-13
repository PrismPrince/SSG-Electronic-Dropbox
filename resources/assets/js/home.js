Vue.mixin({
  data() {
    return {
      user: null,
      post: {
        title: '',
        description: ''
        // error: {}
      },
      poll: {
        //
      },
      suggestion: {
        //
      },
      posts: {
        skip: 0,
        take: 5,
        data: []
      },
      polls: [],
      suggestions: []
    }
  },
  methods: {
    focusDesc() {
      document.getElementById('post-desc').focus()
    },
    submitPost(url) {
      var vm = this

      // disable input fields and button
      document.getElementById('post-title').disabled = true;
      document.getElementById('post-desc').disabled = true;
      document.getElementById('post-submit').disabled = true;

      // post request with the input data
      vm.$http.post(url,
      {
        id: vm.user.id,
        title: vm.post.title,
        desc: vm.post.description,
      }).then((response) => {

        $('#create-post').modal('hide')

        $('#create-post').on('hidden.bs.modal', function () {
          vm.post.title = ''
          vm.post.description = ''
          vm.posts.skip++

          document.getElementById('post-title').disabled = false;
          document.getElementById('post-desc').disabled = false;
          document.getElementById('post-submit').disabled = false;
        })

        vm.posts.data.splice(0, 0, response.data)

      }).catch((response) => {

        console.error(response.error)

        vm.post.title = ''
        vm.post.description = ''

        document.getElementById('post-title').disabled = false;
        document.getElementById('post-desc').disabled = false;
        document.getElementById('post-submit').disabled = false;

      })
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
    }
  },
  created() {
    this.$http.get(document.getElementById('get-user').value + '?id=' + document.getElementById('code').value)
      .then((response) => {
        this.user = response.data
      }).catch((response) => {
        console.error(response.error)
      })
    this.getPosts()
  }
});

require('./logout')