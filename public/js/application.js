/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ 2:
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(41);


/***/ }),

/***/ 41:
/***/ (function(module, exports, __webpack_require__) {

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('application-card', __webpack_require__(42));

var app = new Vue({
    el: '#application-list'
});

$(document).ready(function () {
    $(document).scroll(function () {
        $("#list-title-hover").width($('#list-title').width());
        if ($(window).scrollTop() >= $('#list-title').offset().top) {
            $("#list-title-hover").removeClass('hide');
        } else {
            $("#list-title-hover").addClass('hide');
        }
    });
});

/***/ }),

/***/ 42:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(43)
/* template */
var __vue_template__ = __webpack_require__(47)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/ApplicationCard.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2c50d0ce", Component.options)
  } else {
    hotAPI.reload("data-v-2c50d0ce", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 43:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

Vue.component('avatar', __webpack_require__(44));

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        isApproved: Boolean,
        isSignedIn: Boolean,
        isSignedOut: Boolean,
        userLogo: String,
        userName: String,
        activityId: String,
        applicationId: String,
        approveUrl: String,
        signInUrl: String,
        signOutUrl: String
    },
    methods: {
        signedInButtonAction: function signedInButtonAction() {
            var self = this;
            if (this.isSignedIn) {
                axios.get(this.signInUrl).then(function (response) {
                    self.isSignedIn = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        signedOutButtonAction: function signedOutButtonAction() {
            var self = this;
            if (this.isSignedOut) {
                axios.get(this.signOutUrl).then(function (response) {
                    self.isSignedOut = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        approveLinkAction: function approveLinkAction() {
            this.isApproved = !this.isApproved;
            this.updateApplication();
        },
        signedInLinkAction: function signedInLinkAction() {
            this.isSignedIn = !this.isSignedIn;
            this.updateApplication();
        },
        signedOutLinkAction: function signedOutLinkAction() {
            this.isSignedOut = !this.isSignedOut;
            this.updateApplication();
        },
        updateApplication: function updateApplication() {
            var self = this;
            axios.patch(self.approveUrl, {
                'status': self.isApproved,
                'sign_in': self.isSignedIn,
                'sign_out': self.isSignedOut
            }).then(function (respond) {
                self.isApproved = respond.data.status;
                self.isSignedIn = respond.data.sign_in;
                self.isSignedOut = respond.data.sign_out;
            }).catch(function (error) {
                if (error.response && error.response.status == 403) {
                    alert("您无权进行此操作！");
                    window.location.reload();
                }
            });
        }
    }
});

/***/ }),

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(45)
/* template */
var __vue_template__ = __webpack_require__(46)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/Avatar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e1a7fc60", Component.options)
  } else {
    hotAPI.reload("data-v-e1a7fc60", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 45:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'avatar',
  props: {
    username: {
      type: String,
      required: true
    },
    initials: {
      type: String
    },
    backgroundColor: {
      type: String
    },
    color: {
      type: String
    },
    customStyle: {
      type: Object
    },
    size: {
      type: Number,
      default: 50
    },
    src: {
      type: String
    },
    rounded: {
      type: Boolean,
      default: true
    },
    lighten: {
      type: Number,
      default: 80
    }
  },

  data: function data() {
    return {
      backgroundColors: ['#F44336', '#FF4081', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3', '#03A9F4', '#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39', /* '#FFEB3B' , */'#FFC107', '#FF9800', '#FF5722', '#795548', '#9E9E9E', '#607D8B']
    };
  },
  mounted: function mounted() {
    this.$emit('avatar-initials', this.username, this.userInitial);
  },


  computed: {
    background: function background() {
      var seed = 0;
      for (var i = 0; i < this.username.length; i++) {
        var charCode = this.username.charCodeAt(i);
        seed += charCode;
      }
      return this.backgroundColor || this.randomBackgroundColor(seed, this.backgroundColors);
    },
    fontColor: function fontColor() {
      return this.color || this.lightenColor(this.background, this.lighten);
    },
    isImage: function isImage() {
      return Boolean(this.src);
    },
    style: function style() {
      var style = {
        width: this.size + 'px',
        height: this.size + 'px',
        borderRadius: this.rounded ? '50%' : 0,
        textAlign: 'center',
        verticalAlign: 'middle'
      };

      var imgBackgroundAndFontStyle = {
        background: 'transparent url(\'' + this.src + '\') no-repeat scroll 0% 0% / ' + this.size + 'px ' + this.size + 'px content-box border-box'
      };

      var initialBackgroundAndFontStyle = {
        backgroundColor: this.background,
        font: Math.floor(this.size / 2.5) + 'px/100px Helvetica, Arial, sans-serif',
        fontWeight: 'bold',
        color: this.fontColor,
        lineHeight: this.size + Math.floor(this.size / 20) + 'px'
      };

      var backgroundAndFontStyle = this.isImage ? imgBackgroundAndFontStyle : initialBackgroundAndFontStyle;

      Object.assign(style, backgroundAndFontStyle);

      return style;
    },
    userInitial: function userInitial() {
      var initials = this.initials || this.initial(this.username);
      return initials;
    }
  },

  methods: {
    initial: function initial(username) {
      var parts = username.split(/[ -]/);
      var initials = '';

      for (var i = 0; i < parts.length; i++) {
        initials += parts[i].charAt(0);
      }

      if (initials.length > 3 && initials.search(/[A-Z]/) !== -1) {
        initials = initials.replace(/[a-z]+/g, '');
      }

      initials = initials.substr(0, 3).toUpperCase();

      return initials;
    },
    randomBackgroundColor: function randomBackgroundColor(seed, colors) {
      return colors[seed % colors.length];
    },
    lightenColor: function lightenColor(hex, amt) {
      // From https://css-tricks.com/snippets/javascript/lighten-darken-color/
      var usePound = false;

      if (hex[0] === '#') {
        hex = hex.slice(1);
        usePound = true;
      }

      var num = parseInt(hex, 16);
      var r = (num >> 16) + amt;

      if (r > 255) r = 255;else if (r < 0) r = 0;

      var b = (num >> 8 & 0x00FF) + amt;

      if (b > 255) b = 255;else if (b < 0) b = 0;

      var g = (num & 0x0000FF) + amt;

      if (g > 255) g = 255;else if (g < 0) g = 0;

      return (usePound ? '#' : '') + (g | b << 8 | r << 16).toString(16);
    }
  }
});

/***/ }),

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "vue-avatar--wrapper", style: [_vm.style, _vm.customStyle] },
    [!this.src ? _c("span", [_vm._v(_vm._s(_vm.userInitial))]) : _vm._e()]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e1a7fc60", module.exports)
  }
}

/***/ }),

/***/ 47:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "hoverable application-list",
      class: { rejected: !_vm.isApproved }
    },
    [
      _c(
        "div",
        { staticClass: "user-logo" },
        [
          _c("avatar", {
            attrs: { username: _vm.userName, size: 44, src: _vm.userLogo }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c("div", { staticClass: "user-name" }, [_vm._v(_vm._s(_vm.userName))]),
      _vm._v(" "),
      _c("div", {
        staticClass: "application-status-light",
        class: { on: _vm.isApproved }
      }),
      _vm._v(" "),
      _c("div", {
        staticClass: "application-status-light",
        class: { on: _vm.isSignedIn }
      }),
      _vm._v(" "),
      _c("div", {
        staticClass: "application-status-light",
        class: { on: _vm.isSignedOut }
      }),
      _vm._v(" "),
      _c("div", { staticClass: "space-between" }),
      _vm._v(" "),
      _c("div", { staticClass: "action-button hide-on-small-only" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.isApproved,
              expression: "isApproved"
            }
          ],
          staticClass: "filled-in",
          attrs: { type: "checkbox", id: "approved-" + _vm.applicationId },
          domProps: {
            checked: Array.isArray(_vm.isApproved)
              ? _vm._i(_vm.isApproved, null) > -1
              : _vm.isApproved
          },
          on: {
            change: [
              function($event) {
                var $$a = _vm.isApproved,
                  $$el = $event.target,
                  $$c = $$el.checked ? true : false
                if (Array.isArray($$a)) {
                  var $$v = null,
                    $$i = _vm._i($$a, $$v)
                  if ($$el.checked) {
                    $$i < 0 && (_vm.isApproved = $$a.concat([$$v]))
                  } else {
                    $$i > -1 &&
                      (_vm.isApproved = $$a
                        .slice(0, $$i)
                        .concat($$a.slice($$i + 1)))
                  }
                } else {
                  _vm.isApproved = $$c
                }
              },
              _vm.updateApplication
            ]
          }
        }),
        _vm._v(" "),
        _c("label", { attrs: { for: "approved-" + _vm.applicationId } })
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "action-button hide-on-small-only" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.isSignedIn,
              expression: "isSignedIn"
            }
          ],
          staticClass: "filled-in",
          attrs: { type: "checkbox", id: "sign-in-" + _vm.applicationId },
          domProps: {
            checked: Array.isArray(_vm.isSignedIn)
              ? _vm._i(_vm.isSignedIn, null) > -1
              : _vm.isSignedIn
          },
          on: {
            change: [
              function($event) {
                var $$a = _vm.isSignedIn,
                  $$el = $event.target,
                  $$c = $$el.checked ? true : false
                if (Array.isArray($$a)) {
                  var $$v = null,
                    $$i = _vm._i($$a, $$v)
                  if ($$el.checked) {
                    $$i < 0 && (_vm.isSignedIn = $$a.concat([$$v]))
                  } else {
                    $$i > -1 &&
                      (_vm.isSignedIn = $$a
                        .slice(0, $$i)
                        .concat($$a.slice($$i + 1)))
                  }
                } else {
                  _vm.isSignedIn = $$c
                }
              },
              _vm.updateApplication
            ]
          }
        }),
        _vm._v(" "),
        _c("label", { attrs: { for: "sign-in-" + _vm.applicationId } })
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "action-button hide-on-small-only" }, [
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.isSignedOut,
              expression: "isSignedOut"
            }
          ],
          staticClass: "filled-in",
          attrs: { type: "checkbox", id: "sign-out-" + _vm.applicationId },
          domProps: {
            checked: Array.isArray(_vm.isSignedOut)
              ? _vm._i(_vm.isSignedOut, null) > -1
              : _vm.isSignedOut
          },
          on: {
            change: [
              function($event) {
                var $$a = _vm.isSignedOut,
                  $$el = $event.target,
                  $$c = $$el.checked ? true : false
                if (Array.isArray($$a)) {
                  var $$v = null,
                    $$i = _vm._i($$a, $$v)
                  if ($$el.checked) {
                    $$i < 0 && (_vm.isSignedOut = $$a.concat([$$v]))
                  } else {
                    $$i > -1 &&
                      (_vm.isSignedOut = $$a
                        .slice(0, $$i)
                        .concat($$a.slice($$i + 1)))
                  }
                } else {
                  _vm.isSignedOut = $$c
                }
              },
              _vm.updateApplication
            ]
          }
        }),
        _vm._v(" "),
        _c("label", { attrs: { for: "sign-out-" + _vm.applicationId } })
      ]),
      _vm._v(" "),
      _vm.isApproved
        ? _c(
            "a",
            {
              staticClass: "action-button hide-on-med-and-up",
              attrs: { href: "#!" },
              on: { click: _vm.approveLinkAction }
            },
            [_vm._v("撤销批准")]
          )
        : _c(
            "a",
            {
              staticClass: "action-button hide-on-med-and-up",
              attrs: { href: "#!" },
              on: { click: _vm.approveLinkAction }
            },
            [_vm._v("批准申请")]
          ),
      _vm._v(" "),
      _vm.isSignedIn
        ? _c(
            "a",
            {
              staticClass: "action-button hide-on-med-and-up",
              attrs: { href: "#!" },
              on: { click: _vm.signedInLinkAction }
            },
            [_vm._v("标记为未签到")]
          )
        : _c(
            "a",
            {
              staticClass: "action-button hide-on-med-and-up",
              attrs: { href: "#!" },
              on: { click: _vm.signedInLinkAction }
            },
            [_vm._v("标记为已签到")]
          ),
      _vm._v(" "),
      _vm.isSignedOut
        ? _c(
            "a",
            {
              staticClass: "action-button hide-on-med-and-up",
              attrs: { href: "#!" },
              on: { click: _vm.signedOutLinkAction }
            },
            [_vm._v("标记为未签退")]
          )
        : _c(
            "a",
            {
              staticClass: "action-button hide-on-med-and-up",
              attrs: { href: "#!" },
              on: { click: _vm.signedOutLinkAction }
            },
            [_vm._v("标记为已签退")]
          )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2c50d0ce", module.exports)
  }
}

/***/ })

/******/ });