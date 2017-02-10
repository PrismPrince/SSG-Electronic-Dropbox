require('./../mixins/_http-interceptor')
require('./../mixins/_get-auth-user')
require('./../mixins/_logout')
require('./../mixins/_quick-search')

// helpers
require('./../mixins/helpers/_focus')

Vue.mixin({
  data() {
    return {
      user: null,
      oldPassword: '',
      newPassword: '',
      newPasswordConfirm: '',
      errors: {
        oldPassword: {
          dirty: false,
          status: false,
          text: ''
        },
        newPassword: {
          dirty: false,
          status: false,
          text: ''
        },
        newPasswordConfirm: {
          dirty: false,
          status: false,
          text: ''
        }
      }
    }
  },

  watch: {
    oldPassword() {
      this.errors.oldPassword.dirty = true

      if (this.oldPassword == '') {
        this.errors.oldPassword.status = false
        this.errors.oldPassword.text = 'Old password cannot be empty.'
      }
      else {
        this.errors.oldPassword.status = true
        this.errors.oldPassword.text = ''
      }
    },
    newPassword() {
      this.errors.newPassword.dirty = true

      var p = this.newPassword

      if (p == '') {
        this.errors.newPassword.status = false
        this.errors.newPassword.text = 'New password cannot be empty.'
      } else if (p.length < 6) {
        this.errors.newPassword.status = false
        this.errors.newPassword.text = 'New password must be atleast 6 characters.'
      } else {
        this.errors.newPassword.status = true
        this.errors.newPassword.text = ''
      }
    },
    newPasswordConfirm() {
      this.errors.newPasswordConfirm.dirty = true

      var p = this.newPassword
      var c = this.newPasswordConfirm

      if (c == '') {
        this.errors.newPasswordConfirm.status = false
        this.errors.newPasswordConfirm.text = 'Confirm your new password.'
      } else if (p != c) {
        this.errors.newPasswordConfirm.status = false
        this.errors.newPasswordConfirm.text = 'New password does not match.'
      } else {
        this.errors.newPasswordConfirm.status = true
        this.errors.newPasswordConfirm.text = ''
      }
    }
  },
  computed: {
    btnDisabled() {
      return (
        this.errors.oldPassword.status &&
        this.errors.newPassword.status &&
        this.errors.newPasswordConfirm.status
      ) ? false : true
    }
  }
})
