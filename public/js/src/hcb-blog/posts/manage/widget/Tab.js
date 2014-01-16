define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/on",
    "hcb-blog/posts/manage/widget/Form",
    "hc-backend/layout/ContentPane",
    "dojo/dom-class"
], function(declare, lang, on, Form,
            ContentPane, domClass) {

    return declare([ ContentPane ], {

        form: null,
        saveService: null,
        lang: '',

        onShow: function () {
            try {
                if (!this.form) {
                    this.init();
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        _setValueAttr: function (value) {
            try {
                if (!this.form) {
                    var _watcher = this.watch('form', function (){
                        _watcher.unwatch();
                        this.form.set('value', value);
                    });
                } else {
                    this.form.set('value', value);
                }
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        init: function () {
            try {
                this.set('form', new Form());

                var domNode = this.form.domNode;

                this.form.set('value', {lang: this.lang});

                this.form.on('ready', function (){
                    domClass.remove(domNode, 'dijitHidden');
                });

                this.form.on('save', lang.hitch(this, function (data){
                    try {
                        if (!this.saveService) {
                            throw "Save service undefined";
                        }

                        this.saveService.save(data)
                            .then(function () {
                                try {
                                    // TODO:
                                    //  Do something after create initated.
                                } catch (e) {
                                    console.error("Asynchronous call exception", arguments, e);
                                    throw e;
                                }
                            }, function (err) {
                                console.error("Error in asynchronous call", err, arguments);
                            }).always(lang.hitch(this, function (){
                                this.form.saveButtonWidget.cancel();
                            }));
                    } catch (e) {
                         console.error(this.declaredClass, arguments, e);
                         throw e;
                    }
                }));

                this.attr('content', domNode);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
