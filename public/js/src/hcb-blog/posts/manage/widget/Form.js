define([
    "dojo/_base/declare",
    "dijit/form/Form",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/component/form/_ResourceSaverMixin",
    "hc-backend/router",
    "dojo/text!./templates/Form.html",
    "dojo-ckeditor/Editor",
    "dojo/i18n!../../../nls/Add",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox"
], function(declare, Form, _WidgetsInTemplateMixin,
            _ResourceSaverMixin, router, template,
            Editor, translation) {

    return declare([ Form, _ResourceSaverMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: translation,

        doLayout: false,
        isLayoutContainer: false,

        postMixInProperties: function () {
            try {
                this.filebrowserUploadUrl = router.assemble('/file', {}, true);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        onSave: function () {
            try {
                 alert("On save");
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        save: function () {
            try {
                console.log("Save data >>", this.get('value'));
                this.onSave(this.get('value'));
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
