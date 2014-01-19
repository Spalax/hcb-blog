define([], function() {
    return {
        "route": "/blog/posts",
        "prio": 3,
        "modules": [{
            "route": "",
            "module": "posts/list/Container"
        }, {
            "route": "/create",
            "subRoutes": {
                          "/:lang": function (evt) { this.getInstance().selectLanguageTab(evt.params.lang); },
                          "": function () { this.getInstance().selectLanguageTab(); }},
            "module": "posts/create/Container"
        }, {
            "route": "/update/:id",
            "subRoutes": {"/:lang": function (evt) { this.getInstance().selectLanguageTab(evt.params.lang); },
                          "": function () { this.getInstance().selectLanguageTab(); }},
            "module": "posts/update/Container"
        }]
    };
});
