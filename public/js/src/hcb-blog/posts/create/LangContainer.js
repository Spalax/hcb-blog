define([
    "dojo/_base/declare",
    "hcb-blog/posts/manage/LangContainer",
    "./widget/Tab",
    "./service/Creator"
], function(declare, LangContainer, Tab, CreatorService) {
    return declare([ LangContainer ], {
        tabWidget: Tab,

        postCreate: function () {
            try {
                this.createService = new CreatorService();
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        getChildForLang: function (langIdentifier, langTitle) {
            try {
                return new this.tabWidget({title: langTitle || langIdentifier,
                                           lang: langIdentifier,
                                           createService: this.createService});
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
