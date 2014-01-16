define([
    "dojo/_base/declare",
    "dojo/_base/array",
    "dojo/_base/lang",
    "hcb-blog/posts/manage/LangContainer",
    "dojo-common/store/JsonRest",
    "dojo/store/Cache",
    "dojo/store/Memory",
    "hc-backend/router",
    "./widget/Tab",
    "hc-backend/config"
], function(declare, array, lang, LangContainer, JsonRest, Cache,
            Memory, router, Tab, config) {
    return declare([ LangContainer ], {
        tabWidget: Tab,

        _setIdentifierAttr: function (identifier) {
            try {
                var collectionUrl = router.assemble(config.get('primaryRoute')+'/blog/posts/:postsId/data',
                                                    {postsId: identifier});

                this.saveService.set('identifier', identifier);
                var _store = this.saveService.get('polyglotStore');

                _store.query().forEach(lang.hitch(this, function (item) {
                    try {
                        array.some(this.getChildren(), function (child) {
                            try {
                                if (child.get('lang') == item.lang) {
                                    console.log("Found form for language >>", item.lang, _store.get(item.lang));
                                    child.set('store', _store);
                                    return true;
                                }
                            } catch (e) {
                                console.error(this.declaredClass, arguments, e);
                                throw e;
                            }
                        });
                    } catch (e) {
                        console.error(this.declaredClass, arguments, e);
                        throw e;
                    }
                }));

                this.inherited(arguments);
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
