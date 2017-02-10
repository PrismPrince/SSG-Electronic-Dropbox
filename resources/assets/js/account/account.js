require('./../mixins/_http-interceptor')
require('./../mixins/_get-auth-user')
require('./../mixins/_logout')
require('./../mixins/_quick-search')

Vue.mixin({
  data() {
    return {
      user: null
    }
  }
})
