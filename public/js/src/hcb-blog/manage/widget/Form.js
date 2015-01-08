define([
    "dojo/_base/declare",
    "dojo/_base/array",
    "dojo/_base/lang",
    "hc-backend/config",
    "dojo/DeferredList",
    "dojo/store/Memory",
    "hc-backend/widget/ContentLocalization/widget/Form",
    "hc-backend/form/_HasPageFieldsMixin",
    "dijit/_WidgetsInTemplateMixin",
    "dojo/text!./templates/Form.html",
    "dojo/i18n!../../nls/Manage",
    "dijit/form/FilteringSelect",
    "dojo-common/form/InputList",
    "dojo-common/store/JsonRest",
    "dijit/form/TextBox",
    "dijit/form/Textarea",
    "dojo-common/form/BusyButton",
    "dijit/form/ValidationTextBox",
    "hc-backend/form/FileInputList",
    "hc-backend/Editor"
], function(declare, array, lang, config, DeferredList, Memory, Form,
            _HasPageFieldsMixin, _WidgetsInTemplateMixin,
            template, translation, FilteringSelect,
            InputList, JsonRest) {

    return declare([ Form, _HasPageFieldsMixin, _WidgetsInTemplateMixin ], {
        //  summary:
        //      Form widget for adding page to the CMS database

        filebrowserUploadUrl: '',
        thumbnailServiceUrl: '',

        templateString: template,

        // _t: [const] Object
        //      Contains dictionary with translations
        _t: translation,

        postMixInProperties: function () {
            try {
                this.thumbnailServiceUrl = config.get('primaryRoute') +
                                           '/blog/' +
                                           this.saveService.identifier +
                                           '/localized/thumbnail?lang='+this.lang;
                this.inherited(arguments);
            } catch (e) {
                 console.error(this.declaredClass, arguments, e);
                 throw e;
            }
        },

        initTags: function () {
            try {
                var store = new JsonRest({target: config.get('primaryRoute') + "/blog/tag"});

                var defList = new DeferredList([store.query()]);
                defList.then(lang.hitch(this, function (response) {
                    var fields = [{
                        w: FilteringSelect,
                        name: 'name',
                        args: {
                            searchAttr: 'name',
                            labelAttr: 'name',
                            maxLength: 250,
                            store: new Memory({data: response[0][1]})
                        }
                    }];

                    this.tagInstance = new InputList({fields: fields,
                                                      name: 'tags[]'},
                                                     this.tagsWidget);

                    this.tagInstance
                        .attr('value',
                              this.rawValues['tags[]']);

                    this.own(this.tagInstance);
                }));
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        },

        _setValueAttr: function (values) {
            try {
                this.inherited(arguments);

                if (this.tagInstance) {
                    this.tagInstance.attr('value', values['tags[]']);
                }
            } catch (e) {
                console.error(this.declaredClass + " " + arguments.callee.nom, arguments, e);
                throw e;
            }
        },

        startup: function () {
            try {
                this.initTags();
                this.inherited(arguments);
            } catch (e) {
                console.error(this.declaredClass, arguments, e);
                throw e;
            }
        }
    });
});
