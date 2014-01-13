define([
    "dojo/_base/declare",
    "hc-backend/layout/main/content/_LangContainerMixin"
], function(declare, _LangContainerMixin) {

    return declare([ _LangContainerMixin ], {

        tabWidget: null,

        getChildForLang: function (langIdentifier, langTitle) {
            try {
                return new this.tabWidget({title: langTitle || langIdentifier,
                                           lang: langIdentifier});
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
