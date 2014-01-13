define([
    "dojo/_base/declare",
    "dojo/_base/array",
    "hcb-blog/posts/manage/LangContainer",
    "dojo-common/store/JsonRest",
    "hc-backend/router",
    "./widget/Tab",
    "hc-backend/config"
], function(declare, array, LangContainer, JsonRest, router, Tab, config) {
    return declare([ LangContainer ], {
        tabWidget: Tab,

        _setIdentifierAttr: function (identifier) {
            try {
                var collectionUrl = router.assemble(config.get('primaryRoute')+'/blog/posts/:postsId/data',
                                                    {postsId: identifier});
                var individualRoute = collectionUrl+'/:dataId';

                var _store = new JsonRest({target: collectionUrl});
                alert("HER");
                _store.query().forEach(function (item) {
                    try {
                        alert(12);
                        var store = new JsonRest({target: router.assemble(individualRoute, {dataId: item.id})});
                        array.some(this.getChildren(), function (child) {
                            try {
                                alert(13);
                                if (child.get('lang') == item.lang) {
                                    alert(14);
                                    child.attr('store', store);
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
                });

                this.inherited(arguments);
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
