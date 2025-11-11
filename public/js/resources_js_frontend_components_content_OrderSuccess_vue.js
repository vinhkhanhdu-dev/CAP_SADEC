"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_frontend_components_content_OrderSuccess_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "OrderSuccess"
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render),
/* harmony export */   staticRenderFns: () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function render() {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "container"
  }, [_c("div", {
    staticStyle: {
      display: "flex",
      "flex-direction": "column",
      "text-align": "center",
      "justify-content": "center",
      "align-items": "center"
    }
  }, [_c("img", {
    attrs: {
      width: "400",
      src: "/img/success.gif"
    }
  }), _vm._v(" "), _c("div", {
    staticStyle: {
      display: "flex",
      "flex-direction": "column",
      "text-align": "center",
      "margin-bottom": "20px"
    }
  }, [_c("span", {
    staticStyle: {
      "font-weight": "bold",
      "font-size": "20px",
      color: "#239a1a"
    }
  }, [_vm._v("Đơn hàng: " + _vm._s(_vm.$route.params.order_code))]), _vm._v(" "), _c("span", {
    staticStyle: {
      "font-weight": "bold",
      "font-size": "20px",
      color: "#239a1a"
    }
  }, [_vm._v("Đã đặt hàng thành công, Cảm ơn quý khách đã ủng hộ")]), _vm._v(" "), _c("span", {
    staticStyle: {
      color: "rgb(0,0,0,0.2)"
    }
  }, [_vm._v("Quí khách vui lòng thường xuyên kiểm tra điện thoại, để bên giao hàng dễ dàng liên hệ")]), _vm._v(" "), _c("el-button", {
    staticStyle: {
      "margin-top": "10px"
    },
    on: {
      click: function click($event) {
        return _vm.$router.push({
          name: "home"
        });
      }
    }
  }, [_c("i", {
    staticClass: "el-icon-shopping-cart-2"
  }), _vm._v("\n                Tiếp tục mua sắm")])], 1)])]);
};
var staticRenderFns = [];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/frontend/components/content/OrderSuccess.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/frontend/components/content/OrderSuccess.vue ***!
  \*******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _OrderSuccess_vue_vue_type_template_id_16fd29b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true& */ "./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true&");
/* harmony import */ var _OrderSuccess_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./OrderSuccess.vue?vue&type=script&lang=js& */ "./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _OrderSuccess_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _OrderSuccess_vue_vue_type_template_id_16fd29b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _OrderSuccess_vue_vue_type_template_id_16fd29b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "16fd29b6",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/frontend/components/content/OrderSuccess.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderSuccess_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./OrderSuccess.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderSuccess_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true&":
/*!**************************************************************************************************************!*\
  !*** ./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true& ***!
  \**************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderSuccess_vue_vue_type_template_id_16fd29b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   staticRenderFns: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderSuccess_vue_vue_type_template_id_16fd29b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_OrderSuccess_vue_vue_type_template_id_16fd29b6_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/frontend/components/content/OrderSuccess.vue?vue&type=template&id=16fd29b6&scoped=true&");


/***/ })

}]);