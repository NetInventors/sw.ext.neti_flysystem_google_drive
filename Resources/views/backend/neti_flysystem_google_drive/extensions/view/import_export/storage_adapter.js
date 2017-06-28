/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiPrepaid
 * @author     bmueller
 */
//{namespace name="plugins/neti_flysystem_google_drive/backend/import_export/storage_adapter"}
//{block name="backend/index/view/menu" append}
Ext.define('Shopware.apps.NetiFlysystemGoogleDriveExtensions.view.importExport.StorageAdapter', {
    'extend': 'Ext.form.FieldContainer',
    'alias': 'widget.neti_flysystem_google_drive_import_export_storage_adapter',
    'initComponent': function () {
        var me = this;

        me.items = me.getItems();

        me.callParent(arguments);
    },
    'layout': {
        'type': 'vbox',
        'align': 'stretch',
        'pack': 'start'
    },

    'getItems': function () {
        var me = this,
            items = [];

        items.push({
            'fieldLabel': '{s name="field_label_client_id"}Client id{/s}',
            'name': 'clientId',
            'xtype': 'textfield',
            'allowBlank': false
        });
        items.push({
            'fieldLabel': '{s name="field_label_client_secret"}Client secret{/s}',
            'name': 'clientSecret',
            'xtype': 'textfield',
            'allowBlank': false
        });
        items.push(me.getRefreshTokenField());
        items.push({
            'fieldLabel': '{s name="field_label_access_token"}Access token{/s}',
            'name': 'accessToken',
            'xtype': 'textfield',
            'flex': 1,
            'allowBlank': false
        });
        items.push({
            'fieldLabel': '{s name="field_label_root_dir"}Root dir{/s}',
            'name': 'rootDir',
            'value': 'root',
            'xtype': 'textfield',
            'allowBlank': false
        });
        items.push({
            'fieldLabel': '{s name="field_label_development"}Development{/s}',
            'name': 'development',
            'xtype': 'checkbox',
            'uncheckedValue': 0,
            'inputValue': 1
        });
        items.push({
            'fieldLabel': '{s name="field_label_developer_key"}Developer key{/s}',
            'name': 'developerKey',
            'xtype': 'textfield'
        });

        return items;
    },

    'getRefreshTokenField': function () {
        var me = this;

        return {
            'xtype': 'fieldcontainer',
            'fieldLabel': '{s name="field_label_refresh_token"}Refresh token{/s}',
            'layout': {
                'type': 'hbox',
                'align': 'stretch'
            },
            'items': [
                {
                    'hideLabel': true,
                    'name': 'refreshToken',
                    'xtype': 'textfield',
                    'flex': 1,
                    'allowBlank': false
                },
                {
                    'xtype': 'button',
                    'text': '{s name="button_text_refresh_token"}Get refresh token{/s}',
                    'handler': function () {
                        var form = me.up('form').getForm(),
                            values = me.up('form').getForm().getFieldValues(),
                            clientIdField = form.findField('clientId'),
                            clientSecretField = form.findField('clientSecret');

                        if (
                            values.hasOwnProperty('clientId') && !Ext.isEmpty(values.clientId)
                            && values.hasOwnProperty('clientSecret') && !Ext.isEmpty(values.clientSecret)
                        ) {
                            clientIdField.clearInvalid();
                            clientSecretField.clearInvalid();

                            me.openRefreshTokenWindow(values.clientId, values.clientSecret);
                        } else {
                            clientIdField.markInvalid(clientIdField.blankText);
                            clientSecretField.markInvalid(clientSecretField.blankText);
                        }
                    }
                }
            ]
        }
    },

    'openRefreshTokenWindow': function (clientId, clientSecret) {
        var me = this,
            form = me.up('form').getForm(),
            accessTokenField = form.findField('accessToken'),
            refreshTokenField = form.findField('refreshToken'),
            popupBlockerChecker = {
                'check': function (popup_window) {
                    var _scope = this;
                    if (popup_window) {
                        if (/chrome/.test(navigator.userAgent.toLowerCase())) {
                            setTimeout(function () {
                                _scope._is_popup_blocked(_scope, popup_window);
                            }, 200);
                        } else {
                            popup_window.onload = function () {
                                _scope._is_popup_blocked(_scope, popup_window);
                            };
                        }
                    } else {
                        _scope._displayError();
                    }
                },
                '_is_popup_blocked': function (scope, popup_window) {
                    if ((popup_window.innerHeight > 0) == false) {
                        scope._displayError();
                    }
                },
                '_displayError': function () {
                    Ext.MessageBox.alert(
                        '{s name="PopupAlert"}Ein Popup Blocker ist aktiviert!{/s}',
                        '{s name="PopupAlertHintNetwork"}Bitte setzen Sie diese Seite auf Ihre Ausnahme-Liste.<br /><br />Tipp: In den meisten Fällen zeigt Ihnen Ihr Browser oben als Fehlermeldung an, dass sie ein Popup Fenster blocken und bietet Ihnen sofort eine Möglichkeit an, dieses zu ändern.{/s}'
                    );
                }
            };

        Ext.Ajax.request({
            'url': '{url controller="NetiFlysystemGoogleDrive" action="refreshToken"}',
            'method': 'POST',
            'params': {
                'clientId': clientId,
                'clientSecret': clientSecret
            },
            'success': function (response, opts) {
                var json = Ext.decode(response.responseText),
                    Popup = window.open(json.authUrl, '{s name="window_title_refresh_token"}Get refresh token{/s}', 'width=600,height=600,left=400,top=200');

                // check Pop-Up
                popupBlockerChecker.check(Popup);

                //onClose PopUp
                if (Popup) {
                    var timer = setInterval(function () {
                        var content,
                            jsonContent;
                        try {
                            content = Popup.document.documentElement.innerText;
                            jsonContent = Ext.decode(content);

                            if(jsonContent.hasOwnProperty('access_token')) {
                                accessTokenField.setValue(jsonContent.access_token);
                            }

                            if(jsonContent.hasOwnProperty('refresh_token')) {
                                refreshTokenField.setValue(jsonContent.refresh_token);
                            }

                            Popup.close();
                            clearInterval(timer);
                        } catch (err) {
                        }

                        if (Popup.closed) {
                            clearInterval(timer);
                        }
                    }, 1000);
                }
            }
        });
        //
        // Ext.createByAlias('widget.neti_flysystem_google_drive_import_export_storage_adapter_refresh_token_window', {
        //     'title': '{s name="window_title_refresh_token"}Get refresh token{/s}',
        //     'clientId': clientId,
        //     'clientSecret': clientSecret
        // });
    }
});
//{/block}
