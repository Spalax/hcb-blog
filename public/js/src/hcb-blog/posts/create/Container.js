define([
    "dojo/_base/declare",
    "hcb-blog/posts/manage/Container",
    "hcb-blog/posts/manage/LangContainer",
    "hcb-blog/posts/manage/widget/Tab"
], function(declare, Container, LangContainer, Tab) {
    return declare([ Container ], {
        baseClass: 'postsCreate',
        langContainer: declare([LangContainer], {tabWidget: Tab})
    });
});
