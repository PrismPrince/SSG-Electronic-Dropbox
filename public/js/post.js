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

eval("Vue.mixin({\r\n  data: function data() {\r\n    return {\r\n      post: {\r\n        id: null,\r\n        title: '',\r\n        description: '',\r\n        action: '',\r\n        disabled: true\r\n        // error: {}\r\n      },\r\n      posts: {\r\n        skip: 0,\r\n        take: 5,\r\n        full: false,\r\n        data: []\r\n      }\r\n    }\r\n  },\r\n  methods: {\r\n    focusDesc: function focusDesc() {\r\n      document.getElementById('post-desc').focus()\r\n    },\r\n    showPostModal: function showPostModal(selector, action, id, title, desc) {\n      if ( action === void 0 ) action = '';\n      if ( id === void 0 ) id = null;\n      if ( title === void 0 ) title = '';\n      if ( desc === void 0 ) desc = '';\n\r\n      this.post.action = action\r\n      this.post.id = id\r\n      this.post.title = title\r\n      this.post.description = desc\r\n\r\n      this.enablePostInput()\r\n\r\n      $(selector).modal('show')\r\n    },\r\n    hidePostModal: function hidePostModal(selector, action, id, title, desc) {\n      if ( action === void 0 ) action = '';\n      if ( id === void 0 ) id = null;\n      if ( title === void 0 ) title = '';\n      if ( desc === void 0 ) desc = '';\n\r\n      var vm = this\r\n\r\n      $(selector).modal('hide')\r\n\r\n      $(selector).on('hidden.bs.modal', function () {\r\n        vm.post.action = action\r\n        vm.post.id = id\r\n        vm.post.title = title\r\n        vm.post.description = desc\r\n      })\r\n    },\r\n    disablePostInput: function disablePostInput() {\r\n      this.post.disabled = true\r\n    },\r\n    enablePostInput: function enablePostInput() {\r\n      this.post.disabled = false\r\n    },\r\n    submitPost: function submitPost() {\r\n      var vm = this\r\n\r\n      if (vm.post.action != 'Update') {\r\n        // disable input fields and button\r\n        vm.disablePostInput()\r\n\r\n        // post request with the input data\r\n        vm.$http.post(document.getElementById('get-posts').value,\r\n        {\r\n          id: vm.user.id,\r\n          title: vm.post.title,\r\n          desc: vm.post.description,\r\n        }).then(function (response) {\r\n\r\n          vm.posts.skip++\r\n\r\n          vm.hidePostModal('#post-modal')\r\n\r\n          vm.enablePostInput()\r\n\r\n          vm.posts.data.splice(0, 0, response.data)\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n      } else {\r\n        // disable input fields and button\r\n        vm.disablePostInput()\r\n\r\n        // put request with the updated data\r\n        vm.$http.put(document.getElementById('get-posts').value + '/' + vm.post.id, {\r\n          title: vm.post.title,\r\n          desc: vm.post.description\r\n        }).then(function (response) {\r\n\r\n          vm.hidePostModal('#post-modal')\r\n          vm.enablePostInput()\r\n\r\n          var i = _.indexOf(vm.posts.data, _.find(vm.posts.data, {id: response.data.id}))\r\n          vm.posts.data.splice(i, 1, response.data)\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n      }\r\n    },\r\n    getPosts: function getPosts() {\n      var this$1 = this;\n\r\n      this.$http.get(document.getElementById('get-posts').value + '?skip=' + this.posts.skip + '&take=' + this.posts.take)\r\n        .then(function (response) {\r\n          if (response.data.length == 0 || response.data.length < 5) {\r\n            this$1.posts.full = true\r\n          }\r\n          this$1.posts.skip += 5\r\n          for (var i = 0; i <= response.data.length - 1; i++) {\r\n            this$1.posts.data.push(response.data[i])\r\n          }\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    },\r\n    editPost: function editPost(id) {\n      var this$1 = this;\n\r\n      this.$http.get(document.getElementById('get-posts').value + '/' + id + '/edit')\r\n        .then(function (response) {\r\n          this$1.showPostModal('#post-modal', 'Update', response.data.id, response.data.title, response.data.desc)\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    },\r\n    confirmDeletePost: function confirmDeletePost(id) {\r\n      this.showPostModal('#confirm-post-modal', 'Delete', id)\r\n    },\r\n    deletePost: function deletePost() {\n      var this$1 = this;\n\r\n      this.$http.delete(document.getElementById('get-posts').value + '/' + this.post.id)\r\n        .then(function (response) {\r\n          this$1.posts.skip--\r\n\r\n          var i = _.indexOf(this$1.posts.data, _.find(this$1.posts.data, {id: response.data.id}))\r\n          this$1.posts.data.splice(i, 1)\r\n\r\n          this$1.hidePostModal('#confirm-post-modal')\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    }\r\n  }\r\n})//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3Bvc3QuanM/YjZiOCJdLCJzb3VyY2VzQ29udGVudCI6WyJWdWUubWl4aW4oe1xyXG4gIGRhdGEoKSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICBwb3N0OiB7XHJcbiAgICAgICAgaWQ6IG51bGwsXHJcbiAgICAgICAgdGl0bGU6ICcnLFxyXG4gICAgICAgIGRlc2NyaXB0aW9uOiAnJyxcclxuICAgICAgICBhY3Rpb246ICcnLFxyXG4gICAgICAgIGRpc2FibGVkOiB0cnVlXHJcbiAgICAgICAgLy8gZXJyb3I6IHt9XHJcbiAgICAgIH0sXHJcbiAgICAgIHBvc3RzOiB7XHJcbiAgICAgICAgc2tpcDogMCxcclxuICAgICAgICB0YWtlOiA1LFxyXG4gICAgICAgIGZ1bGw6IGZhbHNlLFxyXG4gICAgICAgIGRhdGE6IFtdXHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9LFxyXG4gIG1ldGhvZHM6IHtcclxuICAgIGZvY3VzRGVzYygpIHtcclxuICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Bvc3QtZGVzYycpLmZvY3VzKClcclxuICAgIH0sXHJcbiAgICBzaG93UG9zdE1vZGFsKHNlbGVjdG9yLCBhY3Rpb24gPSAnJywgaWQgPSBudWxsLCB0aXRsZSA9ICcnLCBkZXNjID0gJycpIHtcclxuICAgICAgdGhpcy5wb3N0LmFjdGlvbiA9IGFjdGlvblxyXG4gICAgICB0aGlzLnBvc3QuaWQgPSBpZFxyXG4gICAgICB0aGlzLnBvc3QudGl0bGUgPSB0aXRsZVxyXG4gICAgICB0aGlzLnBvc3QuZGVzY3JpcHRpb24gPSBkZXNjXHJcblxyXG4gICAgICB0aGlzLmVuYWJsZVBvc3RJbnB1dCgpXHJcblxyXG4gICAgICAkKHNlbGVjdG9yKS5tb2RhbCgnc2hvdycpXHJcbiAgICB9LFxyXG4gICAgaGlkZVBvc3RNb2RhbChzZWxlY3RvciwgYWN0aW9uID0gJycsIGlkID0gbnVsbCwgdGl0bGUgPSAnJywgZGVzYyA9ICcnKSB7XHJcbiAgICAgIHZhciB2bSA9IHRoaXNcclxuXHJcbiAgICAgICQoc2VsZWN0b3IpLm1vZGFsKCdoaWRlJylcclxuXHJcbiAgICAgICQoc2VsZWN0b3IpLm9uKCdoaWRkZW4uYnMubW9kYWwnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgdm0ucG9zdC5hY3Rpb24gPSBhY3Rpb25cclxuICAgICAgICB2bS5wb3N0LmlkID0gaWRcclxuICAgICAgICB2bS5wb3N0LnRpdGxlID0gdGl0bGVcclxuICAgICAgICB2bS5wb3N0LmRlc2NyaXB0aW9uID0gZGVzY1xyXG4gICAgICB9KVxyXG4gICAgfSxcclxuICAgIGRpc2FibGVQb3N0SW5wdXQoKSB7XHJcbiAgICAgIHRoaXMucG9zdC5kaXNhYmxlZCA9IHRydWVcclxuICAgIH0sXHJcbiAgICBlbmFibGVQb3N0SW5wdXQoKSB7XHJcbiAgICAgIHRoaXMucG9zdC5kaXNhYmxlZCA9IGZhbHNlXHJcbiAgICB9LFxyXG4gICAgc3VibWl0UG9zdCgpIHtcclxuICAgICAgdmFyIHZtID0gdGhpc1xyXG5cclxuICAgICAgaWYgKHZtLnBvc3QuYWN0aW9uICE9ICdVcGRhdGUnKSB7XHJcbiAgICAgICAgLy8gZGlzYWJsZSBpbnB1dCBmaWVsZHMgYW5kIGJ1dHRvblxyXG4gICAgICAgIHZtLmRpc2FibGVQb3N0SW5wdXQoKVxyXG5cclxuICAgICAgICAvLyBwb3N0IHJlcXVlc3Qgd2l0aCB0aGUgaW5wdXQgZGF0YVxyXG4gICAgICAgIHZtLiRodHRwLnBvc3QoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2dldC1wb3N0cycpLnZhbHVlLFxyXG4gICAgICAgIHtcclxuICAgICAgICAgIGlkOiB2bS51c2VyLmlkLFxyXG4gICAgICAgICAgdGl0bGU6IHZtLnBvc3QudGl0bGUsXHJcbiAgICAgICAgICBkZXNjOiB2bS5wb3N0LmRlc2NyaXB0aW9uLFxyXG4gICAgICAgIH0pLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcblxyXG4gICAgICAgICAgdm0ucG9zdHMuc2tpcCsrXHJcblxyXG4gICAgICAgICAgdm0uaGlkZVBvc3RNb2RhbCgnI3Bvc3QtbW9kYWwnKVxyXG5cclxuICAgICAgICAgIHZtLmVuYWJsZVBvc3RJbnB1dCgpXHJcblxyXG4gICAgICAgICAgdm0ucG9zdHMuZGF0YS5zcGxpY2UoMCwgMCwgcmVzcG9uc2UuZGF0YSlcclxuXHJcbiAgICAgICAgfSkuY2F0Y2goKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICBjb25zb2xlLmVycm9yKHJlc3BvbnNlLmVycm9yKVxyXG4gICAgICAgIH0pXHJcbiAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgLy8gZGlzYWJsZSBpbnB1dCBmaWVsZHMgYW5kIGJ1dHRvblxyXG4gICAgICAgIHZtLmRpc2FibGVQb3N0SW5wdXQoKVxyXG5cclxuICAgICAgICAvLyBwdXQgcmVxdWVzdCB3aXRoIHRoZSB1cGRhdGVkIGRhdGFcclxuICAgICAgICB2bS4kaHR0cC5wdXQoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2dldC1wb3N0cycpLnZhbHVlICsgJy8nICsgdm0ucG9zdC5pZCwge1xyXG4gICAgICAgICAgdGl0bGU6IHZtLnBvc3QudGl0bGUsXHJcbiAgICAgICAgICBkZXNjOiB2bS5wb3N0LmRlc2NyaXB0aW9uXHJcbiAgICAgICAgfSkudGhlbigocmVzcG9uc2UpID0+IHtcclxuXHJcbiAgICAgICAgICB2bS5oaWRlUG9zdE1vZGFsKCcjcG9zdC1tb2RhbCcpXHJcbiAgICAgICAgICB2bS5lbmFibGVQb3N0SW5wdXQoKVxyXG5cclxuICAgICAgICAgIHZhciBpID0gXy5pbmRleE9mKHZtLnBvc3RzLmRhdGEsIF8uZmluZCh2bS5wb3N0cy5kYXRhLCB7aWQ6IHJlc3BvbnNlLmRhdGEuaWR9KSlcclxuICAgICAgICAgIHZtLnBvc3RzLmRhdGEuc3BsaWNlKGksIDEsIHJlc3BvbnNlLmRhdGEpXHJcblxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgICB9XHJcbiAgICB9LFxyXG4gICAgZ2V0UG9zdHMoKSB7XHJcbiAgICAgIHRoaXMuJGh0dHAuZ2V0KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXQtcG9zdHMnKS52YWx1ZSArICc/c2tpcD0nICsgdGhpcy5wb3N0cy5za2lwICsgJyZ0YWtlPScgKyB0aGlzLnBvc3RzLnRha2UpXHJcbiAgICAgICAgLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICBpZiAocmVzcG9uc2UuZGF0YS5sZW5ndGggPT0gMCB8fCByZXNwb25zZS5kYXRhLmxlbmd0aCA8IDUpIHtcclxuICAgICAgICAgICAgdGhpcy5wb3N0cy5mdWxsID0gdHJ1ZVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgICAgdGhpcy5wb3N0cy5za2lwICs9IDVcclxuICAgICAgICAgIGZvciAodmFyIGkgPSAwOyBpIDw9IHJlc3BvbnNlLmRhdGEubGVuZ3RoIC0gMTsgaSsrKSB7XHJcbiAgICAgICAgICAgIHRoaXMucG9zdHMuZGF0YS5wdXNoKHJlc3BvbnNlLmRhdGFbaV0pXHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfSkuY2F0Y2goKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICBjb25zb2xlLmVycm9yKHJlc3BvbnNlLmVycm9yKVxyXG4gICAgICAgIH0pXHJcbiAgICB9LFxyXG4gICAgZWRpdFBvc3QoaWQpIHtcclxuICAgICAgdGhpcy4kaHR0cC5nZXQoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2dldC1wb3N0cycpLnZhbHVlICsgJy8nICsgaWQgKyAnL2VkaXQnKVxyXG4gICAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgdGhpcy5zaG93UG9zdE1vZGFsKCcjcG9zdC1tb2RhbCcsICdVcGRhdGUnLCByZXNwb25zZS5kYXRhLmlkLCByZXNwb25zZS5kYXRhLnRpdGxlLCByZXNwb25zZS5kYXRhLmRlc2MpXHJcbiAgICAgICAgfSkuY2F0Y2goKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICBjb25zb2xlLmVycm9yKHJlc3BvbnNlLmVycm9yKVxyXG4gICAgICAgIH0pXHJcbiAgICB9LFxyXG4gICAgY29uZmlybURlbGV0ZVBvc3QoaWQpIHtcclxuICAgICAgdGhpcy5zaG93UG9zdE1vZGFsKCcjY29uZmlybS1wb3N0LW1vZGFsJywgJ0RlbGV0ZScsIGlkKVxyXG4gICAgfSxcclxuICAgIGRlbGV0ZVBvc3QoKSB7XHJcbiAgICAgIHRoaXMuJGh0dHAuZGVsZXRlKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXQtcG9zdHMnKS52YWx1ZSArICcvJyArIHRoaXMucG9zdC5pZClcclxuICAgICAgICAudGhlbigocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIHRoaXMucG9zdHMuc2tpcC0tXHJcblxyXG4gICAgICAgICAgdmFyIGkgPSBfLmluZGV4T2YodGhpcy5wb3N0cy5kYXRhLCBfLmZpbmQodGhpcy5wb3N0cy5kYXRhLCB7aWQ6IHJlc3BvbnNlLmRhdGEuaWR9KSlcclxuICAgICAgICAgIHRoaXMucG9zdHMuZGF0YS5zcGxpY2UoaSwgMSlcclxuXHJcbiAgICAgICAgICB0aGlzLmhpZGVQb3N0TW9kYWwoJyNjb25maXJtLXBvc3QtbW9kYWwnKVxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgfVxyXG4gIH1cclxufSlcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9wb3N0LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOyIsInNvdXJjZVJvb3QiOiIifQ==");

/***/ }
/******/ ]);