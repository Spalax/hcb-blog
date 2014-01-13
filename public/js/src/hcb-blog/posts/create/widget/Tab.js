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

        _form: null,
        createService: null,
        lang: '',
        title: '',

        onShow: function () {
            try {
                if (!this._form) {
                    this.init();
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        init: function () {
            try {
                this._form = new Form();
                var domNode = this._form.domNode;

                alert("Form created");

                this._form.on('ready', function (){
                    domClass.remove(domNode, 'dijitHidden');
                });

                this._form.on('save', lang.hitch(this, function (data){
                    try {
                        if (!this.createService) {
                            throw "Creator service undefined";
                        }

                        this.createService.create(data, this.lang)
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
                                alert("ALWAYS");
                                this._form.saveButtonWidget.cancel();
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
