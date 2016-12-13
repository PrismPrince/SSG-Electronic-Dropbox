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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

eval("Vue.mixin({\r\n  methods: {\r\n    logout: function logout() {\r\n      document.getElementById('logout-form').submit();\r\n    }\r\n  }\r\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2xvZ291dC5qcz9hOWFmIl0sInNvdXJjZXNDb250ZW50IjpbIlZ1ZS5taXhpbih7XHJcbiAgbWV0aG9kczoge1xyXG4gICAgbG9nb3V0KCkge1xyXG4gICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbG9nb3V0LWZvcm0nKS5zdWJtaXQoKTtcclxuICAgIH1cclxuICB9XHJcbn0pO1xuXG5cbi8vIFdFQlBBQ0sgRk9PVEVSIC8vXG4vLyByZXNvdXJjZXMvYXNzZXRzL2pzL2xvZ291dC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJzb3VyY2VSb290IjoiIn0=");

/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

eval("Vue.mixin({\r\n  data: function data() {\r\n    return {\r\n      user: null,\r\n      post: {\r\n        title: '',\r\n        description: ''\r\n        // error: {}\r\n      },\r\n      poll: {\r\n        //\r\n      },\r\n      suggestion: {\r\n        //\r\n      },\r\n      posts: {\r\n        skip: 0,\r\n        take: 5,\r\n        data: []\r\n      },\r\n      polls: [],\r\n      suggestions: []\r\n    }\r\n  },\r\n  methods: {\r\n    focusDesc: function focusDesc() {\r\n      document.getElementById('post-desc').focus()\r\n    },\r\n    submitPost: function submitPost(url) {\r\n      var vm = this\r\n\r\n      // disable input fields and button\r\n      document.getElementById('post-title').disabled = true;\r\n      document.getElementById('post-desc').disabled = true;\r\n      document.getElementById('post-submit').disabled = true;\r\n\r\n      // post request with the input data\r\n      vm.$http.post(url,\r\n      {\r\n        id: vm.user.id,\r\n        title: vm.post.title,\r\n        desc: vm.post.description,\r\n      }).then(function (response) {\r\n\r\n        $('#create-post').modal('hide')\r\n\r\n        $('#create-post').on('hidden.bs.modal', function () {\r\n          vm.post.title = ''\r\n          vm.post.description = ''\r\n          vm.posts.skip++\r\n\r\n          document.getElementById('post-title').disabled = false;\r\n          document.getElementById('post-desc').disabled = false;\r\n          document.getElementById('post-submit').disabled = false;\r\n        })\r\n\r\n        vm.posts.data.splice(0, 0, response.data)\r\n\r\n      }).catch(function (response) {\r\n\r\n        console.error(response.error)\r\n\r\n        vm.post.title = ''\r\n        vm.post.description = ''\r\n\r\n        document.getElementById('post-title').disabled = false;\r\n        document.getElementById('post-desc').disabled = false;\r\n        document.getElementById('post-submit').disabled = false;\r\n\r\n      })\r\n    },\r\n    getPosts: function getPosts() {\n      var this$1 = this;\n\r\n      this.$http.get(document.getElementById('get-posts').value + '?skip=' + this.posts.skip + '&take=' + this.posts.take)\r\n        .then(function (response) {\r\n          if (response.data.length == 0) {\r\n            // something to stop the button to load more.....\r\n          }\r\n          this$1.posts.skip += 5\r\n          for (var i = 0; i <= response.data.length - 1; i++) {\r\n            this$1.posts.data.push(response.data[i])\r\n          }\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    }\r\n  },\r\n  created: function created() {\n    var this$1 = this;\n\r\n    this.$http.get(document.getElementById('get-user').value + '?id=' + document.getElementById('code').value)\r\n      .then(function (response) {\r\n        this$1.user = response.data\r\n      }).catch(function (response) {\r\n        console.error(response.error)\r\n      })\r\n    this.getPosts()\r\n  }\r\n});\r\n\r\n__webpack_require__(0)//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2hvbWUuanM/NTcyNiJdLCJzb3VyY2VzQ29udGVudCI6WyJWdWUubWl4aW4oe1xyXG4gIGRhdGEoKSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICB1c2VyOiBudWxsLFxyXG4gICAgICBwb3N0OiB7XHJcbiAgICAgICAgdGl0bGU6ICcnLFxyXG4gICAgICAgIGRlc2NyaXB0aW9uOiAnJ1xyXG4gICAgICAgIC8vIGVycm9yOiB7fVxyXG4gICAgICB9LFxyXG4gICAgICBwb2xsOiB7XHJcbiAgICAgICAgLy9cclxuICAgICAgfSxcclxuICAgICAgc3VnZ2VzdGlvbjoge1xyXG4gICAgICAgIC8vXHJcbiAgICAgIH0sXHJcbiAgICAgIHBvc3RzOiB7XHJcbiAgICAgICAgc2tpcDogMCxcclxuICAgICAgICB0YWtlOiA1LFxyXG4gICAgICAgIGRhdGE6IFtdXHJcbiAgICAgIH0sXHJcbiAgICAgIHBvbGxzOiBbXSxcclxuICAgICAgc3VnZ2VzdGlvbnM6IFtdXHJcbiAgICB9XHJcbiAgfSxcclxuICBtZXRob2RzOiB7XHJcbiAgICBmb2N1c0Rlc2MoKSB7XHJcbiAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwb3N0LWRlc2MnKS5mb2N1cygpXHJcbiAgICB9LFxyXG4gICAgc3VibWl0UG9zdCh1cmwpIHtcclxuICAgICAgdmFyIHZtID0gdGhpc1xyXG5cclxuICAgICAgLy8gZGlzYWJsZSBpbnB1dCBmaWVsZHMgYW5kIGJ1dHRvblxyXG4gICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncG9zdC10aXRsZScpLmRpc2FibGVkID0gdHJ1ZTtcclxuICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Bvc3QtZGVzYycpLmRpc2FibGVkID0gdHJ1ZTtcclxuICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Bvc3Qtc3VibWl0JykuZGlzYWJsZWQgPSB0cnVlO1xyXG5cclxuICAgICAgLy8gcG9zdCByZXF1ZXN0IHdpdGggdGhlIGlucHV0IGRhdGFcclxuICAgICAgdm0uJGh0dHAucG9zdCh1cmwsXHJcbiAgICAgIHtcclxuICAgICAgICBpZDogdm0udXNlci5pZCxcclxuICAgICAgICB0aXRsZTogdm0ucG9zdC50aXRsZSxcclxuICAgICAgICBkZXNjOiB2bS5wb3N0LmRlc2NyaXB0aW9uLFxyXG4gICAgICB9KS50aGVuKChyZXNwb25zZSkgPT4ge1xyXG5cclxuICAgICAgICAkKCcjY3JlYXRlLXBvc3QnKS5tb2RhbCgnaGlkZScpXHJcblxyXG4gICAgICAgICQoJyNjcmVhdGUtcG9zdCcpLm9uKCdoaWRkZW4uYnMubW9kYWwnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgICB2bS5wb3N0LnRpdGxlID0gJydcclxuICAgICAgICAgIHZtLnBvc3QuZGVzY3JpcHRpb24gPSAnJ1xyXG4gICAgICAgICAgdm0ucG9zdHMuc2tpcCsrXHJcblxyXG4gICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Bvc3QtdGl0bGUnKS5kaXNhYmxlZCA9IGZhbHNlO1xyXG4gICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Bvc3QtZGVzYycpLmRpc2FibGVkID0gZmFsc2U7XHJcbiAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncG9zdC1zdWJtaXQnKS5kaXNhYmxlZCA9IGZhbHNlO1xyXG4gICAgICAgIH0pXHJcblxyXG4gICAgICAgIHZtLnBvc3RzLmRhdGEuc3BsaWNlKDAsIDAsIHJlc3BvbnNlLmRhdGEpXHJcblxyXG4gICAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcclxuXHJcbiAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuXHJcbiAgICAgICAgdm0ucG9zdC50aXRsZSA9ICcnXHJcbiAgICAgICAgdm0ucG9zdC5kZXNjcmlwdGlvbiA9ICcnXHJcblxyXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwb3N0LXRpdGxlJykuZGlzYWJsZWQgPSBmYWxzZTtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncG9zdC1kZXNjJykuZGlzYWJsZWQgPSBmYWxzZTtcclxuICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgncG9zdC1zdWJtaXQnKS5kaXNhYmxlZCA9IGZhbHNlO1xyXG5cclxuICAgICAgfSlcclxuICAgIH0sXHJcbiAgICBnZXRQb3N0cygpIHtcclxuICAgICAgdGhpcy4kaHR0cC5nZXQoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2dldC1wb3N0cycpLnZhbHVlICsgJz9za2lwPScgKyB0aGlzLnBvc3RzLnNraXAgKyAnJnRha2U9JyArIHRoaXMucG9zdHMudGFrZSlcclxuICAgICAgICAudGhlbigocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIGlmIChyZXNwb25zZS5kYXRhLmxlbmd0aCA9PSAwKSB7XHJcbiAgICAgICAgICAgIC8vIHNvbWV0aGluZyB0byBzdG9wIHRoZSBidXR0b24gdG8gbG9hZCBtb3JlLi4uLi5cclxuICAgICAgICAgIH1cclxuICAgICAgICAgIHRoaXMucG9zdHMuc2tpcCArPSA1XHJcbiAgICAgICAgICBmb3IgKHZhciBpID0gMDsgaSA8PSByZXNwb25zZS5kYXRhLmxlbmd0aCAtIDE7IGkrKykge1xyXG4gICAgICAgICAgICB0aGlzLnBvc3RzLmRhdGEucHVzaChyZXNwb25zZS5kYXRhW2ldKVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgfVxyXG4gIH0sXHJcbiAgY3JlYXRlZCgpIHtcclxuICAgIHRoaXMuJGh0dHAuZ2V0KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXQtdXNlcicpLnZhbHVlICsgJz9pZD0nICsgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvZGUnKS52YWx1ZSlcclxuICAgICAgLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgdGhpcy51c2VyID0gcmVzcG9uc2UuZGF0YVxyXG4gICAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcclxuICAgICAgICBjb25zb2xlLmVycm9yKHJlc3BvbnNlLmVycm9yKVxyXG4gICAgICB9KVxyXG4gICAgdGhpcy5nZXRQb3N0cygpXHJcbiAgfVxyXG59KTtcclxuXHJcbnJlcXVpcmUoJy4vbG9nb3V0JylcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9ob21lLmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUFBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);