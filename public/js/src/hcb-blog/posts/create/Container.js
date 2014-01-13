define([
    "dojo/_base/declare",
    "hcb-blog/posts/manage/Container",
    "./LangContainer"
], function(declare, Container, LangContainer) {
    return declare([ Container ], {
        baseClass: 'postsCreate',
        langContainer: LangContainer
    });
});
