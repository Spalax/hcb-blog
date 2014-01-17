define([
    "dojo/_base/declare",
    "dojo/_base/lang",
    "dijit/form/Button",
    "hc-backend/form/_DgridEventedButtonMixin",
    "hc-backend/router",
    "dojo/request",
    "dojo/i18n!../../../nls/List",
    "dojo-common/response/_StatusMixin",
    "dojo-common/response/_MessageMixin"
], function(declare, lang, Button, _DgridEventedButtonMixin,
            router, request, translation, _StatusMixin, _MessageMixin) {
    return declare([ Button, _DgridEventedButtonMixin ], {

        label: translation['deleteSelectedButton'],
        disabled: true,

        _success: function (resp) {
            try {
                var response = new declare([_StatusMixin, _MessageMixin])(resp);

                for (var id in this.grid.getSelected()) {
                    this.grid.store.notify(null, id);
                }

                if (response.isSuccess()) {
                    this.emit('success');
                }
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        _error: function () {
            try {
                var response = new declare([_StatusMixin, _MessageMixin])(resp);
                this.emit('error');
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        onClick: function () {
            try {
                var ids = [];
                for (var id in this.grid.getSelected()) ids.push(id);
                if (!ids.length) { return; }
                request.post(router.assemble('/delete', {}, true), {
                    data: { 'posts[]': ids },
                    handleAs: 'json'
                }).then(lang.hitch(this, '_success'),
                        lang.hitch(this, '_error'));

                return false;
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
