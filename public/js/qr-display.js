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
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
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

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports, __webpack_require__) {

Vue.component('qr-code', __webpack_require__(50));

var app = new Vue({
    el: '#app',
    methods: {
        getQRFrameSize: function getQRFrameSize() {
            var qrFrame = document.querySelector('#qr-frame');
            var height = Number(window.getComputedStyle(qrFrame).getPropertyValue('height').slice(0, -2));
            var width = Number(window.getComputedStyle(qrFrame).getPropertyValue('width').slice(0, -2));
            return Math.min(height, width);
        },
        toggleFullScreen: function toggleFullScreen(event) {
            function launchFullscreen(element) {
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullScreen();
                }
            }
            function exitFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
            }
            var fullscreenElement = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;

            if (fullscreenElement == null) {
                event.target.innerHTML = "退出全屏";
                launchFullscreen(document.body);
                var self = this;
                self.$refs.qrcode.size = self.getQRFrameSize();
                //alert(self.getQRFrameSize());
                self.$nextTick(function () {
                    self.$refs.qrcode.$nextTick(function () {
                        //alert(this.size);
                    });
                });
            } else {
                event.target.innerHTML = "全屏显示";
                exitFullscreen();
            }
        }
    }
});

/***/ }),

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(2)
/* script */
var __vue_script__ = __webpack_require__(51)
/* template */
var __vue_template__ = __webpack_require__(53)
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
Component.options.__file = "resources/assets/js/components/QR.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6a08c1f8", Component.options)
  } else {
    hotAPI.reload("data-v-6a08c1f8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),

/***/ 51:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_qrcode_vue__ = __webpack_require__(52);
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            value: 'Please wait'
        };
    },

    props: {
        src: String,
        size: Number
    },
    components: {
        QrcodeVue: __WEBPACK_IMPORTED_MODULE_0_qrcode_vue__["a" /* default */]
    },
    mounted: function mounted() {
        var _this = this;

        this.updateQR();
        setInterval(function () {
            _this.updateQR();
        }, 10000);
        document.querySelector("#qr-frame canvas").removeAttribute("style");
    },
    methods: {
        updateQR: function updateQR() {
            var self = this;
            axios.get(this.src).then(function (respond) {
                self.value = respond.data;
            }).catch(function (error) {
                console.log(error);
            });
        }
    }
});

/***/ }),

/***/ 52:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/*!
 * qrcode.vue v1.5.2
 * A Vue component for QRCode.
 * © 2017-2018 @scopewu
 * MIT License.
 */
var mode = {
	MODE_NUMBER: 1 << 0,
	MODE_ALPHA_NUM: 1 << 1,
	MODE_8BIT_BYTE: 1 << 2,
	MODE_KANJI: 1 << 3
};

function QR8bitByte(data) {
	this.mode = mode.MODE_8BIT_BYTE;
	this.data = data;
}

QR8bitByte.prototype = {

	getLength: function getLength(buffer) {
		return this.data.length;
	},

	write: function write(buffer) {
		for (var i = 0; i < this.data.length; i++) {
			// not JIS ...
			buffer.put(this.data.charCodeAt(i), 8);
		}
	}
};

var _8BitByte = QR8bitByte;

var ErrorCorrectLevel = {
	L: 1,
	M: 0,
	Q: 3,
	H: 2
};

// ErrorCorrectLevel


function QRRSBlock(totalCount, dataCount) {
	this.totalCount = totalCount;
	this.dataCount = dataCount;
}

QRRSBlock.RS_BLOCK_TABLE = [

// L
// M
// Q
// H

// 1
[1, 26, 19], [1, 26, 16], [1, 26, 13], [1, 26, 9],

// 2
[1, 44, 34], [1, 44, 28], [1, 44, 22], [1, 44, 16],

// 3
[1, 70, 55], [1, 70, 44], [2, 35, 17], [2, 35, 13],

// 4		
[1, 100, 80], [2, 50, 32], [2, 50, 24], [4, 25, 9],

// 5
[1, 134, 108], [2, 67, 43], [2, 33, 15, 2, 34, 16], [2, 33, 11, 2, 34, 12],

// 6
[2, 86, 68], [4, 43, 27], [4, 43, 19], [4, 43, 15],

// 7		
[2, 98, 78], [4, 49, 31], [2, 32, 14, 4, 33, 15], [4, 39, 13, 1, 40, 14],

// 8
[2, 121, 97], [2, 60, 38, 2, 61, 39], [4, 40, 18, 2, 41, 19], [4, 40, 14, 2, 41, 15],

// 9
[2, 146, 116], [3, 58, 36, 2, 59, 37], [4, 36, 16, 4, 37, 17], [4, 36, 12, 4, 37, 13],

// 10		
[2, 86, 68, 2, 87, 69], [4, 69, 43, 1, 70, 44], [6, 43, 19, 2, 44, 20], [6, 43, 15, 2, 44, 16],

// 11
[4, 101, 81], [1, 80, 50, 4, 81, 51], [4, 50, 22, 4, 51, 23], [3, 36, 12, 8, 37, 13],

// 12
[2, 116, 92, 2, 117, 93], [6, 58, 36, 2, 59, 37], [4, 46, 20, 6, 47, 21], [7, 42, 14, 4, 43, 15],

// 13
[4, 133, 107], [8, 59, 37, 1, 60, 38], [8, 44, 20, 4, 45, 21], [12, 33, 11, 4, 34, 12],

// 14
[3, 145, 115, 1, 146, 116], [4, 64, 40, 5, 65, 41], [11, 36, 16, 5, 37, 17], [11, 36, 12, 5, 37, 13],

// 15
[5, 109, 87, 1, 110, 88], [5, 65, 41, 5, 66, 42], [5, 54, 24, 7, 55, 25], [11, 36, 12],

// 16
[5, 122, 98, 1, 123, 99], [7, 73, 45, 3, 74, 46], [15, 43, 19, 2, 44, 20], [3, 45, 15, 13, 46, 16],

// 17
[1, 135, 107, 5, 136, 108], [10, 74, 46, 1, 75, 47], [1, 50, 22, 15, 51, 23], [2, 42, 14, 17, 43, 15],

// 18
[5, 150, 120, 1, 151, 121], [9, 69, 43, 4, 70, 44], [17, 50, 22, 1, 51, 23], [2, 42, 14, 19, 43, 15],

// 19
[3, 141, 113, 4, 142, 114], [3, 70, 44, 11, 71, 45], [17, 47, 21, 4, 48, 22], [9, 39, 13, 16, 40, 14],

// 20
[3, 135, 107, 5, 136, 108], [3, 67, 41, 13, 68, 42], [15, 54, 24, 5, 55, 25], [15, 43, 15, 10, 44, 16],

// 21
[4, 144, 116, 4, 145, 117], [17, 68, 42], [17, 50, 22, 6, 51, 23], [19, 46, 16, 6, 47, 17],

// 22
[2, 139, 111, 7, 140, 112], [17, 74, 46], [7, 54, 24, 16, 55, 25], [34, 37, 13],

// 23
[4, 151, 121, 5, 152, 122], [4, 75, 47, 14, 76, 48], [11, 54, 24, 14, 55, 25], [16, 45, 15, 14, 46, 16],

// 24
[6, 147, 117, 4, 148, 118], [6, 73, 45, 14, 74, 46], [11, 54, 24, 16, 55, 25], [30, 46, 16, 2, 47, 17],

// 25
[8, 132, 106, 4, 133, 107], [8, 75, 47, 13, 76, 48], [7, 54, 24, 22, 55, 25], [22, 45, 15, 13, 46, 16],

// 26
[10, 142, 114, 2, 143, 115], [19, 74, 46, 4, 75, 47], [28, 50, 22, 6, 51, 23], [33, 46, 16, 4, 47, 17],

// 27
[8, 152, 122, 4, 153, 123], [22, 73, 45, 3, 74, 46], [8, 53, 23, 26, 54, 24], [12, 45, 15, 28, 46, 16],

// 28
[3, 147, 117, 10, 148, 118], [3, 73, 45, 23, 74, 46], [4, 54, 24, 31, 55, 25], [11, 45, 15, 31, 46, 16],

// 29
[7, 146, 116, 7, 147, 117], [21, 73, 45, 7, 74, 46], [1, 53, 23, 37, 54, 24], [19, 45, 15, 26, 46, 16],

// 30
[5, 145, 115, 10, 146, 116], [19, 75, 47, 10, 76, 48], [15, 54, 24, 25, 55, 25], [23, 45, 15, 25, 46, 16],

// 31
[13, 145, 115, 3, 146, 116], [2, 74, 46, 29, 75, 47], [42, 54, 24, 1, 55, 25], [23, 45, 15, 28, 46, 16],

// 32
[17, 145, 115], [10, 74, 46, 23, 75, 47], [10, 54, 24, 35, 55, 25], [19, 45, 15, 35, 46, 16],

// 33
[17, 145, 115, 1, 146, 116], [14, 74, 46, 21, 75, 47], [29, 54, 24, 19, 55, 25], [11, 45, 15, 46, 46, 16],

// 34
[13, 145, 115, 6, 146, 116], [14, 74, 46, 23, 75, 47], [44, 54, 24, 7, 55, 25], [59, 46, 16, 1, 47, 17],

// 35
[12, 151, 121, 7, 152, 122], [12, 75, 47, 26, 76, 48], [39, 54, 24, 14, 55, 25], [22, 45, 15, 41, 46, 16],

// 36
[6, 151, 121, 14, 152, 122], [6, 75, 47, 34, 76, 48], [46, 54, 24, 10, 55, 25], [2, 45, 15, 64, 46, 16],

// 37
[17, 152, 122, 4, 153, 123], [29, 74, 46, 14, 75, 47], [49, 54, 24, 10, 55, 25], [24, 45, 15, 46, 46, 16],

// 38
[4, 152, 122, 18, 153, 123], [13, 74, 46, 32, 75, 47], [48, 54, 24, 14, 55, 25], [42, 45, 15, 32, 46, 16],

// 39
[20, 147, 117, 4, 148, 118], [40, 75, 47, 7, 76, 48], [43, 54, 24, 22, 55, 25], [10, 45, 15, 67, 46, 16],

// 40
[19, 148, 118, 6, 149, 119], [18, 75, 47, 31, 76, 48], [34, 54, 24, 34, 55, 25], [20, 45, 15, 61, 46, 16]];

QRRSBlock.getRSBlocks = function (typeNumber, errorCorrectLevel) {

	var rsBlock = QRRSBlock.getRsBlockTable(typeNumber, errorCorrectLevel);

	if (rsBlock == undefined) {
		throw new Error("bad rs block @ typeNumber:" + typeNumber + "/errorCorrectLevel:" + errorCorrectLevel);
	}

	var length = rsBlock.length / 3;

	var list = new Array();

	for (var i = 0; i < length; i++) {

		var count = rsBlock[i * 3 + 0];
		var totalCount = rsBlock[i * 3 + 1];
		var dataCount = rsBlock[i * 3 + 2];

		for (var j = 0; j < count; j++) {
			list.push(new QRRSBlock(totalCount, dataCount));
		}
	}

	return list;
};

QRRSBlock.getRsBlockTable = function (typeNumber, errorCorrectLevel) {

	switch (errorCorrectLevel) {
		case ErrorCorrectLevel.L:
			return QRRSBlock.RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 0];
		case ErrorCorrectLevel.M:
			return QRRSBlock.RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 1];
		case ErrorCorrectLevel.Q:
			return QRRSBlock.RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 2];
		case ErrorCorrectLevel.H:
			return QRRSBlock.RS_BLOCK_TABLE[(typeNumber - 1) * 4 + 3];
		default:
			return undefined;
	}
};

var RSBlock = QRRSBlock;

function QRBitBuffer() {
	this.buffer = new Array();
	this.length = 0;
}

QRBitBuffer.prototype = {

	get: function get(index) {
		var bufIndex = Math.floor(index / 8);
		return (this.buffer[bufIndex] >>> 7 - index % 8 & 1) == 1;
	},

	put: function put(num, length) {
		for (var i = 0; i < length; i++) {
			this.putBit((num >>> length - i - 1 & 1) == 1);
		}
	},

	getLengthInBits: function getLengthInBits() {
		return this.length;
	},

	putBit: function putBit(bit) {

		var bufIndex = Math.floor(this.length / 8);
		if (this.buffer.length <= bufIndex) {
			this.buffer.push(0);
		}

		if (bit) {
			this.buffer[bufIndex] |= 0x80 >>> this.length % 8;
		}

		this.length++;
	}
};

var BitBuffer = QRBitBuffer;

var QRMath = {

	glog: function glog(n) {

		if (n < 1) {
			throw new Error("glog(" + n + ")");
		}

		return QRMath.LOG_TABLE[n];
	},

	gexp: function gexp(n) {

		while (n < 0) {
			n += 255;
		}

		while (n >= 256) {
			n -= 255;
		}

		return QRMath.EXP_TABLE[n];
	},

	EXP_TABLE: new Array(256),

	LOG_TABLE: new Array(256)

};

for (var i = 0; i < 8; i++) {
	QRMath.EXP_TABLE[i] = 1 << i;
}
for (var i = 8; i < 256; i++) {
	QRMath.EXP_TABLE[i] = QRMath.EXP_TABLE[i - 4] ^ QRMath.EXP_TABLE[i - 5] ^ QRMath.EXP_TABLE[i - 6] ^ QRMath.EXP_TABLE[i - 8];
}
for (var i = 0; i < 255; i++) {
	QRMath.LOG_TABLE[QRMath.EXP_TABLE[i]] = i;
}

var math = QRMath;

function QRPolynomial(num, shift) {

	if (num.length == undefined) {
		throw new Error(num.length + "/" + shift);
	}

	var offset = 0;

	while (offset < num.length && num[offset] == 0) {
		offset++;
	}

	this.num = new Array(num.length - offset + shift);
	for (var i = 0; i < num.length - offset; i++) {
		this.num[i] = num[i + offset];
	}
}

QRPolynomial.prototype = {

	get: function get(index) {
		return this.num[index];
	},

	getLength: function getLength() {
		return this.num.length;
	},

	multiply: function multiply(e) {

		var num = new Array(this.getLength() + e.getLength() - 1);

		for (var i = 0; i < this.getLength(); i++) {
			for (var j = 0; j < e.getLength(); j++) {
				num[i + j] ^= math.gexp(math.glog(this.get(i)) + math.glog(e.get(j)));
			}
		}

		return new QRPolynomial(num, 0);
	},

	mod: function mod(e) {

		if (this.getLength() - e.getLength() < 0) {
			return this;
		}

		var ratio = math.glog(this.get(0)) - math.glog(e.get(0));

		var num = new Array(this.getLength());

		for (var i = 0; i < this.getLength(); i++) {
			num[i] = this.get(i);
		}

		for (var i = 0; i < e.getLength(); i++) {
			num[i] ^= math.gexp(math.glog(e.get(i)) + ratio);
		}

		// recursive call
		return new QRPolynomial(num, 0).mod(e);
	}
};

var Polynomial = QRPolynomial;

var QRMaskPattern = {
	PATTERN000: 0,
	PATTERN001: 1,
	PATTERN010: 2,
	PATTERN011: 3,
	PATTERN100: 4,
	PATTERN101: 5,
	PATTERN110: 6,
	PATTERN111: 7
};

var QRUtil = {

	PATTERN_POSITION_TABLE: [[], [6, 18], [6, 22], [6, 26], [6, 30], [6, 34], [6, 22, 38], [6, 24, 42], [6, 26, 46], [6, 28, 50], [6, 30, 54], [6, 32, 58], [6, 34, 62], [6, 26, 46, 66], [6, 26, 48, 70], [6, 26, 50, 74], [6, 30, 54, 78], [6, 30, 56, 82], [6, 30, 58, 86], [6, 34, 62, 90], [6, 28, 50, 72, 94], [6, 26, 50, 74, 98], [6, 30, 54, 78, 102], [6, 28, 54, 80, 106], [6, 32, 58, 84, 110], [6, 30, 58, 86, 114], [6, 34, 62, 90, 118], [6, 26, 50, 74, 98, 122], [6, 30, 54, 78, 102, 126], [6, 26, 52, 78, 104, 130], [6, 30, 56, 82, 108, 134], [6, 34, 60, 86, 112, 138], [6, 30, 58, 86, 114, 142], [6, 34, 62, 90, 118, 146], [6, 30, 54, 78, 102, 126, 150], [6, 24, 50, 76, 102, 128, 154], [6, 28, 54, 80, 106, 132, 158], [6, 32, 58, 84, 110, 136, 162], [6, 26, 54, 82, 110, 138, 166], [6, 30, 58, 86, 114, 142, 170]],

	G15: 1 << 10 | 1 << 8 | 1 << 5 | 1 << 4 | 1 << 2 | 1 << 1 | 1 << 0,
	G18: 1 << 12 | 1 << 11 | 1 << 10 | 1 << 9 | 1 << 8 | 1 << 5 | 1 << 2 | 1 << 0,
	G15_MASK: 1 << 14 | 1 << 12 | 1 << 10 | 1 << 4 | 1 << 1,

	getBCHTypeInfo: function getBCHTypeInfo(data) {
		var d = data << 10;
		while (QRUtil.getBCHDigit(d) - QRUtil.getBCHDigit(QRUtil.G15) >= 0) {
			d ^= QRUtil.G15 << QRUtil.getBCHDigit(d) - QRUtil.getBCHDigit(QRUtil.G15);
		}
		return (data << 10 | d) ^ QRUtil.G15_MASK;
	},

	getBCHTypeNumber: function getBCHTypeNumber(data) {
		var d = data << 12;
		while (QRUtil.getBCHDigit(d) - QRUtil.getBCHDigit(QRUtil.G18) >= 0) {
			d ^= QRUtil.G18 << QRUtil.getBCHDigit(d) - QRUtil.getBCHDigit(QRUtil.G18);
		}
		return data << 12 | d;
	},

	getBCHDigit: function getBCHDigit(data) {

		var digit = 0;

		while (data != 0) {
			digit++;
			data >>>= 1;
		}

		return digit;
	},

	getPatternPosition: function getPatternPosition(typeNumber) {
		return QRUtil.PATTERN_POSITION_TABLE[typeNumber - 1];
	},

	getMask: function getMask(maskPattern, i, j) {

		switch (maskPattern) {

			case QRMaskPattern.PATTERN000:
				return (i + j) % 2 == 0;
			case QRMaskPattern.PATTERN001:
				return i % 2 == 0;
			case QRMaskPattern.PATTERN010:
				return j % 3 == 0;
			case QRMaskPattern.PATTERN011:
				return (i + j) % 3 == 0;
			case QRMaskPattern.PATTERN100:
				return (Math.floor(i / 2) + Math.floor(j / 3)) % 2 == 0;
			case QRMaskPattern.PATTERN101:
				return i * j % 2 + i * j % 3 == 0;
			case QRMaskPattern.PATTERN110:
				return (i * j % 2 + i * j % 3) % 2 == 0;
			case QRMaskPattern.PATTERN111:
				return (i * j % 3 + (i + j) % 2) % 2 == 0;

			default:
				throw new Error("bad maskPattern:" + maskPattern);
		}
	},

	getErrorCorrectPolynomial: function getErrorCorrectPolynomial(errorCorrectLength) {

		var a = new Polynomial([1], 0);

		for (var i = 0; i < errorCorrectLength; i++) {
			a = a.multiply(new Polynomial([1, math.gexp(i)], 0));
		}

		return a;
	},

	getLengthInBits: function getLengthInBits(mode$$2, type) {

		if (1 <= type && type < 10) {

			// 1 - 9

			switch (mode$$2) {
				case mode.MODE_NUMBER:
					return 10;
				case mode.MODE_ALPHA_NUM:
					return 9;
				case mode.MODE_8BIT_BYTE:
					return 8;
				case mode.MODE_KANJI:
					return 8;
				default:
					throw new Error("mode:" + mode$$2);
			}
		} else if (type < 27) {

			// 10 - 26

			switch (mode$$2) {
				case mode.MODE_NUMBER:
					return 12;
				case mode.MODE_ALPHA_NUM:
					return 11;
				case mode.MODE_8BIT_BYTE:
					return 16;
				case mode.MODE_KANJI:
					return 10;
				default:
					throw new Error("mode:" + mode$$2);
			}
		} else if (type < 41) {

			// 27 - 40

			switch (mode$$2) {
				case mode.MODE_NUMBER:
					return 14;
				case mode.MODE_ALPHA_NUM:
					return 13;
				case mode.MODE_8BIT_BYTE:
					return 16;
				case mode.MODE_KANJI:
					return 12;
				default:
					throw new Error("mode:" + mode$$2);
			}
		} else {
			throw new Error("type:" + type);
		}
	},

	getLostPoint: function getLostPoint(qrCode) {

		var moduleCount = qrCode.getModuleCount();

		var lostPoint = 0;

		// LEVEL1

		for (var row = 0; row < moduleCount; row++) {

			for (var col = 0; col < moduleCount; col++) {

				var sameCount = 0;
				var dark = qrCode.isDark(row, col);

				for (var r = -1; r <= 1; r++) {

					if (row + r < 0 || moduleCount <= row + r) {
						continue;
					}

					for (var c = -1; c <= 1; c++) {

						if (col + c < 0 || moduleCount <= col + c) {
							continue;
						}

						if (r == 0 && c == 0) {
							continue;
						}

						if (dark == qrCode.isDark(row + r, col + c)) {
							sameCount++;
						}
					}
				}

				if (sameCount > 5) {
					lostPoint += 3 + sameCount - 5;
				}
			}
		}

		// LEVEL2

		for (var row = 0; row < moduleCount - 1; row++) {
			for (var col = 0; col < moduleCount - 1; col++) {
				var count = 0;
				if (qrCode.isDark(row, col)) count++;
				if (qrCode.isDark(row + 1, col)) count++;
				if (qrCode.isDark(row, col + 1)) count++;
				if (qrCode.isDark(row + 1, col + 1)) count++;
				if (count == 0 || count == 4) {
					lostPoint += 3;
				}
			}
		}

		// LEVEL3

		for (var row = 0; row < moduleCount; row++) {
			for (var col = 0; col < moduleCount - 6; col++) {
				if (qrCode.isDark(row, col) && !qrCode.isDark(row, col + 1) && qrCode.isDark(row, col + 2) && qrCode.isDark(row, col + 3) && qrCode.isDark(row, col + 4) && !qrCode.isDark(row, col + 5) && qrCode.isDark(row, col + 6)) {
					lostPoint += 40;
				}
			}
		}

		for (var col = 0; col < moduleCount; col++) {
			for (var row = 0; row < moduleCount - 6; row++) {
				if (qrCode.isDark(row, col) && !qrCode.isDark(row + 1, col) && qrCode.isDark(row + 2, col) && qrCode.isDark(row + 3, col) && qrCode.isDark(row + 4, col) && !qrCode.isDark(row + 5, col) && qrCode.isDark(row + 6, col)) {
					lostPoint += 40;
				}
			}
		}

		// LEVEL4

		var darkCount = 0;

		for (var col = 0; col < moduleCount; col++) {
			for (var row = 0; row < moduleCount; row++) {
				if (qrCode.isDark(row, col)) {
					darkCount++;
				}
			}
		}

		var ratio = Math.abs(100 * darkCount / moduleCount / moduleCount - 50) / 5;
		lostPoint += ratio * 10;

		return lostPoint;
	}
};

var util = QRUtil;

function QRCode(typeNumber, errorCorrectLevel) {
	this.typeNumber = typeNumber;
	this.errorCorrectLevel = errorCorrectLevel;
	this.modules = null;
	this.moduleCount = 0;
	this.dataCache = null;
	this.dataList = [];
}

// for client side minification
var proto = QRCode.prototype;

proto.addData = function (data) {
	var newData = new _8BitByte(data);
	this.dataList.push(newData);
	this.dataCache = null;
};

proto.isDark = function (row, col) {
	if (row < 0 || this.moduleCount <= row || col < 0 || this.moduleCount <= col) {
		throw new Error(row + "," + col);
	}
	return this.modules[row][col];
};

proto.getModuleCount = function () {
	return this.moduleCount;
};

proto.make = function () {
	// Calculate automatically typeNumber if provided is < 1
	if (this.typeNumber < 1) {
		var typeNumber = 1;
		for (typeNumber = 1; typeNumber < 40; typeNumber++) {
			var rsBlocks = RSBlock.getRSBlocks(typeNumber, this.errorCorrectLevel);

			var buffer = new BitBuffer();
			var totalDataCount = 0;
			for (var i = 0; i < rsBlocks.length; i++) {
				totalDataCount += rsBlocks[i].dataCount;
			}

			for (var i = 0; i < this.dataList.length; i++) {
				var data = this.dataList[i];
				buffer.put(data.mode, 4);
				buffer.put(data.getLength(), util.getLengthInBits(data.mode, typeNumber));
				data.write(buffer);
			}
			if (buffer.getLengthInBits() <= totalDataCount * 8) break;
		}
		this.typeNumber = typeNumber;
	}
	this.makeImpl(false, this.getBestMaskPattern());
};

proto.makeImpl = function (test, maskPattern) {

	this.moduleCount = this.typeNumber * 4 + 17;
	this.modules = new Array(this.moduleCount);

	for (var row = 0; row < this.moduleCount; row++) {

		this.modules[row] = new Array(this.moduleCount);

		for (var col = 0; col < this.moduleCount; col++) {
			this.modules[row][col] = null; //(col + row) % 3;
		}
	}

	this.setupPositionProbePattern(0, 0);
	this.setupPositionProbePattern(this.moduleCount - 7, 0);
	this.setupPositionProbePattern(0, this.moduleCount - 7);
	this.setupPositionAdjustPattern();
	this.setupTimingPattern();
	this.setupTypeInfo(test, maskPattern);

	if (this.typeNumber >= 7) {
		this.setupTypeNumber(test);
	}

	if (this.dataCache == null) {
		this.dataCache = QRCode.createData(this.typeNumber, this.errorCorrectLevel, this.dataList);
	}

	this.mapData(this.dataCache, maskPattern);
};

proto.setupPositionProbePattern = function (row, col) {

	for (var r = -1; r <= 7; r++) {

		if (row + r <= -1 || this.moduleCount <= row + r) continue;

		for (var c = -1; c <= 7; c++) {

			if (col + c <= -1 || this.moduleCount <= col + c) continue;

			if (0 <= r && r <= 6 && (c == 0 || c == 6) || 0 <= c && c <= 6 && (r == 0 || r == 6) || 2 <= r && r <= 4 && 2 <= c && c <= 4) {
				this.modules[row + r][col + c] = true;
			} else {
				this.modules[row + r][col + c] = false;
			}
		}
	}
};

proto.getBestMaskPattern = function () {

	var minLostPoint = 0;
	var pattern = 0;

	for (var i = 0; i < 8; i++) {

		this.makeImpl(true, i);

		var lostPoint = util.getLostPoint(this);

		if (i == 0 || minLostPoint > lostPoint) {
			minLostPoint = lostPoint;
			pattern = i;
		}
	}

	return pattern;
};

proto.createMovieClip = function (target_mc, instance_name, depth) {

	var qr_mc = target_mc.createEmptyMovieClip(instance_name, depth);
	var cs = 1;

	this.make();

	for (var row = 0; row < this.modules.length; row++) {

		var y = row * cs;

		for (var col = 0; col < this.modules[row].length; col++) {

			var x = col * cs;
			var dark = this.modules[row][col];

			if (dark) {
				qr_mc.beginFill(0, 100);
				qr_mc.moveTo(x, y);
				qr_mc.lineTo(x + cs, y);
				qr_mc.lineTo(x + cs, y + cs);
				qr_mc.lineTo(x, y + cs);
				qr_mc.endFill();
			}
		}
	}

	return qr_mc;
};

proto.setupTimingPattern = function () {

	for (var r = 8; r < this.moduleCount - 8; r++) {
		if (this.modules[r][6] != null) {
			continue;
		}
		this.modules[r][6] = r % 2 == 0;
	}

	for (var c = 8; c < this.moduleCount - 8; c++) {
		if (this.modules[6][c] != null) {
			continue;
		}
		this.modules[6][c] = c % 2 == 0;
	}
};

proto.setupPositionAdjustPattern = function () {

	var pos = util.getPatternPosition(this.typeNumber);

	for (var i = 0; i < pos.length; i++) {

		for (var j = 0; j < pos.length; j++) {

			var row = pos[i];
			var col = pos[j];

			if (this.modules[row][col] != null) {
				continue;
			}

			for (var r = -2; r <= 2; r++) {

				for (var c = -2; c <= 2; c++) {

					if (r == -2 || r == 2 || c == -2 || c == 2 || r == 0 && c == 0) {
						this.modules[row + r][col + c] = true;
					} else {
						this.modules[row + r][col + c] = false;
					}
				}
			}
		}
	}
};

proto.setupTypeNumber = function (test) {

	var bits = util.getBCHTypeNumber(this.typeNumber);

	for (var i = 0; i < 18; i++) {
		var mod = !test && (bits >> i & 1) == 1;
		this.modules[Math.floor(i / 3)][i % 3 + this.moduleCount - 8 - 3] = mod;
	}

	for (var i = 0; i < 18; i++) {
		var mod = !test && (bits >> i & 1) == 1;
		this.modules[i % 3 + this.moduleCount - 8 - 3][Math.floor(i / 3)] = mod;
	}
};

proto.setupTypeInfo = function (test, maskPattern) {

	var data = this.errorCorrectLevel << 3 | maskPattern;
	var bits = util.getBCHTypeInfo(data);

	// vertical		
	for (var i = 0; i < 15; i++) {

		var mod = !test && (bits >> i & 1) == 1;

		if (i < 6) {
			this.modules[i][8] = mod;
		} else if (i < 8) {
			this.modules[i + 1][8] = mod;
		} else {
			this.modules[this.moduleCount - 15 + i][8] = mod;
		}
	}

	// horizontal
	for (var i = 0; i < 15; i++) {

		var mod = !test && (bits >> i & 1) == 1;

		if (i < 8) {
			this.modules[8][this.moduleCount - i - 1] = mod;
		} else if (i < 9) {
			this.modules[8][15 - i - 1 + 1] = mod;
		} else {
			this.modules[8][15 - i - 1] = mod;
		}
	}

	// fixed module
	this.modules[this.moduleCount - 8][8] = !test;
};

proto.mapData = function (data, maskPattern) {

	var inc = -1;
	var row = this.moduleCount - 1;
	var bitIndex = 7;
	var byteIndex = 0;

	for (var col = this.moduleCount - 1; col > 0; col -= 2) {

		if (col == 6) col--;

		while (true) {

			for (var c = 0; c < 2; c++) {

				if (this.modules[row][col - c] == null) {

					var dark = false;

					if (byteIndex < data.length) {
						dark = (data[byteIndex] >>> bitIndex & 1) == 1;
					}

					var mask = util.getMask(maskPattern, row, col - c);

					if (mask) {
						dark = !dark;
					}

					this.modules[row][col - c] = dark;
					bitIndex--;

					if (bitIndex == -1) {
						byteIndex++;
						bitIndex = 7;
					}
				}
			}

			row += inc;

			if (row < 0 || this.moduleCount <= row) {
				row -= inc;
				inc = -inc;
				break;
			}
		}
	}
};

QRCode.PAD0 = 0xEC;
QRCode.PAD1 = 0x11;

QRCode.createData = function (typeNumber, errorCorrectLevel, dataList) {

	var rsBlocks = RSBlock.getRSBlocks(typeNumber, errorCorrectLevel);

	var buffer = new BitBuffer();

	for (var i = 0; i < dataList.length; i++) {
		var data = dataList[i];
		buffer.put(data.mode, 4);
		buffer.put(data.getLength(), util.getLengthInBits(data.mode, typeNumber));
		data.write(buffer);
	}

	// calc num max data.
	var totalDataCount = 0;
	for (var i = 0; i < rsBlocks.length; i++) {
		totalDataCount += rsBlocks[i].dataCount;
	}

	if (buffer.getLengthInBits() > totalDataCount * 8) {
		throw new Error("code length overflow. (" + buffer.getLengthInBits() + ">" + totalDataCount * 8 + ")");
	}

	// end code
	if (buffer.getLengthInBits() + 4 <= totalDataCount * 8) {
		buffer.put(0, 4);
	}

	// padding
	while (buffer.getLengthInBits() % 8 != 0) {
		buffer.putBit(false);
	}

	// padding
	while (true) {

		if (buffer.getLengthInBits() >= totalDataCount * 8) {
			break;
		}
		buffer.put(QRCode.PAD0, 8);

		if (buffer.getLengthInBits() >= totalDataCount * 8) {
			break;
		}
		buffer.put(QRCode.PAD1, 8);
	}

	return QRCode.createBytes(buffer, rsBlocks);
};

QRCode.createBytes = function (buffer, rsBlocks) {

	var offset = 0;

	var maxDcCount = 0;
	var maxEcCount = 0;

	var dcdata = new Array(rsBlocks.length);
	var ecdata = new Array(rsBlocks.length);

	for (var r = 0; r < rsBlocks.length; r++) {

		var dcCount = rsBlocks[r].dataCount;
		var ecCount = rsBlocks[r].totalCount - dcCount;

		maxDcCount = Math.max(maxDcCount, dcCount);
		maxEcCount = Math.max(maxEcCount, ecCount);

		dcdata[r] = new Array(dcCount);

		for (var i = 0; i < dcdata[r].length; i++) {
			dcdata[r][i] = 0xff & buffer.buffer[i + offset];
		}
		offset += dcCount;

		var rsPoly = util.getErrorCorrectPolynomial(ecCount);
		var rawPoly = new Polynomial(dcdata[r], rsPoly.getLength() - 1);

		var modPoly = rawPoly.mod(rsPoly);
		ecdata[r] = new Array(rsPoly.getLength() - 1);
		for (var i = 0; i < ecdata[r].length; i++) {
			var modIndex = i + modPoly.getLength() - ecdata[r].length;
			ecdata[r][i] = modIndex >= 0 ? modPoly.get(modIndex) : 0;
		}
	}

	var totalCodeCount = 0;
	for (var i = 0; i < rsBlocks.length; i++) {
		totalCodeCount += rsBlocks[i].totalCount;
	}

	var data = new Array(totalCodeCount);
	var index = 0;

	for (var i = 0; i < maxDcCount; i++) {
		for (var r = 0; r < rsBlocks.length; r++) {
			if (i < dcdata[r].length) {
				data[index++] = dcdata[r][i];
			}
		}
	}

	for (var i = 0; i < maxEcCount; i++) {
		for (var r = 0; r < rsBlocks.length; r++) {
			if (i < ecdata[r].length) {
				data[index++] = ecdata[r][i];
			}
		}
	}

	return data;
};

var QRCode_1 = QRCode;

function getBackingStorePixelRatio(ctx) {
  return ctx.webkitBackingStorePixelRatio || ctx.mozBackingStorePixelRatio || ctx.msBackingStorePixelRatio || ctx.oBackingStorePixelRatio || ctx.backingStorePixelRatio || 1;
}

var QrcodeVue = {
  render: function render(h) {
    var className = this.className,
        value = this.value,
        level = this.level,
        background = this.background,
        foreground = this.foreground,
        size = this.size;

    return h(
      'div',
      { 'class': className, attrs: { value: value, level: level, background: background, foreground: foreground }
      },
      [h(
        'canvas',
        {
          attrs: { height: size, width: size },
          style: { width: size + 'px', height: size + 'px' }, ref: 'qrcode-vue' },
        []
      )]
    );
  },

  props: {
    value: {
      type: String,
      required: true,
      default: ''
    },
    className: {
      type: String,
      default: ''
    },
    size: {
      type: [Number, String],
      default: 100,
      validator: function validator(s) {
        return isNaN(Number(s)) !== true;
      }
    },
    level: {
      type: String,
      default: 'L',
      validator: function validator(l) {
        return ['L', 'Q', 'M', 'H'].indexOf(l) > -1;
      }
    },
    background: {
      type: String,
      default: '#fff'
    },
    foreground: {
      type: String,
      default: '#000'
    }
  },
  methods: {
    render: function render() {
      var value = this.value,
          size = this.size,
          level = this.level,
          background = this.background,
          foreground = this.foreground;

      var _size = size >>> 0; // size to number

      // We'll use type===-1 to force QRCode to automatically pick the best type
      var qrCode = new QRCode_1(-1, ErrorCorrectLevel[level]);
      qrCode.addData(value);
      qrCode.make();

      var canvas = this.$refs['qrcode-vue'];

      var ctx = canvas.getContext('2d');
      var cells = qrCode.modules;
      var tileW = _size / cells.length;
      var tileH = _size / cells.length;
      var scale = (window.devicePixelRatio || 1) / getBackingStorePixelRatio(ctx);
      canvas.height = canvas.width = _size * scale;
      ctx.scale(scale, scale);

      cells.forEach(function (row, rdx) {
        row.forEach(function (cell, cdx) {
          ctx.fillStyle = cell ? foreground : background;
          var w = Math.ceil((cdx + 1) * tileW) - Math.floor(cdx * tileW);
          var h = Math.ceil((rdx + 1) * tileH) - Math.floor(rdx * tileH);
          ctx.fillRect(Math.round(cdx * tileW), Math.round(rdx * tileH), w, h);
        });
      });
    }
  },
  updated: function updated() {
    this.render();
  },
  mounted: function mounted() {
    this.render();
  }
};

/* harmony default export */ __webpack_exports__["a"] = (QrcodeVue);


/***/ }),

/***/ 53:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("qrcode-vue", {
    attrs: { value: _vm.value, size: _vm.size, level: "H" }
  })
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-6a08c1f8", module.exports)
  }
}

/***/ })

/******/ });