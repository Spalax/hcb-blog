define([
    "dojo/_base/declare",
    "./service/Saver",
    "hcb-blog/store/Posts",
    "hc-backend/layout/main/content/_LangContainerMixin"
], function(declare, SaverService, PostsStore, _LangContainerMixin) {

    return declare([ _LangContainerMixin ], {

        tabWidget: null,
        saveService: null,

        postCreate: function () {
            try {
                this.saveService = new SaverService({polyglotCollectionStore: PostsStore});
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
                                           saveService: this.saveService});
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
