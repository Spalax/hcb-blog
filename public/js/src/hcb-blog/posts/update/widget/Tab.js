define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/on",
    "hcb-blog/posts/manage/widget/Form",
    "hc-backend/layout/ContentPane",
    "dojo/dom-class"
], function(declare, lang, on, Form, ContentPane, domClass) {
    
    return declare([ ContentPane ], {

        _form: null,

        _load: function () {
            try {
                if (this.store && this.lang) {
                    var result = this.store.get(this.lang);
                    if (result.then) {
                        result.then(lang.hitch(this, function (item) {
                           this._form.attr('value', item);
                        }));
                    }
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        _setStoreAttr: function (store) {
            try {
                this.store = store;

                if (this._form) {
                    this._load();
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        onShow: function () {
            try {
                if (!this._form) {
                    this.init();
                    this._load();
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        init: function (item) {
            try {
                this._form = new Form({value: item || {}});
                var domNode = this._form.domNode;

                this._form.on('ready', function (){
                    domClass.remove(domNode, 'dijitHidden');
                });

                this.attr('content', domNode);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
