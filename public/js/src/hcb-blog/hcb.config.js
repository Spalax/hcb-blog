define([], function() {
    return {
        "route": "/blog/posts",
        "modules": [{
            "route": "",
            "module": "posts/list/Container"
        }, {
            "route": "/create",
            "module": "posts/create/Container"
        }, {
            "route": "/update/:id",
            "subRoutes": {"/:lang": function (evt) {
                           this.getInstance().selectLanguageTab(evt.params.lang);
                          }},
            "module": "posts/update/Container"
        }]
    };
});
