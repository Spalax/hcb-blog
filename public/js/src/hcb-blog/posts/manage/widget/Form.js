define([
    "dojo/_base/declare",
    "dijit/form/Form",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/component/form/_ResourceSaverMixin",
    "hc-backend/component/form/_EnterKeyMixin",
    "hc-backend/router",
    "dojo/text!./templates/Form.html",
    "dojo-ckeditor/Editor",
    "dojo/i18n!../../../nls/Add",
    "dijit/form/TextBox",
    "dojo-common/form/BusyButton"
], function(declare, Form, _WidgetsInTemplateMixin,
            _ResourceSaverMixin, _EnterKeyMixin, router, template,
            Editor, translation) {

    return declare([ Form, _ResourceSaverMixin, _EnterKeyMixin, _WidgetsInTemplateMixin ], {
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
                this.editor = new Editor({name: 'content',
                                          settings: {filebrowserUploadUrl: this.filebrowserUploadUrl}});
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
        },

        postCreate: function () {
            try {
                this.editor.placeAt(this.editorNode);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        }
    });
});
