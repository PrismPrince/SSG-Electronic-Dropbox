/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmory imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmory exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		Object.defineProperty(exports, name, {
/******/ 			configurable: false,
/******/ 			enumerable: true,
/******/ 			get: getter
/******/ 		});
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("Vue.mixin({\r\n  data: function data() {\r\n    return {\r\n      user: null,\r\n      email: '',\r\n      password: '',\r\n      errors: {\r\n        email: {\r\n          dirty: false,\r\n          status: false,\r\n          text: ''\r\n        },\r\n        password: {\r\n          dirty: false,\r\n          status: false,\r\n          text: ''\r\n        }\r\n      }\r\n    }\r\n  },\r\n  watch: {\r\n    email: function email() {\r\n      this.errors.email.dirty = true\r\n\r\n      var e = this.email\r\n      var at = e.indexOf('@')\r\n      var dot = e.lastIndexOf('.')\r\n\r\n      if (e == '') {\r\n        this.errors.email.status = false\r\n        this.errors.email.text = 'E-mail address cannot be empty.'\r\n      }\r\n      else if (at < 1 || dot < at + 2 || dot + 2 >= e.length) {\r\n        this.errors.email.status = false\r\n        this.errors.email.text = 'Not a valid e-mail address.'\r\n      }\r\n      else {\r\n        this.errors.email.status = true\r\n        this.errors.email.text = ''\r\n      }\r\n    },\r\n    password: function password() {\r\n      this.errors.password.dirty = true\r\n\r\n      if (this.password == '') {\r\n        this.errors.password.status = false\r\n        this.errors.password.text = 'Password cannot be empty.'\r\n      }\r\n      else {\r\n        this.errors.password.status = true\r\n        this.errors.password.text = ''\r\n      }\r\n    }\r\n  },\r\n  computed: {\r\n    btnDisabled: function btnDisabled() {\r\n      return (\r\n        this.errors.email.status &&\r\n        this.errors.password.status\r\n      ) ? false : true\r\n    }\r\n  },\r\n  methods: {\r\n    touch: function touch() {\r\n      if (document.getElementById('errEmail').value != '') {\r\n        this.errors.email.dirty = true\r\n        this.errors.email.status = true\r\n        this.email = document.getElementById('errEmail').value\r\n      }\r\n    },\r\n    focusPassword: function focusPassword() {\r\n      document.getElementById('password').focus()\r\n    }\r\n  },\r\n  mounted: function mounted() {\r\n    this.touch()\r\n  }\r\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2xvZ2luLmpzPzU0OTgiXSwic291cmNlc0NvbnRlbnQiOlsiVnVlLm1peGluKHtcclxuICBkYXRhKCkge1xyXG4gICAgcmV0dXJuIHtcclxuICAgICAgdXNlcjogbnVsbCxcclxuICAgICAgZW1haWw6ICcnLFxyXG4gICAgICBwYXNzd29yZDogJycsXHJcbiAgICAgIGVycm9yczoge1xyXG4gICAgICAgIGVtYWlsOiB7XHJcbiAgICAgICAgICBkaXJ0eTogZmFsc2UsXHJcbiAgICAgICAgICBzdGF0dXM6IGZhbHNlLFxyXG4gICAgICAgICAgdGV4dDogJydcclxuICAgICAgICB9LFxyXG4gICAgICAgIHBhc3N3b3JkOiB7XHJcbiAgICAgICAgICBkaXJ0eTogZmFsc2UsXHJcbiAgICAgICAgICBzdGF0dXM6IGZhbHNlLFxyXG4gICAgICAgICAgdGV4dDogJydcclxuICAgICAgICB9XHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9LFxyXG4gIHdhdGNoOiB7XHJcbiAgICBlbWFpbCgpIHtcclxuICAgICAgdGhpcy5lcnJvcnMuZW1haWwuZGlydHkgPSB0cnVlXHJcblxyXG4gICAgICB2YXIgZSA9IHRoaXMuZW1haWxcclxuICAgICAgdmFyIGF0ID0gZS5pbmRleE9mKCdAJylcclxuICAgICAgdmFyIGRvdCA9IGUubGFzdEluZGV4T2YoJy4nKVxyXG5cclxuICAgICAgaWYgKGUgPT0gJycpIHtcclxuICAgICAgICB0aGlzLmVycm9ycy5lbWFpbC5zdGF0dXMgPSBmYWxzZVxyXG4gICAgICAgIHRoaXMuZXJyb3JzLmVtYWlsLnRleHQgPSAnRS1tYWlsIGFkZHJlc3MgY2Fubm90IGJlIGVtcHR5LidcclxuICAgICAgfVxyXG4gICAgICBlbHNlIGlmIChhdCA8IDEgfHwgZG90IDwgYXQgKyAyIHx8IGRvdCArIDIgPj0gZS5sZW5ndGgpIHtcclxuICAgICAgICB0aGlzLmVycm9ycy5lbWFpbC5zdGF0dXMgPSBmYWxzZVxyXG4gICAgICAgIHRoaXMuZXJyb3JzLmVtYWlsLnRleHQgPSAnTm90IGEgdmFsaWQgZS1tYWlsIGFkZHJlc3MuJ1xyXG4gICAgICB9XHJcbiAgICAgIGVsc2Uge1xyXG4gICAgICAgIHRoaXMuZXJyb3JzLmVtYWlsLnN0YXR1cyA9IHRydWVcclxuICAgICAgICB0aGlzLmVycm9ycy5lbWFpbC50ZXh0ID0gJydcclxuICAgICAgfVxyXG4gICAgfSxcclxuICAgIHBhc3N3b3JkKCkge1xyXG4gICAgICB0aGlzLmVycm9ycy5wYXNzd29yZC5kaXJ0eSA9IHRydWVcclxuXHJcbiAgICAgIGlmICh0aGlzLnBhc3N3b3JkID09ICcnKSB7XHJcbiAgICAgICAgdGhpcy5lcnJvcnMucGFzc3dvcmQuc3RhdHVzID0gZmFsc2VcclxuICAgICAgICB0aGlzLmVycm9ycy5wYXNzd29yZC50ZXh0ID0gJ1Bhc3N3b3JkIGNhbm5vdCBiZSBlbXB0eS4nXHJcbiAgICAgIH1cclxuICAgICAgZWxzZSB7XHJcbiAgICAgICAgdGhpcy5lcnJvcnMucGFzc3dvcmQuc3RhdHVzID0gdHJ1ZVxyXG4gICAgICAgIHRoaXMuZXJyb3JzLnBhc3N3b3JkLnRleHQgPSAnJ1xyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfSxcclxuICBjb21wdXRlZDoge1xyXG4gICAgYnRuRGlzYWJsZWQoKSB7XHJcbiAgICAgIHJldHVybiAoXHJcbiAgICAgICAgdGhpcy5lcnJvcnMuZW1haWwuc3RhdHVzICYmXHJcbiAgICAgICAgdGhpcy5lcnJvcnMucGFzc3dvcmQuc3RhdHVzXHJcbiAgICAgICkgPyBmYWxzZSA6IHRydWVcclxuICAgIH1cclxuICB9LFxyXG4gIG1ldGhvZHM6IHtcclxuICAgIHRvdWNoKCkge1xyXG4gICAgICBpZiAoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2VyckVtYWlsJykudmFsdWUgIT0gJycpIHtcclxuICAgICAgICB0aGlzLmVycm9ycy5lbWFpbC5kaXJ0eSA9IHRydWVcclxuICAgICAgICB0aGlzLmVycm9ycy5lbWFpbC5zdGF0dXMgPSB0cnVlXHJcbiAgICAgICAgdGhpcy5lbWFpbCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdlcnJFbWFpbCcpLnZhbHVlXHJcbiAgICAgIH1cclxuICAgIH0sXHJcbiAgICBmb2N1c1Bhc3N3b3JkKCkge1xyXG4gICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncGFzc3dvcmQnKS5mb2N1cygpXHJcbiAgICB9XHJcbiAgfSxcclxuICBtb3VudGVkKCkge1xyXG4gICAgdGhpcy50b3VjaCgpXHJcbiAgfVxyXG59KTtcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9sb2dpbi5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);