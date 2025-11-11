"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_backend_components_TaskManager_list_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _configStatus__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./configStatus */ "./resources/js/backend/components/TaskManager/configStatus.js");

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      colors: [{
        color: '#f56c6c',
        percentage: 20,
        status: "exception"
      }, {
        color: '#6f7ad3',
        percentage: 40
      }, {
        color: '#e6a23c',
        percentage: 60
      }, {
        color: '#1989fa',
        percentage: 80
      }, {
        color: '#5cb87a',
        percentage: 100,
        status: "success"
      }],
      idUpdate: '',
      outerVisible: false,
      loadingTable: false,
      tableData: [],
      slideData: [],
      textSearch: '',
      currentPage: 1,
      options: {
        Total: 10,
        Page: 1,
        PageLimit: 10
      },
      triggerLoad: new Date().getTime(),
      listStatus: _configStatus__WEBPACK_IMPORTED_MODULE_0__.listStatus
    };
  },
  mounted: function mounted() {
    this.getList();
  },
  methods: {
    changeRow: function changeRow(e) {
      console.log(e);
    },
    success: function success() {
      this.outerVisible = false;
      this.getList();
    },
    update: function update(e) {
      this.idUpdate = e.id;
      this.$router.push({
        name: 'TaskUpdate',
        params: {
          id: e.id
        }
      });
    },
    detail: function detail(e) {
      this.idUpdate = e.id;
      this.$router.push({
        name: 'TaskDetail',
        params: {
          id: e.id
        }
      });
    },
    handleSizeChange: function handleSizeChange(val) {
      this.options.PageLimit = val;
      this.getList();
    },
    handleCurrentChange: function handleCurrentChange(val) {
      this.options.Page = val;
      this.getList();
    },
    updateStatus: function updateStatus(id, hidden) {
      var _this = this;
      var formData = new FormData();
      console.log(hidden, hidden == "0" ? "1" : "0");
      formData.append('hidden', hidden == "0" ? "1" : "0");
      axios({
        method: 'post',
        url: '/api/admin/product_color/update/' + id,
        data: formData
      }).then(function (response) {
        if (response.data['success']) {
          _this.$notify({
            title: 'Success',
            message: response.data['mess'],
            type: 'success'
          });
          _this.getList();
        } else {
          _this.$notify({
            title: 'Error',
            message: response.data['mess'],
            type: 'error'
          });
        }
      });
    },
    deleteUser: function deleteUser(id) {
      var _this = this;
      axios({
        method: 'post',
        url: '/api/admin/list-task/delete/' + id
      }).then(function (response) {
        if (response.data['success']) {
          _this.$notify({
            title: 'Success',
            message: response.data['mess'],
            type: 'success'
          });
          _this.getList();
        } else {
          _this.$notify({
            title: 'Error',
            message: response.data['mess'],
            type: 'error'
          });
        }
      });
    },
    getList: function getList() {
      var _this = this;
      _this.loadingTable = true;
      var param = {};
      this.options.Page && (param.page = this.options.Page);
      this.options.PageLimit && (param.limit = this.options.PageLimit);
      this.textSearch && (param.TextSearch = this.textSearch);
      axios({
        method: 'get',
        url: '/api/admin/list-task',
        params: param
      }).then(function (_ref) {
        var data = _ref.data;
        if (data['success']) {
          _this.tableData = data['data'];
          _this.options.Total = data['count'];
        }
        _this.loadingTable = false;
      });
    },
    changeStatus: function changeStatus(id) {
      alert(id);
    },
    tableRowClassName: function tableRowClassName(_ref2) {
      var row = _ref2.row,
        rowIndex = _ref2.rowIndex;
      if (rowIndex === 1) {
        return 'warning-row';
      } else if (rowIndex === 3) {
        return 'success-row';
      }
      return '';
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=template&id=3ca8a356&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=template&id=3ca8a356& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************/
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
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "card card-default"
  }, [_vm._m(0), _vm._v(" "), _c("div", {
    staticClass: "card-body"
  }, [_c("div", {
    staticClass: "row"
  }, [_c("div", {
    staticClass: "col-md-12"
  }, [_c("div", {
    staticClass: "row",
    staticStyle: {
      display: "flex",
      "flex-wrap": "nowrap",
      padding: "8px",
      "justify-content": "space-between"
    }
  }, [_c("el-input", {
    staticStyle: {
      width: "500px"
    },
    attrs: {
      placeholder: "Nhập kí tự cần tìm kiếm ..."
    },
    nativeOn: {
      keyup: function keyup($event) {
        if (!$event.type.indexOf("key") && _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")) return null;
        return _vm.getList();
      }
    },
    scopedSlots: _vm._u([{
      key: "append",
      fn: function fn() {
        return [_c("el-button", {
          attrs: {
            type: "primary"
          },
          on: {
            click: function click($event) {
              return _vm.getList();
            }
          }
        }, [_c("i", {
          staticClass: "el-icon-search"
        }), _vm._v(" Tìm\n                                        kiếm\n                                    ")])];
      },
      proxy: true
    }]),
    model: {
      value: _vm.textSearch,
      callback: function callback($$v) {
        _vm.textSearch = $$v;
      },
      expression: "textSearch"
    }
  }), _vm._v(" "), _c("el-button", {
    staticClass: "ml-2",
    attrs: {
      type: "primary"
    },
    on: {
      click: function click($event) {
        return _vm.$router.push({
          name: "TaskCreate"
        });
      }
    }
  }, [_c("i", {
    staticClass: "el-icon-plus"
  }), _vm._v(" Thêm mới\n                            ")])], 1), _vm._v(" "), _c("el-table", {
    directives: [{
      name: "loading",
      rawName: "v-loading",
      value: _vm.loadingTable,
      expression: "loadingTable"
    }],
    staticStyle: {
      width: "100%"
    },
    attrs: {
      "empty-text": "Chưa có dữ liệu !",
      data: _vm.tableData,
      border: "",
      resizable: true,
      "row-class-name": _vm.tableRowClassName
    },
    on: {
      "expand-change": _vm.changeRow
    }
  }, [_c("el-table-column", {
    attrs: {
      prop: "title",
      label: "TITLE",
      width: "200",
      sortable: ""
    }
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      prop: "task_type",
      label: "LOẠI CÔNG VIỆC"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_c("span", [_vm._v(_vm._s(scope.row.task_type[0].title))])];
      }
    }])
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      prop: "assign_to",
      width: "150",
      label: "GIAO CHO"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_c("el-tag", [_vm._v(_vm._s(scope.row.assign_to[0].name))])];
      }
    }])
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      prop: "create_by",
      width: "150",
      label: "NGƯỜI TẠO"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_c("el-tag", [_vm._v(_vm._s(scope.row.create_by[0].name))])];
      }
    }])
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      prop: "progress",
      width: "100",
      label: "TIẾN ĐỘ"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_c("el-progress", {
          attrs: {
            "stroke-width": 10,
            width: 50,
            type: "dashboard",
            percentage: parseInt(scope.row.progress),
            color: _vm.colors
          }
        })];
      }
    }])
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      prop: "status",
      width: "150",
      label: "TRẠNG THÁI"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_c("el-tag", {
          attrs: {
            type: _vm.listStatus.find(function (e) {
              return e.value == scope.row.status;
            }).type
          }
        }, [_c("span", {
          domProps: {
            innerHTML: _vm._s(_vm.listStatus.find(function (e) {
              return e.value == scope.row.status;
            }).title)
          }
        })])];
      }
    }])
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      prop: "created_at",
      label: "NGÀY TẠO",
      width: "150"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_vm._v("\n                                    " + _vm._s(_vm._f("formatDate")(scope.row.created_at)) + "\n                                ")];
      }
    }])
  }), _vm._v(" "), _c("el-table-column", {
    attrs: {
      label: "THAO TÁC",
      width: "180"
    },
    scopedSlots: _vm._u([{
      key: "default",
      fn: function fn(scope) {
        return [_c("el-button", {
          attrs: {
            type: "primary",
            icon: "el-icon-edit",
            circle: ""
          },
          on: {
            click: function click($event) {
              return _vm.update(scope.row);
            }
          }
        }), _vm._v(" "), _c("el-button", {
          attrs: {
            type: "info",
            icon: "el-icon-message",
            circle: ""
          },
          on: {
            click: function click($event) {
              return _vm.detail(scope.row);
            }
          }
        }), _vm._v(" "), _c("el-popconfirm", {
          attrs: {
            "confirm-button-text": "Xóa",
            "cancel-button-text": "Không",
            title: "Bạn có chắc chắn muốn xóa?"
          },
          on: {
            confirm: function confirm() {
              return _vm.deleteUser(scope.row.id);
            }
          }
        }, [_c("el-button", {
          staticStyle: {
            "margin-left": "10px"
          },
          attrs: {
            slot: "reference",
            type: "danger",
            icon: "el-icon-delete",
            circle: ""
          },
          slot: "reference"
        })], 1)];
      }
    }])
  }), _vm._v(" "), _c("template", {
    slot: "empty"
  }, [_c("el-empty", {
    attrs: {
      description: "No data"
    }
  })], 1)], 2)], 1), _vm._v(" "), _c("div", {
    staticClass: "block",
    staticStyle: {
      "margin-left": "0px",
      "margin-right": "8px",
      padding: "10px",
      width: "100%"
    }
  }, [_c("el-pagination", {
    attrs: {
      "current-page": _vm.currentPage,
      "page-sizes": [10, 20, 50, 100],
      "page-size": _vm.options.PageLimit,
      layout: "total, sizes, prev, pager, next, jumper",
      total: _vm.options.Total
    },
    on: {
      "size-change": _vm.handleSizeChange,
      "current-change": _vm.handleCurrentChange,
      "update:currentPage": function updateCurrentPage($event) {
        _vm.currentPage = $event;
      },
      "update:current-page": function updateCurrentPage($event) {
        _vm.currentPage = $event;
      }
    }
  })], 1)])]), _vm._v(" "), _c("div", {
    staticClass: "card-footer"
  })])])]);
};
var staticRenderFns = [function () {
  var _vm = this,
    _c = _vm._self._c;
  return _c("div", {
    staticClass: "card-header",
    staticStyle: {
      "background-color": "rgb(0,0,0,0.1)"
    }
  }, [_c("h3", {
    staticClass: "card-title"
  }, [_vm._v("DANH SÁCH CÔNG VIỆC")]), _vm._v(" "), _c("div", {
    staticClass: "card-tools"
  }, [_c("button", {
    staticClass: "btn btn-tool",
    attrs: {
      type: "button",
      "data-card-widget": "collapse"
    }
  }, [_c("i", {
    staticClass: "fas fa-minus"
  })])])]);
}];
render._withStripped = true;


/***/ }),

/***/ "./resources/js/backend/components/TaskManager/configStatus.js":
/*!*********************************************************************!*\
  !*** ./resources/js/backend/components/TaskManager/configStatus.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   listStatus: () => (/* binding */ listStatus)
/* harmony export */ });
var listStatus = [{
  value: 1,
  title: 'Việc mới tạo',
  type: ''
}, {
  value: 2,
  title: 'Đã nhận việc',
  type: 'info'
}, {
  value: 3,
  title: 'Đang xử lý',
  type: 'warning'
}, {
  value: 4,
  title: 'Gặp khó khăn',
  type: 'danger'
}, {
  value: 5,
  title: 'Hoàn thànhbhvjgj',
  type: 'success'
}];
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  listStatus: listStatus
});

/***/ }),

/***/ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css&":
/*!***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css& ***!
  \***************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../../../node_modules/css-loader/dist/runtime/api.js */ "./node_modules/css-loader/dist/runtime/api.js");
/* harmony import */ var _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0__);
// Imports

var ___CSS_LOADER_EXPORT___ = _node_modules_css_loader_dist_runtime_api_js__WEBPACK_IMPORTED_MODULE_0___default()(function(i){return i[1]});
// Module
___CSS_LOADER_EXPORT___.push([module.id, ".el-table .warning-row {\n  background: oldlace;\n}\n.el-table .success-row {\n  background: #f0f9eb;\n}\n.color-item{\n  height: 20px;\n  width: 40px;\n  border-radius: 6px;\n}\r\n", ""]);
// Exports
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (___CSS_LOADER_EXPORT___);


/***/ }),

/***/ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! !../../../../../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js");
/* harmony import */ var _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_style_index_0_id_3ca8a356_lang_css___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! !!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./list.vue?vue&type=style&index=0&id=3ca8a356&lang=css& */ "./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css&");

            

var options = {};

options.insert = "head";
options.singleton = false;

var update = _node_modules_style_loader_dist_runtime_injectStylesIntoStyleTag_js__WEBPACK_IMPORTED_MODULE_0___default()(_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_style_index_0_id_3ca8a356_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"], options);



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_style_index_0_id_3ca8a356_lang_css___WEBPACK_IMPORTED_MODULE_1__["default"].locals || {});

/***/ }),

/***/ "./resources/js/backend/components/TaskManager/list.vue":
/*!**************************************************************!*\
  !*** ./resources/js/backend/components/TaskManager/list.vue ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _list_vue_vue_type_template_id_3ca8a356___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./list.vue?vue&type=template&id=3ca8a356& */ "./resources/js/backend/components/TaskManager/list.vue?vue&type=template&id=3ca8a356&");
/* harmony import */ var _list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./list.vue?vue&type=script&lang=js& */ "./resources/js/backend/components/TaskManager/list.vue?vue&type=script&lang=js&");
/* harmony import */ var _list_vue_vue_type_style_index_0_id_3ca8a356_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./list.vue?vue&type=style&index=0&id=3ca8a356&lang=css& */ "./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");



;


/* normalize component */

var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _list_vue_vue_type_template_id_3ca8a356___WEBPACK_IMPORTED_MODULE_0__.render,
  _list_vue_vue_type_template_id_3ca8a356___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/backend/components/TaskManager/list.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/backend/components/TaskManager/list.vue?vue&type=script&lang=js&":
/*!***************************************************************************************!*\
  !*** ./resources/js/backend/components/TaskManager/list.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./list.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/backend/components/TaskManager/list.vue?vue&type=template&id=3ca8a356&":
/*!*********************************************************************************************!*\
  !*** ./resources/js/backend/components/TaskManager/list.vue?vue&type=template&id=3ca8a356& ***!
  \*********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_template_id_3ca8a356___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   staticRenderFns: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_template_id_3ca8a356___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_lib_loaders_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_template_id_3ca8a356___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./list.vue?vue&type=template&id=3ca8a356& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/lib/loaders/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=template&id=3ca8a356&");


/***/ }),

/***/ "./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css&":
/*!***********************************************************************************************************!*\
  !*** ./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css& ***!
  \***********************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_dist_cjs_js_node_modules_css_loader_dist_cjs_js_clonedRuleSet_9_use_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_dist_cjs_js_clonedRuleSet_9_use_2_node_modules_vue_loader_lib_index_js_vue_loader_options_list_vue_vue_type_style_index_0_id_3ca8a356_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/style-loader/dist/cjs.js!../../../../../node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!../../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../../node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./list.vue?vue&type=style&index=0&id=3ca8a356&lang=css& */ "./node_modules/style-loader/dist/cjs.js!./node_modules/css-loader/dist/cjs.js??clonedRuleSet-9.use[1]!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/dist/cjs.js??clonedRuleSet-9.use[2]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/backend/components/TaskManager/list.vue?vue&type=style&index=0&id=3ca8a356&lang=css&");


/***/ })

}]);