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

eval("Vue.mixin({\r\n  data: function data() {\r\n    return {\r\n      user: null,\r\n      post: {\r\n        title: '',\r\n        description: ''\r\n      },\r\n      poll: {\r\n        //\r\n      },\r\n      suggestion: {\r\n        //\r\n      },\r\n      posts: [],\r\n      polls: [],\r\n      suggestions: []\r\n    }\r\n  },\r\n  methods: {\r\n    focusDesc: function focusDesc() {\r\n      document.getElementById('desc').focus()\r\n    },\r\n    submitPost: function submitPost(url) {\r\n      document.getElementById('desc').focus()\r\n      this.$http.post(url,\r\n      {\r\n        id: this.user,\r\n        title: this.post.title,\r\n        desc: this.post.description,\r\n      }).then(function (response) {\r\n        console.log(response.data)\r\n      }).catch(function (response) {\r\n        console.error(response.error)\r\n      })\r\n    }\r\n  },\r\n  mounted: function mounted() {\r\n    this.user = document.getElementById('code').value\r\n  }\r\n});\r\n\r\n__webpack_require__(0)//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMS5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9yZXNvdXJjZXMvYXNzZXRzL2pzL2hvbWUuanM/NTcyNiJdLCJzb3VyY2VzQ29udGVudCI6WyJWdWUubWl4aW4oe1xyXG4gIGRhdGEoKSB7XHJcbiAgICByZXR1cm4ge1xyXG4gICAgICB1c2VyOiBudWxsLFxyXG4gICAgICBwb3N0OiB7XHJcbiAgICAgICAgdGl0bGU6ICcnLFxyXG4gICAgICAgIGRlc2NyaXB0aW9uOiAnJ1xyXG4gICAgICB9LFxyXG4gICAgICBwb2xsOiB7XHJcbiAgICAgICAgLy9cclxuICAgICAgfSxcclxuICAgICAgc3VnZ2VzdGlvbjoge1xyXG4gICAgICAgIC8vXHJcbiAgICAgIH0sXHJcbiAgICAgIHBvc3RzOiBbXSxcclxuICAgICAgcG9sbHM6IFtdLFxyXG4gICAgICBzdWdnZXN0aW9uczogW11cclxuICAgIH1cclxuICB9LFxyXG4gIG1ldGhvZHM6IHtcclxuICAgIGZvY3VzRGVzYygpIHtcclxuICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rlc2MnKS5mb2N1cygpXHJcbiAgICB9LFxyXG4gICAgc3VibWl0UG9zdCh1cmwpIHtcclxuICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2Rlc2MnKS5mb2N1cygpXHJcbiAgICAgIHRoaXMuJGh0dHAucG9zdCh1cmwsXHJcbiAgICAgIHtcclxuICAgICAgICBpZDogdGhpcy51c2VyLFxyXG4gICAgICAgIHRpdGxlOiB0aGlzLnBvc3QudGl0bGUsXHJcbiAgICAgICAgZGVzYzogdGhpcy5wb3N0LmRlc2NyaXB0aW9uLFxyXG4gICAgICB9KS50aGVuKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgIGNvbnNvbGUubG9nKHJlc3BvbnNlLmRhdGEpXHJcbiAgICAgIH0pLmNhdGNoKChyZXNwb25zZSkgPT4ge1xyXG4gICAgICAgIGNvbnNvbGUuZXJyb3IocmVzcG9uc2UuZXJyb3IpXHJcbiAgICAgIH0pXHJcbiAgICB9XHJcbiAgfSxcclxuICBtb3VudGVkKCkge1xyXG4gICAgdGhpcy51c2VyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvZGUnKS52YWx1ZVxyXG4gIH1cclxufSk7XHJcblxyXG5yZXF1aXJlKCcuL2xvZ291dCcpXG5cblxuLy8gV0VCUEFDSyBGT09URVIgLy9cbi8vIHJlc291cmNlcy9hc3NldHMvanMvaG9tZS5qcyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTsiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);