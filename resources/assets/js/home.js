Vue.mixin({
  data() {
    return {
      user: null,
      post: {
        title: '',
        description: ''
      },
      poll: {
        //
      },
      suggestion: {
        //
      },
      posts: [],
      polls: [],
      suggestions: []
    }
  },
  methods: {
    focusDesc() {
      document.getElementById('desc').focus()
    },
    submitPost(url) {
      document.getElementById('desc').focus()
      this.$http.post(url,
      {
        id: this.user,
        title: this.post.title,
        desc: this.post.description,
      }).then((response) => {
        console.log(response.data)
      }).catch((response) => {
        console.error(response.error)
      })
    }
  },
  mounted() {
    this.user = document.getElementById('code').value
  }
});

require('./logout')