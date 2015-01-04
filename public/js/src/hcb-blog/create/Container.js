define([
    "dojo/_base/declare",
    "hc-backend/widget/ContentLocalization/Container",
    "../manage/LangContainer"
], function(declare, Container, LangContainer) {
    return declare([ Container ], {
        baseClass: 'postsCreate',
        langContainer: LangContainer
    });
});
