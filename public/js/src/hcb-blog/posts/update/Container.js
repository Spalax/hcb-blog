define([
    "dojo/_base/declare",
    "hcb-blog/posts/manage/Container",
    "./LangContainer"
], function(declare, Container, LangContainer) {
    return declare([ Container ], {
        baseClass: 'postsUpdate',
        langContainer: LangContainer,

        handle: function (router, route) {
            try {
                this.inherited(arguments);

                if (route.params.id) {
                    this._langContainerWidget.attr('identifier', route.params.id);
                }
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
