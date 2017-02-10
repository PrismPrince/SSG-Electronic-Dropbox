Vue.mixin({

  methods: {

    clearPolls() {

      this.skip  	= 0
      this.take  	= 10
      this.full  	= false
      this.polls 	= []

    } // clearPolls

  } // methods

})