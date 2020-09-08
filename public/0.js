(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Album.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var vuex__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vuex */ "./node_modules/vuex/dist/vuex.esm.js");
/* harmony import */ var vuedraggable__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vuedraggable */ "./node_modules/vuedraggable/dist/vuedraggable.common.js");
/* harmony import */ var vuedraggable__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(vuedraggable__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _helpers__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../helpers */ "./resources/js/helpers/index.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

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



/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Album",
  components: {
    draggable: vuedraggable__WEBPACK_IMPORTED_MODULE_2___default.a
  },
  data: function data() {
    return {
      updatedPictureId: -1
    };
  },
  props: ["id"],
  methods: _objectSpread(_objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapActions"])(["fetchAlbum", "updateAlbum", "destroyAlbum", "storePicture", "updatePicture", "updateOrderNumber", "destroyPicture", "startLoading", "doneLoading"])), {}, {
    showEditModal: function showEditModal(pictureId) {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var title, imgLink, _yield$_this$$swal, picture;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                title = document.getElementById("picture-title-" + pictureId).innerHTML;
                imgLink = document.getElementById("picture-imgLink-" + pictureId).innerHTML;
                _context.next = 4;
                return _this.$swal({
                  html: '<div class="form-group">' + '<input id="swal-input1" class="form-control" placeholder="Title" value="' + title + '">' + "</div>" + '<div class="">' + '<input id="swal-input2" class="form-control" placeholder="Image link" value="' + imgLink + '">' + "</div>",
                  focusConfirm: false,
                  allowOutsideClick: false,
                  showCancelButton: true,
                  preConfirm: function preConfirm() {
                    return {
                      id: pictureId,
                      title: document.getElementById("swal-input1").value,
                      imgLink: document.getElementById("swal-input2").value
                    };
                  }
                });

              case 4:
                _yield$_this$$swal = _context.sent;
                picture = _yield$_this$$swal.value;

                if (!picture) {
                  _context.next = 13;
                  break;
                }

                _this.startLoading();

                _context.next = 10;
                return _this.updatePicture(picture);

              case 10:
                _this.updatedPictureId = picture.id;

                _this.doneLoading();

                setTimeout(function () {
                  this.updatedPictureId = -1;
                }, 2000);

              case 13:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    showAlbumEditModal: function showAlbumEditModal() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        var title, imgLink, _yield$_this2$$swal, album;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                title = _this2.album.title;
                imgLink = _this2.album.coverImgLink;
                _context2.next = 4;
                return _this2.$swal({
                  html: '<div class="form-group">' + '<input id="swal-input1" class="form-control" placeholder="Title" value="' + title + '">' + "</div>" + '<div class="">' + '<input id="swal-input2" class="form-control" placeholder="Cover image link" value="' + imgLink + '">' + "</div>",
                  focusConfirm: false,
                  allowOutsideClick: false,
                  showCancelButton: true,
                  preConfirm: function preConfirm() {
                    return {
                      id: _this2.album.id,
                      title: document.getElementById("swal-input1").value,
                      coverImgLink: document.getElementById("swal-input2").value
                    };
                  }
                });

              case 4:
                _yield$_this2$$swal = _context2.sent;
                album = _yield$_this2$$swal.value;

                _this2.updateAlbum(album);

              case 7:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    deleteAlbum: function deleteAlbum() {
      var _this3 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _this3.$swal({
                  title: "Delete this album and all images below?",
                  text: "You won't be able to revert this!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Yes, delete it!"
                }).then(function (result) {
                  if (result.value) {
                    _this3.destroyAlbum(_this3.album.id);
                  }
                });

              case 1:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3);
      }))();
    },
    addPicture: function addPicture() {
      var _this4 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee4() {
        var title, imgLink, picture;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee4$(_context4) {
          while (1) {
            switch (_context4.prev = _context4.next) {
              case 0:
                title = document.getElementById("picture-title").value;
                imgLink = document.getElementById("picture-imgLink").value;

                if (!(title && imgLink)) {
                  _context4.next = 14;
                  break;
                }

                picture = {
                  title: title,
                  imgLink: imgLink,
                  orderNumber: _this4.album.pictures_count,
                  album_id: _this4.album.id
                };

                _this4.startLoading();

                _context4.next = 7;
                return _this4.storePicture(picture);

              case 7:
                document.getElementById("picture-title").value = "";
                document.getElementById("picture-imgLink").value = "";
                _this4.updatedPictureId = picture.id;

                _this4.doneLoading();

                setTimeout(function () {
                  this.updatedPictureId = -1;
                }, 2000);
                _context4.next = 15;
                break;

              case 14:
                Object(_helpers__WEBPACK_IMPORTED_MODULE_3__["toast"])("error", "Title and image link cannot be empty");

              case 15:
              case "end":
                return _context4.stop();
            }
          }
        }, _callee4);
      }))();
    },
    deletePicture: function deletePicture(pictureId) {
      var _this5 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee5() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee5$(_context5) {
          while (1) {
            switch (_context5.prev = _context5.next) {
              case 0:
                _this5.$swal({
                  title: "Are you sure?",
                  text: "You won't be able to revert this!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "Yes, delete it!"
                }).then(function (result) {
                  if (result.value) {
                    _this5.destroyPicture(pictureId);
                  }
                });

              case 1:
              case "end":
                return _context5.stop();
            }
          }
        }, _callee5);
      }))();
    },
    updateOrder: function updateOrder(evt) {
      // if oldIndex === newIndex => do nothing
      if (evt.oldIndex !== evt.newIndex) {
        // passing object to store
        this.updateOrderNumber({
          id: this.album.id,
          oldIndex: evt.oldIndex,
          newIndex: evt.newIndex
        });
      }
    }
  }),
  computed: _objectSpread({}, Object(vuex__WEBPACK_IMPORTED_MODULE_1__["mapGetters"])({
    album: "getAlbum",
    isLoading: "getIsLoadding"
  })),
  created: function created() {
    this.fetchAlbum(this.id);
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.faded-in[data-v-ef645540] {\n  -webkit-animation-name: faded-in-data-v-ef645540;\n          animation-name: faded-in-data-v-ef645540;\n  -webkit-animation-duration: 1.5s;\n          animation-duration: 1.5s;\n}\n@-webkit-keyframes faded-in-data-v-ef645540 {\nfrom {\n    background-color: #eeeeee;\n}\nto {\n    background-color: #fafafa;\n}\n}\n@keyframes faded-in-data-v-ef645540 {\nfrom {\n    background-color: #eeeeee;\n}\nto {\n    background-color: #fafafa;\n}\n}\nimg[data-v-ef645540] {\n  width: 100px;\n  height: 100px;\n  -o-object-fit: cover;\n     object-fit: cover;\n}\ntbody tr[data-v-ef645540] {\n  cursor: move;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=template&id=ef645540&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/Album.vue?vue&type=template&id=ef645540&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "a",
      { staticClass: "btn btn-primary mb-3", attrs: { href: "/" } },
      [
        _c("font-awesome-icon", { attrs: { icon: "backward" } }),
        _vm._v(" Go back\n  ")
      ],
      1
    ),
    _vm._v(" "),
    _c(
      "button",
      {
        staticClass: "btn btn-danger mb-3 float-right",
        on: { click: _vm.deleteAlbum }
      },
      [
        _c("font-awesome-icon", { attrs: { icon: "trash" } }),
        _vm._v(" Delete\n  ")
      ],
      1
    ),
    _vm._v(" "),
    _c("div", { staticClass: "card" }, [
      _c("div", { staticClass: "card-header" }, [
        _c("div", { staticClass: "d-flex align-items-center" }, [
          _c("img", {
            staticClass: "mr-3 rounded",
            attrs: { src: _vm.album.coverImgLink }
          }),
          _vm._v(" "),
          _c("div", { staticClass: "lh-100" }, [
            _c("h2", { attrs: { id: "album-title", "data-field": "title" } }, [
              _vm._v(
                "\n            " + _vm._s(_vm.album.title) + "\n            "
              ),
              _c(
                "button",
                {
                  staticClass: "btn btn-light btn-sm",
                  attrs: { title: "Edit" },
                  on: { click: _vm.showAlbumEditModal }
                },
                [_c("font-awesome-icon", { attrs: { icon: "edit" } })],
                1
              )
            ]),
            _vm._v(" "),
            _c("small", [
              _vm._v(_vm._s(_vm.album.pictures_count) + " pictures")
            ])
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-header" }, [
        _c("div", { staticClass: "row" }, [
          _vm._m(0),
          _vm._v(" "),
          _vm._m(1),
          _vm._v(" "),
          _c("div", { staticClass: "col-1" }, [
            _c("input", {
              staticClass: "btn btn-success w-100 font-weight-bold",
              attrs: { type: "button", title: "Add", value: "Add" },
              on: { click: _vm.addPicture }
            })
          ])
        ])
      ]),
      _vm._v(" "),
      _c("div", { staticClass: "card-body table-responsive" }, [
        _c(
          "table",
          { staticClass: "table table-bordered table-hover table-sm" },
          [
            _vm._m(2),
            _vm._v(" "),
            _c(
              "draggable",
              {
                attrs: { tag: "tbody", animation: "200" },
                on: { end: _vm.updateOrder },
                model: {
                  value: _vm.album.pictures,
                  callback: function($$v) {
                    _vm.$set(_vm.album, "pictures", $$v)
                  },
                  expression: "album.pictures"
                }
              },
              _vm._l(_vm.album.pictures, function(picture, indexKey) {
                return _c(
                  "tr",
                  {
                    key: picture.id,
                    class: {
                      "faded-in":
                        !_vm.isLoading && picture.id === _vm.updatedPictureId
                    }
                  },
                  [
                    _c(
                      "th",
                      { staticClass: "align-middle", attrs: { scope: "row" } },
                      [_vm._v(_vm._s(indexKey + 1))]
                    ),
                    _vm._v(" "),
                    _c("td", { staticClass: "align-middle content" }, [
                      _c("img", {
                        staticClass: "rounded",
                        attrs: { src: picture.imgLink }
                      })
                    ]),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        staticClass: "align-middle content",
                        attrs: { id: "picture-title-" + picture.id }
                      },
                      [_vm._v(_vm._s(picture.title))]
                    ),
                    _vm._v(" "),
                    _c(
                      "td",
                      {
                        staticClass: "align-middle content",
                        attrs: { id: "picture-imgLink-" + picture.id }
                      },
                      [_vm._v(_vm._s(picture.imgLink))]
                    ),
                    _vm._v(" "),
                    _c("td", { staticClass: "align-middle content" }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-primary w-100",
                          attrs: { title: "Edit" },
                          on: {
                            click: function($event) {
                              return _vm.showEditModal(picture.id)
                            }
                          }
                        },
                        [_c("font-awesome-icon", { attrs: { icon: "edit" } })],
                        1
                      )
                    ]),
                    _vm._v(" "),
                    _c("td", { staticClass: "align-middle content" }, [
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-danger w-100",
                          attrs: { title: "Delete" },
                          on: {
                            click: function($event) {
                              return _vm.deletePicture(picture.id)
                            }
                          }
                        },
                        [_c("font-awesome-icon", { attrs: { icon: "trash" } })],
                        1
                      )
                    ])
                  ]
                )
              }),
              0
            )
          ],
          1
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-4" }, [
      _c("input", {
        staticClass: "form-control",
        attrs: { id: "picture-title", type: "text", placeholder: "Title" }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-7" }, [
      _c("input", {
        staticClass: "form-control",
        attrs: {
          id: "picture-imgLink",
          type: "text",
          placeholder: "Image link"
        }
      })
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("#")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Image")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Title")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Image Link")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } })
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/Album.vue":
/*!**************************************!*\
  !*** ./resources/js/views/Album.vue ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Album_vue_vue_type_template_id_ef645540_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Album.vue?vue&type=template&id=ef645540&scoped=true& */ "./resources/js/views/Album.vue?vue&type=template&id=ef645540&scoped=true&");
/* harmony import */ var _Album_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Album.vue?vue&type=script&lang=js& */ "./resources/js/views/Album.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css& */ "./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Album_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Album_vue_vue_type_template_id_ef645540_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Album_vue_vue_type_template_id_ef645540_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "ef645540",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/Album.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/Album.vue?vue&type=script&lang=js&":
/*!***************************************************************!*\
  !*** ./resources/js/views/Album.vue?vue&type=script&lang=js& ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Album.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css&":
/*!***********************************************************************************************!*\
  !*** ./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css& ***!
  \***********************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=style&index=0&id=ef645540&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_style_index_0_id_ef645540_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/views/Album.vue?vue&type=template&id=ef645540&scoped=true&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/Album.vue?vue&type=template&id=ef645540&scoped=true& ***!
  \*********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_template_id_ef645540_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Album.vue?vue&type=template&id=ef645540&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/Album.vue?vue&type=template&id=ef645540&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_template_id_ef645540_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Album_vue_vue_type_template_id_ef645540_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);