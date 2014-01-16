define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dojo/Deferred",
    "hc-backend/router",
    "hc-backend/config",
    "dojo/request",
    "dojo-common/store/JsonRest",
    "dojo/store/Cache",
    "dojo/store/Memory",
    "dojo/json",
    "dojo/Stateful",
    "dojo/Evented",
    "dojo-common/response/_DataMixin",
    "dojo-common/response/_StatusMixin",
    "dojo-common/response/_MessageMixin"
], function(declare, lang, Deferred,
            router, config, request, JsonRest, Cache, Memory,
            JSON, Stateful, Evented,
            _DataMixin, _StatusMixin, _MessageMixin) {
    return declare([Stateful, Evented], {

            polyglotCollectionPath: '/polyglot',
            polyglotCollectionId: 'lang',

            polyglotCollectionStore: null,
            polyglotStore: null,

            constructor: function (args) {
                try {
                   lang.mixin(this, args);
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            },

            _identifierSetter: function (identifier) {
                try {
                    var target = this.polyglotCollectionStore
                                     .getTarget(identifier)+this.polyglotCollectionPath;

                    this.polyglotStore = Cache(JsonRest({target: target,
                                                         idProperty: this.polyglotCollectionId}),
                                               Memory({idProperty: this.polyglotCollectionId}));
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            },

            _initPolyglotStore: function () {
                try {
                    var def = new Deferred();
                    var _self = this;
                    this.polyglotCollectionStore.put({}).then(function (resp) {
                        try {
                            var response = new declare([_DataMixin, _StatusMixin, _MessageMixin])(resp);
                            response.optional('message');

                            if (response.isError()) {
                                return def.reject(response.getMessage());
                            }

                            var dataResult = response.getData();
                            if (!dataResult || !dataResult.id) {
                                return def.reject("Server does not return identifier of created entry");
                            }
                            _self.set('identifier', dataResult.id);
                            def.resolve();
                        } catch (e) {
                            console.error(_self.declaredClass, arguments, e);
                            throw e;
                        }
                    }, function (err) {
                        def.reject(err);
                        console.error("Error in asynchronous call", err, arguments);
                    });

                    return def;
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            },

            save: function (data, langId) {
                try {
                    var def = new Deferred();

                    data = lang.mixin(data, {'lang': langId});

                    var storeData = lang.hitch(this, function (data) {
                        this._storeData(data).then(function (resp){
                            def.resolve(resp);
                        }, function (err) {
                            def.reject(err);
                            console.error("Error in asynchronous call", err, arguments);
                        });
                        return def;
                    });

                    if (this.polyglotStore === null) {
                        this._initPolyglotStore().then(lang.hitch(this, function () {
                            try {
                                storeData(data).then(lang.hitch(this, function (){
                                    this.emit('itemCreated', {'data': data});
                                }));
                            } catch (e) {
                                 console.error(this.declaredClass, arguments, e);
                                 throw e;
                            }
                        }), function (err) {
                            def.reject(err);
                            console.error("Error in asynchronous call", err, arguments);
                        })
                    } else {
                        console.log("!!!PolyglotStore already defined!!!");
                        storeData(data).then(lang.hitch(this, function (){
                            this.emit('itemUpdated', {'data': data});
                        }));
                    }

                    return def;
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            },

            _storeData: function (data) {
                try {
                     /**
                      * Store data to the server, it is will be stored with PUT method
                      * always, till we have polyglotIdentifier inside data
                      **/
                      return this.polyglotStore.put(data);
                } catch (e) {
                     console.error(this.declaredClass, arguments, e);
                     throw e;
                }
            }
    });
});
