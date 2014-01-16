define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/on",
    "hcb-blog/posts/manage/widget/Form",
    "hcb-blog/posts/manage/widget/Tab"
], function(declare, lang, on, Form, Tab) {
    
    return declare([ Tab ], {
        _load: function () {
            try {
                if (this.store && this.lang) {
                    var result = this.store.get(this.lang);

                    if (result.then) {
                        result.then(lang.hitch(this, function (item){
                            this._form.attr('value', item);
                        }), function (err) {
                            console.error("Error in asynchronous call", err, arguments);
                        })
                    } else {
                        this._form.attr('value', result);
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
                }
                this._load();
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
