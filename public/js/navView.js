/**
 * navView
 * 
 * ※レフトメニュービューと同じモデルを使っている。
 */
define(['jquery', 'backbone.radio','underscore','base/baseModel','base/baseView','base/baseCollection','utils','dialogView'],
    function ($, Radio, _, BaseModel, BaseView, BaseCollection, Utils, DialogView) {
        'use strict';
        
        return BaseView.extend({
            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            tagName:  "nav",

            templete : false,

            events : _.extend({},BaseView.events,{
                "click a[data-pageid]": "operationByPageid",
                "click a[data-modalid]": "operationByModalid"
            }),
            
            /**
             * 初期化
             */
            initialize : function (){
                this.super && this.super();
            }

            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        });
    }
);