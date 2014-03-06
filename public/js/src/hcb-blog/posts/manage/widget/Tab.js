define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/on",
    "dojo/aspect",
    "hcb-blog/posts/manage/widget/Form",
    "hc-backend/layout/ContentPaneHash",
    "dojo/dom-class",
    "underscore"
], function(declare, lang, on, aspect, Form,
            ContentPane, domClass, u) {

    return declare([ ContentPane ], {

        form: null,
        saveService: null,
        lang: '',

        load: function () {
            try {
                var _store = this.saveService.get('polyglotStore');
                var _res = _store.query({lang: this.lang});

                _res.then(lang.hitch(this, function (res){
                    u.each(u.values(res), function (item){
                        console.log("Found form for language >>",
                            this.lang, item);
                        this.set('value', item);
                    }, this);
                }), function (err) {
                  console.error("Error in asynchronous call", err, arguments);
                })
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        onShow: function () {
            try {
                if (!this.form) {
                    this.init();
                }

                if (!this.identifier) {
                    var watch = this.watch('identifier', function (){
                        watch.unwatch();
                        this.load();
                    })
                } else {
                    this.load();
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        getHash: function () {
            try {
                if (this.identifier) {
                    return this.router.assemble({id: this.identifier, lang: this.lang}, '/:lang');
                } else {
                    return this.router.assemble({lang: this.lang}, '/:lang');
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

        _setFormAttr: function (form) {
            try {
                this.form = form;
                this.own(this.form);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        destroy: function () {
            try {
                this.inherited(arguments);
                console.log("Tab lang destroyed", this.lang);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        init: function () {
            try {
                this.set('form', new Form());

                var domNode = this.form.domNode;

                this.form.set('lang', this.lang);
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
                                    //  Do something after create initiated.
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

                this.addChild(this.form);
//                this.attr('content', domNode);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
