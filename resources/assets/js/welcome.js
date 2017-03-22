/*!!
 * ===================================================================================================
 * SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 * Copyright 2017 Dave Dane Pacilan
 * Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 * ===================================================================================================
 */

window.$ = window.jQuery = require('jquery')
require('bootstrap-sass')

$('body').scrollspy({target: "#app-navbar-collapse", offset: 50});
$("#app-navbar-collapse a").on('click', function(e) {
  if (this.hash !== "") {
    e.preventDefault()

    var hash = this.hash

    $('html, body').animate({
      scrollTop: $(hash).offset().top
    },
    800)
  }
})