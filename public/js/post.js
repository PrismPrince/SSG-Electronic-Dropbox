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

eval("Vue.mixin({\r\n  data: function data() {\r\n    return {\r\n      post: {\r\n        id: null,\r\n        title: '',\r\n        description: '',\r\n        action: '',\r\n        disabled: true\r\n        // error: {}\r\n      },\r\n      posts: {\r\n        skip: 0,\r\n        take: 5,\r\n        full: false,\r\n        data: []\r\n      }\r\n    }\r\n  },\r\n  methods: {\r\n    showPostModal: function showPostModal(selector, action, id, title, desc) {\n      if ( action === void 0 ) action = '';\n      if ( id === void 0 ) id = null;\n      if ( title === void 0 ) title = '';\n      if ( desc === void 0 ) desc = '';\n\r\n      this.post.action = action\r\n      this.post.id = id\r\n      this.post.title = title\r\n      this.post.description = desc\r\n\r\n      this.enablePostInput()\r\n\r\n      $(selector).modal('show')\r\n    },\r\n    hidePostModal: function hidePostModal(selector, action, id, title, desc) {\n      if ( action === void 0 ) action = '';\n      if ( id === void 0 ) id = null;\n      if ( title === void 0 ) title = '';\n      if ( desc === void 0 ) desc = '';\n\r\n      var vm = this\r\n\r\n      $(selector).modal('hide')\r\n\r\n      $(selector).on('hidden.bs.modal', function () {\r\n        vm.post.action = action\r\n        vm.post.id = id\r\n        vm.post.title = title\r\n        vm.post.description = desc\r\n      })\r\n    },\r\n    disablePostInput: function disablePostInput() {\r\n      this.post.disabled = true\r\n    },\r\n    enablePostInput: function enablePostInput() {\r\n      this.post.disabled = false\r\n    },\r\n    submitPost: function submitPost() {\r\n      var vm = this\r\n\r\n      if (vm.post.action != 'Update') {\r\n        // disable input fields and button\r\n        vm.disablePostInput()\r\n\r\n        // post request with the input data\r\n        vm.$http.post(window.location.origin + '/api/post', {\r\n          title: vm.post.title,\r\n          desc: vm.post.description,\r\n        }).then(function (response) {\r\n\r\n          vm.posts.skip++\r\n\r\n          vm.hidePostModal('#post-modal')\r\n          vm.enablePostInput()\r\n\r\n          vm.posts.data.splice(0, 0, response.data)\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n      } else {\r\n        // disable input fields and button\r\n        vm.disablePostInput()\r\n\r\n        // put request with the updated data\r\n        vm.$http.put(window.location.origin + '/api/post/' + vm.post.id, {\r\n          title: vm.post.title,\r\n          desc: vm.post.description\r\n        }).then(function (response) {\r\n\r\n          vm.hidePostModal('#post-modal')\r\n          vm.enablePostInput()\r\n\r\n          var i = _.indexOf(vm.posts.data, _.find(vm.posts.data, {id: response.data.id}))\r\n          vm.posts.data.splice(i, 1, response.data)\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n      }\r\n    },\r\n    getPosts: function getPosts() {\n      var this$1 = this;\n\r\n      this.$http.get(window.location.origin + '/api/post?skip=' + this.posts.skip + '&take=' + this.posts.take)\r\n        .then(function (response) {\r\n          if (response.data.length == 0 || response.data.length < 5) {\r\n            this$1.posts.full = true\r\n          }\r\n\r\n          this$1.posts.skip += 5\r\n\r\n          for (var i = 0; i <= response.data.length - 1; i++) {\r\n            this$1.posts.data.push(response.data[i])\r\n          }\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    },\r\n    editPost: function editPost(id) {\n      var this$1 = this;\n\r\n      this.$http.get(window.location.origin + '/api/post/' + id + '/edit')\r\n        .then(function (response) {\r\n          this$1.showPostModal('#post-modal', 'Update', response.data.id, response.data.title, response.data.desc)\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    },\r\n    confirmDeletePost: function confirmDeletePost(id) {\r\n      this.showPostModal('#confirm-post-modal', 'Delete', id)\r\n    },\r\n    deletePost: function deletePost() {\n      var this$1 = this;\n\r\n      this.$http.delete(window.location.origin + '/api/post/' + this.post.id)\r\n        .then(function (response) {\r\n          this$1.posts.skip--\r\n\r\n          var i = _.indexOf(this$1.posts.data, _.find(this$1.posts.data, {id: response.data.id}))\r\n          this$1.posts.data.splice(i, 1)\r\n\r\n          this$1.hidePostModal('#confirm-post-modal')\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    }\r\n  }\r\n})//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3Bvc3QuanM/YjZiOCJdLCJzb3VyY2VzQ29udGVudCI6WyJWdWUubWl4aW4oe1xyXG4gIGRhdGEoKSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICBwb3N0OiB7XHJcbiAgICAgICAgaWQ6IG51bGwsXHJcbiAgICAgICAgdGl0bGU6ICcnLFxyXG4gICAgICAgIGRlc2NyaXB0aW9uOiAnJyxcclxuICAgICAgICBhY3Rpb246ICcnLFxyXG4gICAgICAgIGRpc2FibGVkOiB0cnVlXHJcbiAgICAgICAgLy8gZXJyb3I6IHt9XHJcbiAgICAgIH0sXHJcbiAgICAgIHBvc3RzOiB7XHJcbiAgICAgICAgc2tpcDogMCxcclxuICAgICAgICB0YWtlOiA1LFxyXG4gICAgICAgIGZ1bGw6IGZhbHNlLFxyXG4gICAgICAgIGRhdGE6IFtdXHJcbiAgICAgIH1cclxuICAgIH1cclxuICB9LFxyXG4gIG1ldGhvZHM6IHtcclxuICAgIHNob3dQb3N0TW9kYWwoc2VsZWN0b3IsIGFjdGlvbiA9ICcnLCBpZCA9IG51bGwsIHRpdGxlID0gJycsIGRlc2MgPSAnJykge1xyXG4gICAgICB0aGlzLnBvc3QuYWN0aW9uID0gYWN0aW9uXHJcbiAgICAgIHRoaXMucG9zdC5pZCA9IGlkXHJcbiAgICAgIHRoaXMucG9zdC50aXRsZSA9IHRpdGxlXHJcbiAgICAgIHRoaXMucG9zdC5kZXNjcmlwdGlvbiA9IGRlc2NcclxuXHJcbiAgICAgIHRoaXMuZW5hYmxlUG9zdElucHV0KClcclxuXHJcbiAgICAgICQoc2VsZWN0b3IpLm1vZGFsKCdzaG93JylcclxuICAgIH0sXHJcbiAgICBoaWRlUG9zdE1vZGFsKHNlbGVjdG9yLCBhY3Rpb24gPSAnJywgaWQgPSBudWxsLCB0aXRsZSA9ICcnLCBkZXNjID0gJycpIHtcclxuICAgICAgdmFyIHZtID0gdGhpc1xyXG5cclxuICAgICAgJChzZWxlY3RvcikubW9kYWwoJ2hpZGUnKVxyXG5cclxuICAgICAgJChzZWxlY3Rvcikub24oJ2hpZGRlbi5icy5tb2RhbCcsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2bS5wb3N0LmFjdGlvbiA9IGFjdGlvblxyXG4gICAgICAgIHZtLnBvc3QuaWQgPSBpZFxyXG4gICAgICAgIHZtLnBvc3QudGl0bGUgPSB0aXRsZVxyXG4gICAgICAgIHZtLnBvc3QuZGVzY3JpcHRpb24gPSBkZXNjXHJcbiAgICAgIH0pXHJcbiAgICB9LFxyXG4gICAgZGlzYWJsZVBvc3RJbnB1dCgpIHtcclxuICAgICAgdGhpcy5wb3N0LmRpc2FibGVkID0gdHJ1ZVxyXG4gICAgfSxcclxuICAgIGVuYWJsZVBvc3RJbnB1dCgpIHtcclxuICAgICAgdGhpcy5wb3N0LmRpc2FibGVkID0gZmFsc2VcclxuICAgIH0sXHJcbiAgICBzdWJtaXRQb3N0KCkge1xyXG4gICAgICB2YXIgdm0gPSB0aGlzXHJcblxyXG4gICAgICBpZiAodm0ucG9zdC5hY3Rpb24gIT0gJ1VwZGF0ZScpIHtcclxuICAgICAgICAvLyBkaXNhYmxlIGlucHV0IGZpZWxkcyBhbmQgYnV0dG9uXHJcbiAgICAgICAgdm0uZGlzYWJsZVBvc3RJbnB1dCgpXHJcblxyXG4gICAgICAgIC8vIHBvc3QgcmVxdWVzdCB3aXRoIHRoZSBpbnB1dCBkYXRhXHJcbiAgICAgICAgdm0uJGh0dHAucG9zdCh3aW5kb3cubG9jYXRpb24ub3JpZ2luICsgJy9hcGkvcG9zdCcsIHtcclxuICAgICAgICAgIHRpdGxlOiB2bS5wb3N0LnRpdGxlLFxyXG4gICAgICAgICAgZGVzYzogdm0ucG9zdC5kZXNjcmlwdGlvbixcclxuICAgICAgICB9KS50aGVuKChyZXNwb25zZSkgPT4ge1xyXG5cclxuICAgICAgICAgIHZtLnBvc3RzLnNraXArK1xyXG5cclxuICAgICAgICAgIHZtLmhpZGVQb3N0TW9kYWwoJyNwb3N0LW1vZGFsJylcclxuICAgICAgICAgIHZtLmVuYWJsZVBvc3RJbnB1dCgpXHJcblxyXG4gICAgICAgICAgdm0ucG9zdHMuZGF0YS5zcGxpY2UoMCwgMCwgcmVzcG9uc2UuZGF0YSlcclxuXHJcbiAgICAgICAgfSkuY2F0Y2goKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICBjb25zb2xlLmVycm9yKHJlc3BvbnNlLmVycm9yKVxyXG4gICAgICAgIH0pXHJcbiAgICAgIH0gZWxzZSB7XHJcbiAgICAgICAgLy8gZGlzYWJsZSBpbnB1dCBmaWVsZHMgYW5kIGJ1dHRvblxyXG4gICAgICAgIHZtLmRpc2FibGVQb3N0SW5wdXQoKVxyXG5cclxuICAgICAgICAvLyBwdXQgcmVxdWVzdCB3aXRoIHRoZSB1cGRhdGVkIGRhdGFcclxuICAgICAgICB2bS4kaHR0cC5wdXQod2luZG93LmxvY2F0aW9uLm9yaWdpbiArICcvYXBpL3Bvc3QvJyArIHZtLnBvc3QuaWQsIHtcclxuICAgICAgICAgIHRpdGxlOiB2bS5wb3N0LnRpdGxlLFxyXG4gICAgICAgICAgZGVzYzogdm0ucG9zdC5kZXNjcmlwdGlvblxyXG4gICAgICAgIH0pLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcblxyXG4gICAgICAgICAgdm0uaGlkZVBvc3RNb2RhbCgnI3Bvc3QtbW9kYWwnKVxyXG4gICAgICAgICAgdm0uZW5hYmxlUG9zdElucHV0KClcclxuXHJcbiAgICAgICAgICB2YXIgaSA9IF8uaW5kZXhPZih2bS5wb3N0cy5kYXRhLCBfLmZpbmQodm0ucG9zdHMuZGF0YSwge2lkOiByZXNwb25zZS5kYXRhLmlkfSkpXHJcbiAgICAgICAgICB2bS5wb3N0cy5kYXRhLnNwbGljZShpLCAxLCByZXNwb25zZS5kYXRhKVxyXG5cclxuICAgICAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIGNvbnNvbGUuZXJyb3IocmVzcG9uc2UuZXJyb3IpXHJcbiAgICAgICAgfSlcclxuICAgICAgfVxyXG4gICAgfSxcclxuICAgIGdldFBvc3RzKCkge1xyXG4gICAgICB0aGlzLiRodHRwLmdldCh3aW5kb3cubG9jYXRpb24ub3JpZ2luICsgJy9hcGkvcG9zdD9za2lwPScgKyB0aGlzLnBvc3RzLnNraXAgKyAnJnRha2U9JyArIHRoaXMucG9zdHMudGFrZSlcclxuICAgICAgICAudGhlbigocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIGlmIChyZXNwb25zZS5kYXRhLmxlbmd0aCA9PSAwIHx8IHJlc3BvbnNlLmRhdGEubGVuZ3RoIDwgNSkge1xyXG4gICAgICAgICAgICB0aGlzLnBvc3RzLmZ1bGwgPSB0cnVlXHJcbiAgICAgICAgICB9XHJcblxyXG4gICAgICAgICAgdGhpcy5wb3N0cy5za2lwICs9IDVcclxuXHJcbiAgICAgICAgICBmb3IgKHZhciBpID0gMDsgaSA8PSByZXNwb25zZS5kYXRhLmxlbmd0aCAtIDE7IGkrKykge1xyXG4gICAgICAgICAgICB0aGlzLnBvc3RzLmRhdGEucHVzaChyZXNwb25zZS5kYXRhW2ldKVxyXG4gICAgICAgICAgfVxyXG5cclxuICAgICAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIGNvbnNvbGUuZXJyb3IocmVzcG9uc2UuZXJyb3IpXHJcbiAgICAgICAgfSlcclxuICAgIH0sXHJcbiAgICBlZGl0UG9zdChpZCkge1xyXG4gICAgICB0aGlzLiRodHRwLmdldCh3aW5kb3cubG9jYXRpb24ub3JpZ2luICsgJy9hcGkvcG9zdC8nICsgaWQgKyAnL2VkaXQnKVxyXG4gICAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgdGhpcy5zaG93UG9zdE1vZGFsKCcjcG9zdC1tb2RhbCcsICdVcGRhdGUnLCByZXNwb25zZS5kYXRhLmlkLCByZXNwb25zZS5kYXRhLnRpdGxlLCByZXNwb25zZS5kYXRhLmRlc2MpXHJcbiAgICAgICAgfSkuY2F0Y2goKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICBjb25zb2xlLmVycm9yKHJlc3BvbnNlLmVycm9yKVxyXG4gICAgICAgIH0pXHJcbiAgICB9LFxyXG4gICAgY29uZmlybURlbGV0ZVBvc3QoaWQpIHtcclxuICAgICAgdGhpcy5zaG93UG9zdE1vZGFsKCcjY29uZmlybS1wb3N0LW1vZGFsJywgJ0RlbGV0ZScsIGlkKVxyXG4gICAgfSxcclxuICAgIGRlbGV0ZVBvc3QoKSB7XHJcbiAgICAgIHRoaXMuJGh0dHAuZGVsZXRlKHdpbmRvdy5sb2NhdGlvbi5vcmlnaW4gKyAnL2FwaS9wb3N0LycgKyB0aGlzLnBvc3QuaWQpXHJcbiAgICAgICAgLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcbiAgICAgICAgICB0aGlzLnBvc3RzLnNraXAtLVxyXG5cclxuICAgICAgICAgIHZhciBpID0gXy5pbmRleE9mKHRoaXMucG9zdHMuZGF0YSwgXy5maW5kKHRoaXMucG9zdHMuZGF0YSwge2lkOiByZXNwb25zZS5kYXRhLmlkfSkpXHJcbiAgICAgICAgICB0aGlzLnBvc3RzLmRhdGEuc3BsaWNlKGksIDEpXHJcblxyXG4gICAgICAgICAgdGhpcy5oaWRlUG9zdE1vZGFsKCcjY29uZmlybS1wb3N0LW1vZGFsJylcclxuICAgICAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIGNvbnNvbGUuZXJyb3IocmVzcG9uc2UuZXJyb3IpXHJcbiAgICAgICAgfSlcclxuICAgIH1cclxuICB9XHJcbn0pXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvcG9zdC5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);