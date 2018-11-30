
/**
 * 
 */

define(['jquery', 'backbone','underscore', 'view/utils'], 
    function ($,Backbone, _, Utils) {
        'use strict';
        return Backbone.Model.extend({
            //--------------------------------------------------------------------------------------------
            defaults : function() {
                return {
                    id : "" //ビューID
                    ,display : false //TRUE:表示, FALSE:非表示
                    ,pageid : "" //画面ID
                    ,cache : true //キャッシュ可能 false : 非表示の場合、モデル削除するかどうか
                    ,zindex : null
                    ,className : ''
                    ,type : 0 //0:画面、1:モーダル、2:スライドショー 、3:カード

                    ,template : false//テンプレート機能使用するか
                    ,templateUrl : false//テンプレート機能使用するか
                    ,templateDataUrl : false//テンプレート機能使用するか
                    ,templateData : {}//テンプレート機能使用するか


                    ,beforeTemplate : false//テンプレート前のHTML
                    ,afterTemplate : false//テンプレート後のHTML
                };
            },

            // initialize: function (attrs, options) {
            // },

            // validate: function (attrs) {
            // },

            syncTemplateData : function(){
                console.log("syncTemplateData..");
                var self = this;
                var deferred = new $.Deferred();
                var templateDataUrl = this.get('templateDataUrl');
                var templateData = this.get('templateData');

                if (templateDataUrl){
                    Utils.ajaxJson(templateDataUrl)
                        .done( function(json){
                            if (json && json['statusCode'] == 0 ){
                                _.extend(templateData, json['templateData']) 
                            }
                        } )
                        .always(function (){ deferred.resolve(); });
                } else {
                    deferred.resolve();
                }
                return deferred.promise();

            },

            
            isEmpty : function(key){
                if(this.has(key) && this.get(key)){
                    return true;
                }
                return false;
            }
            //--------------------------------------------------------------------------------------------
        });
    }
);

