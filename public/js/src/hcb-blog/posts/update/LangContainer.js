define([
    "dojo/_base/declare",
    "dojo/_base/array",
    "dojo/_base/lang",
    "hcb-blog/posts/manage/LangContainer",
    "dojo-common/store/JsonRest",
    "dojo/store/Cache",
    "dojo/store/Memory",
    "hc-backend/router",
    "dojo/Stateful",
    "hcb-blog/posts/manage/widget/Tab"
], function(declare, array, lang, LangContainer, JsonRest, Cache,
            Memory, router, Stateful, Tab) {
    return declare([ LangContainer ], {
        tabWidget: Tab,

        _setIdentifierAttr: function (identifier) {
            try {
                this.saveService.set('identifier', identifier);

                array.forEach(this.getChildren(), function (child) {
                    child.set('identifier', identifier);
                });
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
