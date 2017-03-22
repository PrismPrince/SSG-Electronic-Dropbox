/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

require('./../bootstrap.js')

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

require('./../app.js')
