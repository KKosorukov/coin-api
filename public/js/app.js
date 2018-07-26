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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__settings__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__settings___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__settings__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__banner__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__adv_block__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__adv_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__adv_block__);




new Banner('[class^=adv-block]').show();

/***/ }),
/* 1 */
/***/ (function(module, exports) {



/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/**
 * Banner class
 */
class Banner {
  constructor(selector) {
    this.limitOnAdaptiveWidth = 960;
    this.iframesSizes = {
      'adaptive' : {
        'x' : 200,
        'y' : 320
      },
      'nonAdaptive' : {
        'x' : 600,
        'y' : 300
      }
    };

    this.advBlocks = this.getAdvBlocks(selector);
    this.host = location.protocol + '//' + location.host;
    this.advIframes = [];
    this.bindEvents();
  }

  /**
   * Get all advertising blocks
   * @param selector
   */
  getAdvBlocks(selector) {
    var resultBlocks = [];
    var blocks = document.querySelectorAll(selector);
    blocks.forEach(function(element) {
      var className = element.getAttribute('class');
      var parts = className.split('-');
      resultBlocks.push({
        'element' : element
      });

      if(parts.length >= 3 && /^\d{1,}$/.test(parts[2])) { // Last part is a part about banner type
        resultBlocks[resultBlocks.length - 1].type = parts[2];
        if(parts.length == 4) { // We can call all with different container
          resultBlocks[resultBlocks.length - 1].container = parts[3];
        }
      }
      else {
        resultBlocks[resultBlocks.length - 1].type = 0; // Default type is null
      }

    });

    return resultBlocks;
  }

  /**
   * Контейнер для баннера
   * @param block
   */
  setContainer(block) {
    this.advBlock = block;
  }

  /**
   * Получить баннер
   */
  show() {
    for(let i = 0; i < this.advBlocks.length; i++) {

      if(typeof this.advBlocks[i].container != 'undefined') {
        axios.get(this.host + '/banner/get/' + this.advBlocks[i].type + '/' + this.advBlocks[i].container)
          .then(function(res) {
            console.log(res);
          })
          .catch(function(error) {

          });
      } else { // Default container is iframe

        var iframe = document.createElement('iframe');
        this.advIframes.push(iframe);
        if(window.innerWidth < this.limitOnAdaptiveWidth) {
          iframe.setAttribute('style', 'width: ' + this.iframesSizes.adaptive.x + 'px; height: ' + this.iframesSizes.adaptive.y + 'px; border: none;');
        } else {
          iframe.setAttribute('style', 'width: ' + this.iframesSizes.nonAdaptive.x + 'px; height: ' + this.iframesSizes.nonAdaptive.y + 'px; border: none;');
        }

        iframe.setAttribute('src', this.host + '/banner/get/' + this.advBlocks[i].type);

        this.advBlocks[i].element.appendChild(iframe);

      }
    }
  }

  bindEvents() {
    window.onresize = (ev) => {
      this.advIframes.forEach(function(iframe) {
        if(window.innerWidth < this.limitOnAdaptiveWidth) {
          iframe.setAttribute('style', 'width: ' + this.iframesSizes.adaptive.x + 'px; height: ' + this.iframesSizes.adaptive.y + 'px; border: none;');
        } else {
          iframe.setAttribute('style', 'width: ' + this.iframesSizes.nonAdaptive.x + 'px; height: ' + this.iframesSizes.nonAdaptive.y + 'px; border: none;');
        }
      });
    }
  }
}
/* unused harmony export Banner */


/***/ }),
/* 3 */
/***/ (function(module, exports) {



/***/ })
/******/ ]);