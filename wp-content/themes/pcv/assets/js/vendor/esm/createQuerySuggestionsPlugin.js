function ownKeys(object, enumerableOnly) {
    var keys = Object.keys(object);
    if (Object.getOwnPropertySymbols) {
        var symbols = Object.getOwnPropertySymbols(object);
        enumerableOnly && (symbols = symbols.filter(function (sym) {
            return Object.getOwnPropertyDescriptor(object, sym).enumerable;
        })), keys.push.apply(keys, symbols);
    }
    return keys;
}

function _objectSpread(target) {
    for (var i = 1; i < arguments.length; i++) {
        var source = null != arguments[i] ? arguments[i] : {};
        i % 2 ? ownKeys(Object(source), !0).forEach(function (key) {
            _defineProperty(target, key, source[key]);
        }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) {
            Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
        });
    }
    return target;
}

function _defineProperty(obj, key, value) {
    if (key in obj) {
        Object.defineProperty(obj, key, {value: value, enumerable: true, configurable: true, writable: true});
    } else {
        obj[key] = value;
    }
    return obj;
}

function _createForOfIteratorHelper(o, allowArrayLike) {
    var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"];
    if (!it) {
        if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
            if (it) o = it;
            var i = 0;
            var F = function F() {
            };
            return {
                s: F, n: function n() {
                    if (i >= o.length) return {done: true};
                    return {done: false, value: o[i++]};
                }, e: function e(_e) {
                    throw _e;
                }, f: F
            };
        }
        throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
    }
    var normalCompletion = true, didErr = false, err;
    return {
        s: function s() {
            it = it.call(o);
        }, n: function n() {
            var step = it.next();
            normalCompletion = step.done;
            return step;
        }, e: function e(_e2) {
            didErr = true;
            err = _e2;
        }, f: function f() {
            try {
                if (!normalCompletion && it.return != null) it.return();
            } finally {
                if (didErr) throw err;
            }
        }
    };
}

function _unsupportedIterableToArray(o, minLen) {
    if (!o) return;
    if (typeof o === "string") return _arrayLikeToArray(o, minLen);
    var n = Object.prototype.toString.call(o).slice(8, -1);
    if (n === "Object" && o.constructor) n = o.constructor.name;
    if (n === "Map" || n === "Set") return Array.from(o);
    if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}

function _arrayLikeToArray(arr, len) {
    if (len == null || len > arr.length) len = arr.length;
    for (var i = 0, arr2 = new Array(len); i < len; i++) {
        arr2[i] = arr[i];
    }
    return arr2;
}

import {getAlgoliaResults} from '@algolia/autocomplete-js';
import {getAttributeValueByPath} from '@algolia/autocomplete-shared';
import {getTemplates} from './getTemplates';

export function createQuerySuggestionsPlugin(options) {
    var _getOptions = getOptions(options),
        searchClient = _getOptions.searchClient,
        indexName = _getOptions.indexName,
        getSearchParams = _getOptions.getSearchParams,
        transformSource = _getOptions.transformSource,
        categoryAttribute = _getOptions.categoryAttribute,
        itemsWithCategories = _getOptions.itemsWithCategories,
        categoriesPerItem = _getOptions.categoriesPerItem;

    return {
        name: 'aa.querySuggestionsPlugin',
        getSources: function getSources(_ref) {
            var query = _ref.query,
                setQuery = _ref.setQuery,
                refresh = _ref.refresh,
                state = _ref.state;

            function onTapAhead(item) {
                setQuery("".concat(item.query, " "));
                refresh();
            }

            return [transformSource({
                source: {
                    sourceId: 'querySuggestionsPlugin',
                    getItemInputValue: function getItemInputValue(_ref2) {
                        var item = _ref2.item;
                        return item.query;
                    },
                    getItems: function getItems() {
                        return getAlgoliaResults({
                            searchClient: searchClient,
                            queries: [{
                                indexName: indexName,
                                query: query,
                                params: getSearchParams({
                                    state: state
                                })
                            }],
                            transformResponse: function transformResponse(_ref3) {
                                var hits = _ref3.hits;
                                var querySuggestionsHits = hits[0];

                                if (!query || !categoryAttribute) {
                                    return querySuggestionsHits;
                                }

                                return querySuggestionsHits.reduce(function (acc, current, i) {
                                    var items = [current];

                                    if (i <= itemsWithCategories - 1) {
                                        var categories = getAttributeValueByPath(current, Array.isArray(categoryAttribute) ? categoryAttribute : [categoryAttribute]).map(function (x) {
                                            return x.value;
                                        }).slice(0, categoriesPerItem);

                                        var _iterator = _createForOfIteratorHelper(categories),
                                            _step;

                                        try {
                                            for (_iterator.s(); !(_step = _iterator.n()).done;) {
                                                var category = _step.value;
                                                items.push(_objectSpread({
                                                    __autocomplete_qsCategory: category
                                                }, current));
                                            }
                                        } catch (err) {
                                            _iterator.e(err);
                                        } finally {
                                            _iterator.f();
                                        }
                                    }

                                    acc.push.apply(acc, items);
                                    return acc;
                                }, []);
                            }
                        });
                    },
                    templates: getTemplates({
                        onTapAhead: onTapAhead
                    })
                },
                onTapAhead: onTapAhead,
                state: state
            })];
        },
        __autocomplete_pluginOptions: options
    };
}

function getOptions(options) {
    return _objectSpread({
        getSearchParams: function getSearchParams() {
            return {};
        },
        transformSource: function transformSource(_ref4) {
            var source = _ref4.source;
            return source;
        },
        itemsWithCategories: 1,
        categoriesPerItem: 1
    }, options);
}