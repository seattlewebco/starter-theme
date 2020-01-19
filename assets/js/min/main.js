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
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/hide-show.js":
/*!********************************!*\
  !*** ./assets/js/hide-show.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

function hide(element) {
  var el = document.getElementsByClassName(element)[0];
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= 0.1) < 0) {
      el.style.display = 'none';
    } else {
      requestAnimationFrame(fade);
    }
  })();
}

function show(element, display) {
  var el = document.getElementsByClassName(element)[0];
  el.style.opacity = 0;
  el.style.display = display || 'inline-flex';

  (function fade() {
    var val = parseFloat(el.style.opacity);

    if (!((val += 0.1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
} // Hide modal on click outside.


document.addEventListener('click', function (event) {
  var modal = document.getElementsByClassName('modal')[0];

  if (!modal || event.target.closest('.modal')) {
    return;
  }

  if ('1' === modal.style.opacity) {
    hide('modal');
  }
});

/***/ }),

/***/ "./assets/js/navigation.js":
/*!*********************************!*\
  !*** ./assets/js/navigation.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
  var container, button, menu, links, items, i, len, indicator;
  container = document.getElementById('site-navigation');

  if (!container) {
    return;
  }

  button = document.getElementsByClassName('menu-toggle')[0];

  if ('undefined' === typeof button) {
    return;
  }

  menu = container.getElementsByTagName('ul')[0]; // Hide menu toggle button if menu is empty and return early.

  if ('undefined' === typeof menu) {
    button.style.display = 'none';
    return;
  }

  menu.setAttribute('aria-expanded', 'false');

  if (-1 === menu.className.indexOf('nav-menu')) {
    menu.className += ' nav-menu menu';
  }

  button.onclick = function () {
    if (-1 !== container.className.indexOf('toggled')) {
      container.className = container.className.replace(' toggled', '');

      if (container.style.removeProperty) {
        container.style.removeProperty('display');
      } else {
        container.style.removeAttribute('display');
      }

      button.setAttribute('aria-expanded', 'false');
      button.className = button.className.replace(' activated', '');
      menu.setAttribute('aria-expanded', 'false');
    } else {
      container.className += ' toggled';
      container.style.display = 'block';
      button.setAttribute('aria-expanded', 'true');
      button.className += ' activated';
      menu.setAttribute('aria-expanded', 'true');
    }
  };
  /*
  indicator = container.querySelectorAll( '.menu-indicator' )[0];
  items     = container.querySelectorAll( '.menu > li' );
  
  function handleIndicator(el) {
  	items.forEach(item => {
  		item.classList.remove('is-active');
  		item.removeAttribute('style');
  	});
  	
  	indicator.style.width = `${el.offsetWidth}px`;
  	indicator.style.left = `${el.offsetLeft}px`;
  	indicator.style.backgroundColor = el.getAttribute('active-color');
  
  	el.classList.add('is-active');
  	el.style.color = el.getAttribute('active-color');
  }
  
  
  items.forEach((item, index) => {
  	console.log( item );
  	item.addEventListener( 'mouseover', ( e ) => { handleIndicator( e.target ) } );
  	item.classList.contains( 'is-active') && handleIndicator( item );
  });
  */
  // Get all the link elements within the menu.


  links = menu.getElementsByTagName('a'); // Each time a menu link is focused or blurred, toggle focus.

  for (i = 0, len = links.length; i < len; i++) {
    links[i].addEventListener('focus', toggleFocus, true);
    links[i].addEventListener('blur', toggleFocus, true);
  }
  /**
   * Sets or removes .focus class on an element.
   */


  function toggleFocus() {
    var self = this; // Move up through the ancestors of the current link until we hit .nav-menu.

    while (-1 === self.className.indexOf('nav-menu')) {
      // On li elements toggle the class .focus.
      if ('li' === self.tagName.toLowerCase()) {
        if (-1 !== self.className.indexOf('focus')) {
          self.className = self.className.replace(' focus', '');
        } else {
          self.className += ' focus';
        }
      }

      self = self.parentElement;
    }
  }
  /**
   * Toggles `focus` class to allow submenu access on tablets.
   */


  (function (container) {
    var touchStartFn,
        i,
        parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

    if ('ontouchstart' in window) {
      touchStartFn = function touchStartFn(e) {
        var menuItem = this.parentNode,
            i;

        if (!menuItem.classList.contains('focus')) {
          e.preventDefault();

          for (i = 0; i < menuItem.parentNode.children.length; ++i) {
            if (menuItem === menuItem.parentNode.children[i]) {
              continue;
            }

            menuItem.parentNode.children[i].classList.remove('focus');
          }

          menuItem.classList.add('focus');
        } else {
          menuItem.classList.remove('focus');
        }
      };

      for (i = 0; i < parentLink.length; ++i) {
        parentLink[i].addEventListener('touchstart', touchStartFn, false);
      }
    }
  })(container);
})();

/***/ }),

/***/ "./assets/js/smooth-scroll.js":
/*!************************************!*\
  !*** ./assets/js/smooth-scroll.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {



/***/ }),

/***/ "./assets/js/sticky-header.js":
/*!************************************!*\
  !*** ./assets/js/sticky-header.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var scrollPosition = window.scrollY,
    siteHeader = document.getElementsByClassName('site-header')[0],
    siteHeaderHeight = siteHeader.offsetHeight;
window.addEventListener('scroll', function () {
  scrollPosition = window.scrollY;

  if (scrollPosition >= siteHeaderHeight) {
    siteHeader.classList.add('sticky');
  } else {
    siteHeader.classList.remove('sticky');
  }
});

/***/ }),

/***/ 2:
/*!**************************************************************************************************************************!*\
  !*** multi ./assets/js/hide-show.js ./assets/js/sticky-header.js ./assets/js/smooth-scroll.js ./assets/js/navigation.js ***!
  \**************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Workspace\swc.local\www\wp-content\themes\swc\assets\js\hide-show.js */"./assets/js/hide-show.js");
__webpack_require__(/*! C:\Workspace\swc.local\www\wp-content\themes\swc\assets\js\sticky-header.js */"./assets/js/sticky-header.js");
__webpack_require__(/*! C:\Workspace\swc.local\www\wp-content\themes\swc\assets\js\smooth-scroll.js */"./assets/js/smooth-scroll.js");
module.exports = __webpack_require__(/*! C:\Workspace\swc.local\www\wp-content\themes\swc\assets\js\navigation.js */"./assets/js/navigation.js");


/***/ })

/******/ });