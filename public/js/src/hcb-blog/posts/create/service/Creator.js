define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/Deferred",
    "hcb-blog/store/Posts",
    "hc-backend/router",
    "hc-backend/config",
    "dojo/request",
    "dojo/json",
    "dojo-common/response/_DataMixin",
    "dojo-common/response/_StatusMixin",
    "dojo-common/response/_MessageMixin"
], function(declare, lang, Deferred, PostsStore,
            router, config, request, JSON, _DataMixin, _StatusMixin, _MessageMixin) {
    return declare(null, {

            identifier: null,

            _createIdentifier: function () {
                try {
                    var def = new Deferred();

                    PostsStore.put({}).then(lang.hitch(this, function (resp) {
                        try {
                            alert("HERER");

                            var response = new declare([_DataMixin, _StatusMixin, _MessageMixin])(resp);
                            response.optional('message');

                            if (response.isError()) {
                                return def.reject(response.getMessage());
                            }

                            var dataResult = response.getData();
                            if (!dataResult || !dataResult.id) {
                                return def.reject("Server does not return identifier of created entry");
                            }

                            this.identifier = dataResult.id;
                            alert("Resolve now "+this.identifier);
                            def.resolve(this.identifier);
                        } catch (e) {
                            console.error(this.declaredClass, arguments, e);
                            throw e;
                        }
                    }), function (err) {
                        def.reject(err);
                        console.error("Error in asynchronous call", err, arguments);
                    });

                    return def;
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            },

            create: function (data, langId) {
                try {
                    var def = new Deferred();

                    data = lang.mixin(data, {'lang': langId});

                    var storeData = lang.hitch(this, function (data, identifier) {
                        this._storeData(data, identifier).then(function (resp){
                            def.resolve(resp);
                        }, function (err) {
                            def.reject(err);
                            console.error("Error in asynchronous call", err, arguments);
                        });
                    });

                    if (!this.identifier) {
                        this._createIdentifier().then(lang.hitch(this, function (identifier) {
                            try {
                                alert("Resolved with identifier "+identifier);
                                storeData(data, identifier);
                            } catch (e) {
                                 console.error(this.declaredClass, arguments, e);
                                 throw e;
                            }
                        }), function (err) {
                            def.reject(err);
                            console.error("Error in asynchronous call", err, arguments);
                        })
                    } else {
                        alert("Identifier already defined "+this.identifier);
                        storeData(data, this.identifier);
                    }

                    return def;
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            },

            _storeData: function (data, identifier) {
                try {
                    var url = router.assemble("/superman/blog/posts/:id/:lang",
                                              {'id': identifier, 'lang': 'ru'});

                    alert(JSON.stringify(data));
                    return request.put(url, {data: JSON.stringify(data),
                                             handleAs: "json",
                                             headers: {
                                               "Content-Type": "application/json"
                                             }});
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            }
    });
});
