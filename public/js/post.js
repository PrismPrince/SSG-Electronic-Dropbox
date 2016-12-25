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

eval("Vue.mixin({\r\n  data: function data() {\r\n    return {\r\n      post: {\r\n        id: null,\r\n        title: '',\r\n        description: '',\r\n        disabled: true\r\n        // error: {}\r\n      },\r\n      posts: {\r\n        skip: 0,\r\n        take: 5,\r\n        full: false,\r\n        data: []\r\n      }\r\n    }\r\n  },\r\n  methods: {\r\n    focusDesc: function focusDesc() {\r\n      document.getElementById('post-desc').focus()\r\n    },\r\n    showPostModal: function showPostModal(selector, action, id, title, desc) {\n      if ( action === void 0 ) action = '';\n      if ( id === void 0 ) id = null;\n      if ( title === void 0 ) title = '';\n      if ( desc === void 0 ) desc = '';\n\r\n      this.action = action\r\n      this.post.id = id\r\n      this.post.title = title\r\n      this.post.description = desc\r\n\r\n      this.enablePostInput()\r\n\r\n      $(selector).modal('show')\r\n    },\r\n    hidePostModal: function hidePostModal(selector, action, id, title, desc) {\n      if ( action === void 0 ) action = '';\n      if ( id === void 0 ) id = null;\n      if ( title === void 0 ) title = '';\n      if ( desc === void 0 ) desc = '';\n\r\n      var vm = this\r\n\r\n      $(selector).modal('hide')\r\n\r\n      $(selector).on('hidden.bs.modal', function () {\r\n        vm.action = action\r\n        vm.post.id = id\r\n        vm.post.title = title\r\n        vm.post.description = desc\r\n      })\r\n    },\r\n    disablePostInput: function disablePostInput() {\r\n      this.post.disabled = true\r\n    },\r\n    enablePostInput: function enablePostInput() {\r\n      this.post.disabled = false\r\n    },\r\n    submitPost: function submitPost() {\r\n      var vm = this\r\n\r\n      if (vm.action != 'Update') {\r\n        // disable input fields and button\r\n        vm.disablePostInput()\r\n\r\n        // post request with the input data\r\n        vm.$http.post(document.getElementById('get-posts').value,\r\n        {\r\n          id: vm.user.id,\r\n          title: vm.post.title,\r\n          desc: vm.post.description,\r\n        }).then(function (response) {\r\n\r\n          vm.posts.skip++\r\n\r\n          vm.hidePostModal('#post-modal')\r\n\r\n          vm.enablePostInput()\r\n\r\n          vm.posts.data.splice(0, 0, response.data)\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n      } else {\r\n        // disable input fields and button\r\n        vm.disablePostInput()\r\n\r\n        // put request with the updated data\r\n        vm.$http.put(document.getElementById('get-posts').value + '/' + vm.post.id, {\r\n          title: vm.post.title,\r\n          desc: vm.post.description\r\n        }).then(function (response) {\r\n\r\n          vm.hidePostModal('#post-modal')\r\n          vm.enablePostInput()\r\n\r\n          var i = _.indexOf(vm.posts.data, _.find(vm.posts.data, {id: response.data.id}))\r\n          vm.posts.data.splice(i, 1, response.data)\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n      }\r\n    },\r\n    getPosts: function getPosts() {\n      var this$1 = this;\n\r\n      this.$http.get(document.getElementById('get-posts').value + '?skip=' + this.posts.skip + '&take=' + this.posts.take)\r\n        .then(function (response) {\r\n          if (response.data.length == 0 || response.data.length < 5) {\r\n            this$1.posts.full = true\r\n          }\r\n          this$1.posts.skip += 5\r\n          for (var i = 0; i <= response.data.length - 1; i++) {\r\n            this$1.posts.data.push(response.data[i])\r\n          }\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    },\r\n    editPost: function editPost(id) {\n      var this$1 = this;\n\r\n      this.$http.get(document.getElementById('get-posts').value + '/' + id + '/edit')\r\n        .then(function (response) {\r\n          this$1.showPostModal('#post-modal', 'Update', response.data.id, response.data.title, response.data.desc)\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    },\r\n    confirmDeletePost: function confirmDeletePost(id) {\r\n      this.showPostModal('#confirm-post-modal', 'Delete', id)\r\n    },\r\n    deletePost: function deletePost() {\n      var this$1 = this;\n\r\n      this.$http.delete(document.getElementById('get-posts').value + '/' + this.post.id)\r\n        .then(function (response) {\r\n\r\n          this$1.posts.skip--\r\n\r\n          var i = _.indexOf(this$1.posts.data, _.find(this$1.posts.data, {id: response.data.id}))\r\n          this$1.posts.data.splice(i, 1)\r\n\r\n          this$1.hidePostModal('#confirm-post-modal')\r\n\r\n        }).catch(function (response) {\r\n          console.error(response.error)\r\n        })\r\n    }\r\n  }\r\n})//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL3Bvc3QuanM/YjZiOCJdLCJzb3VyY2VzQ29udGVudCI6WyJWdWUubWl4aW4oe1xyXG4gIGRhdGEoKSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICBwb3N0OiB7XHJcbiAgICAgICAgaWQ6IG51bGwsXHJcbiAgICAgICAgdGl0bGU6ICcnLFxyXG4gICAgICAgIGRlc2NyaXB0aW9uOiAnJyxcclxuICAgICAgICBkaXNhYmxlZDogdHJ1ZVxyXG4gICAgICAgIC8vIGVycm9yOiB7fVxyXG4gICAgICB9LFxyXG4gICAgICBwb3N0czoge1xyXG4gICAgICAgIHNraXA6IDAsXHJcbiAgICAgICAgdGFrZTogNSxcclxuICAgICAgICBmdWxsOiBmYWxzZSxcclxuICAgICAgICBkYXRhOiBbXVxyXG4gICAgICB9XHJcbiAgICB9XHJcbiAgfSxcclxuICBtZXRob2RzOiB7XHJcbiAgICBmb2N1c0Rlc2MoKSB7XHJcbiAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwb3N0LWRlc2MnKS5mb2N1cygpXHJcbiAgICB9LFxyXG4gICAgc2hvd1Bvc3RNb2RhbChzZWxlY3RvciwgYWN0aW9uID0gJycsIGlkID0gbnVsbCwgdGl0bGUgPSAnJywgZGVzYyA9ICcnKSB7XHJcbiAgICAgIHRoaXMuYWN0aW9uID0gYWN0aW9uXHJcbiAgICAgIHRoaXMucG9zdC5pZCA9IGlkXHJcbiAgICAgIHRoaXMucG9zdC50aXRsZSA9IHRpdGxlXHJcbiAgICAgIHRoaXMucG9zdC5kZXNjcmlwdGlvbiA9IGRlc2NcclxuXHJcbiAgICAgIHRoaXMuZW5hYmxlUG9zdElucHV0KClcclxuXHJcbiAgICAgICQoc2VsZWN0b3IpLm1vZGFsKCdzaG93JylcclxuICAgIH0sXHJcbiAgICBoaWRlUG9zdE1vZGFsKHNlbGVjdG9yLCBhY3Rpb24gPSAnJywgaWQgPSBudWxsLCB0aXRsZSA9ICcnLCBkZXNjID0gJycpIHtcclxuICAgICAgdmFyIHZtID0gdGhpc1xyXG5cclxuICAgICAgJChzZWxlY3RvcikubW9kYWwoJ2hpZGUnKVxyXG5cclxuICAgICAgJChzZWxlY3Rvcikub24oJ2hpZGRlbi5icy5tb2RhbCcsIGZ1bmN0aW9uICgpIHtcclxuICAgICAgICB2bS5hY3Rpb24gPSBhY3Rpb25cclxuICAgICAgICB2bS5wb3N0LmlkID0gaWRcclxuICAgICAgICB2bS5wb3N0LnRpdGxlID0gdGl0bGVcclxuICAgICAgICB2bS5wb3N0LmRlc2NyaXB0aW9uID0gZGVzY1xyXG4gICAgICB9KVxyXG4gICAgfSxcclxuICAgIGRpc2FibGVQb3N0SW5wdXQoKSB7XHJcbiAgICAgIHRoaXMucG9zdC5kaXNhYmxlZCA9IHRydWVcclxuICAgIH0sXHJcbiAgICBlbmFibGVQb3N0SW5wdXQoKSB7XHJcbiAgICAgIHRoaXMucG9zdC5kaXNhYmxlZCA9IGZhbHNlXHJcbiAgICB9LFxyXG4gICAgc3VibWl0UG9zdCgpIHtcclxuICAgICAgdmFyIHZtID0gdGhpc1xyXG5cclxuICAgICAgaWYgKHZtLmFjdGlvbiAhPSAnVXBkYXRlJykge1xyXG4gICAgICAgIC8vIGRpc2FibGUgaW5wdXQgZmllbGRzIGFuZCBidXR0b25cclxuICAgICAgICB2bS5kaXNhYmxlUG9zdElucHV0KClcclxuXHJcbiAgICAgICAgLy8gcG9zdCByZXF1ZXN0IHdpdGggdGhlIGlucHV0IGRhdGFcclxuICAgICAgICB2bS4kaHR0cC5wb3N0KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXQtcG9zdHMnKS52YWx1ZSxcclxuICAgICAgICB7XHJcbiAgICAgICAgICBpZDogdm0udXNlci5pZCxcclxuICAgICAgICAgIHRpdGxlOiB2bS5wb3N0LnRpdGxlLFxyXG4gICAgICAgICAgZGVzYzogdm0ucG9zdC5kZXNjcmlwdGlvbixcclxuICAgICAgICB9KS50aGVuKChyZXNwb25zZSkgPT4ge1xyXG5cclxuICAgICAgICAgIHZtLnBvc3RzLnNraXArK1xyXG5cclxuICAgICAgICAgIHZtLmhpZGVQb3N0TW9kYWwoJyNwb3N0LW1vZGFsJylcclxuXHJcbiAgICAgICAgICB2bS5lbmFibGVQb3N0SW5wdXQoKVxyXG5cclxuICAgICAgICAgIHZtLnBvc3RzLmRhdGEuc3BsaWNlKDAsIDAsIHJlc3BvbnNlLmRhdGEpXHJcblxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgICB9IGVsc2Uge1xyXG4gICAgICAgIC8vIGRpc2FibGUgaW5wdXQgZmllbGRzIGFuZCBidXR0b25cclxuICAgICAgICB2bS5kaXNhYmxlUG9zdElucHV0KClcclxuXHJcbiAgICAgICAgLy8gcHV0IHJlcXVlc3Qgd2l0aCB0aGUgdXBkYXRlZCBkYXRhXHJcbiAgICAgICAgdm0uJGh0dHAucHV0KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXQtcG9zdHMnKS52YWx1ZSArICcvJyArIHZtLnBvc3QuaWQsIHtcclxuICAgICAgICAgIHRpdGxlOiB2bS5wb3N0LnRpdGxlLFxyXG4gICAgICAgICAgZGVzYzogdm0ucG9zdC5kZXNjcmlwdGlvblxyXG4gICAgICAgIH0pLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcblxyXG4gICAgICAgICAgdm0uaGlkZVBvc3RNb2RhbCgnI3Bvc3QtbW9kYWwnKVxyXG4gICAgICAgICAgdm0uZW5hYmxlUG9zdElucHV0KClcclxuXHJcbiAgICAgICAgICB2YXIgaSA9IF8uaW5kZXhPZih2bS5wb3N0cy5kYXRhLCBfLmZpbmQodm0ucG9zdHMuZGF0YSwge2lkOiByZXNwb25zZS5kYXRhLmlkfSkpXHJcbiAgICAgICAgICB2bS5wb3N0cy5kYXRhLnNwbGljZShpLCAxLCByZXNwb25zZS5kYXRhKVxyXG5cclxuICAgICAgICB9KS5jYXRjaCgocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIGNvbnNvbGUuZXJyb3IocmVzcG9uc2UuZXJyb3IpXHJcbiAgICAgICAgfSlcclxuICAgICAgfVxyXG4gICAgfSxcclxuICAgIGdldFBvc3RzKCkge1xyXG4gICAgICB0aGlzLiRodHRwLmdldChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZ2V0LXBvc3RzJykudmFsdWUgKyAnP3NraXA9JyArIHRoaXMucG9zdHMuc2tpcCArICcmdGFrZT0nICsgdGhpcy5wb3N0cy50YWtlKVxyXG4gICAgICAgIC50aGVuKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgaWYgKHJlc3BvbnNlLmRhdGEubGVuZ3RoID09IDAgfHwgcmVzcG9uc2UuZGF0YS5sZW5ndGggPCA1KSB7XHJcbiAgICAgICAgICAgIHRoaXMucG9zdHMuZnVsbCA9IHRydWVcclxuICAgICAgICAgIH1cclxuICAgICAgICAgIHRoaXMucG9zdHMuc2tpcCArPSA1XHJcbiAgICAgICAgICBmb3IgKHZhciBpID0gMDsgaSA8PSByZXNwb25zZS5kYXRhLmxlbmd0aCAtIDE7IGkrKykge1xyXG4gICAgICAgICAgICB0aGlzLnBvc3RzLmRhdGEucHVzaChyZXNwb25zZS5kYXRhW2ldKVxyXG4gICAgICAgICAgfVxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgfSxcclxuICAgIGVkaXRQb3N0KGlkKSB7XHJcbiAgICAgIHRoaXMuJGh0dHAuZ2V0KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdnZXQtcG9zdHMnKS52YWx1ZSArICcvJyArIGlkICsgJy9lZGl0JylcclxuICAgICAgICAudGhlbigocmVzcG9uc2UpID0+IHtcclxuICAgICAgICAgIHRoaXMuc2hvd1Bvc3RNb2RhbCgnI3Bvc3QtbW9kYWwnLCAnVXBkYXRlJywgcmVzcG9uc2UuZGF0YS5pZCwgcmVzcG9uc2UuZGF0YS50aXRsZSwgcmVzcG9uc2UuZGF0YS5kZXNjKVxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgfSxcclxuICAgIGNvbmZpcm1EZWxldGVQb3N0KGlkKSB7XHJcbiAgICAgIHRoaXMuc2hvd1Bvc3RNb2RhbCgnI2NvbmZpcm0tcG9zdC1tb2RhbCcsICdEZWxldGUnLCBpZClcclxuICAgIH0sXHJcbiAgICBkZWxldGVQb3N0KCkge1xyXG4gICAgICB0aGlzLiRodHRwLmRlbGV0ZShkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZ2V0LXBvc3RzJykudmFsdWUgKyAnLycgKyB0aGlzLnBvc3QuaWQpXHJcbiAgICAgICAgLnRoZW4oKHJlc3BvbnNlKSA9PiB7XHJcblxyXG4gICAgICAgICAgdGhpcy5wb3N0cy5za2lwLS1cclxuXHJcbiAgICAgICAgICB2YXIgaSA9IF8uaW5kZXhPZih0aGlzLnBvc3RzLmRhdGEsIF8uZmluZCh0aGlzLnBvc3RzLmRhdGEsIHtpZDogcmVzcG9uc2UuZGF0YS5pZH0pKVxyXG4gICAgICAgICAgdGhpcy5wb3N0cy5kYXRhLnNwbGljZShpLCAxKVxyXG5cclxuICAgICAgICAgIHRoaXMuaGlkZVBvc3RNb2RhbCgnI2NvbmZpcm0tcG9zdC1tb2RhbCcpXHJcblxyXG4gICAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgICAgY29uc29sZS5lcnJvcihyZXNwb25zZS5lcnJvcilcclxuICAgICAgICB9KVxyXG4gICAgfVxyXG4gIH1cclxufSlcblxuXG4vLyBXRUJQQUNLIEZPT1RFUiAvL1xuLy8gcmVzb3VyY2VzL2Fzc2V0cy9qcy9wb3N0LmpzIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Iiwic291cmNlUm9vdCI6IiJ9");

/***/ }
/******/ ]);