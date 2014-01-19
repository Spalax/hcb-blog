define([
    "dojo/_base/declare",
    "dojo/_base/array",
    "dijit/form/Form",
    "dijit/_WidgetsInTemplateMixin",
    "hc-backend/router",
    "dojo/text!./templates/Form.html",
    "hc-backend/component/form/_FormChangeableMixin",
    "dijit/form/_FormValueMixin",
    "dojo/i18n!../../../nls/Add",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox",
    "dojo-ckeditor/Editor"
], function(declare, array, Form, _WidgetsInTemplateMixin,
            router, template, _FormChangeableMixin,
            _FormValueMixin, translation) {

    return declare([ Form, _FormChangeableMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: translation,

        doLayout: false,
        isLayoutContainer: false,
        __formConnectors: [],

        postMixInProperties: function () {
            try {
                this.filebrowserUploadUrl = router.assemble('/file', {}, true);
                this.watch('changed', function (name, oldValue, changed){
                    if (changed) {
                        this.saveButtonWidget.set('disabled', false);
                        this.resetButtonWidget.set('disabled', false);
                    } else {
                        this.saveButtonWidget.set('disabled', true);
                        this.resetButtonWidget.set('disabled', true);
                    }
                })
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        _setValueAttr: function (values) {
            try {
                this.inherited(arguments);

                console.log("Values set in form >>>", values);
                if (values['id']) {
                    this.__id = values['id'];
                }

                if (values['lang'] && values['lang'].length) {
                    this.set('lang', values['lang']);
                }
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        _getValueAttr: function () {
            try {
                var values = this.inherited(arguments);

                if (this.__id) {
                    values['id'] = this.__id;
                }

                if (!this.lang) {
                    throw "Lang must be defined for the form";
                }

                values['lang'] = this.get('lang');

                return values;
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
