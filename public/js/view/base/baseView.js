/**
 * baseView
 */
define(['backbone','backbone.radio','underscore', 'view/utils', 'view/base/baseCollection', 'view/base/baseModel'], 
    function (Backbone, Radio, _, Utils, BaseCollection, BaseModel) {

        var BaseView =  Backbone.View.extend({
            tagName:  "div",

            template : function(data){
                var compiled = function(){ return false; };
                if (this.templateHtml){
                    compiled = _.template(this.templateHtml);
                }
                return compiled(data);
            },

            events : function(){
                return {
                    "click [data-pageid]": "operationByPageid",
                    "click [data-modalid]": "operationByModalid",
                    "click [data-fetch]": "fetch",
                    "click [data-submenu]": "toggleSubmenu",
                    "click [data-toolTip]": "toolTip",
                    "click [data-upload]": "fileUpload"
                };
            },

            /**
             * 
             */
            fileUpload : function(event){
                Utils.debug(event);
                var $target = $(event.currentTarget);
                var selector = $target.data('upload');
                var $target = $(selector);
                if ($target.length == 1){
                    var file = $target.find("input[type='file']").prop("files")[0];
                    if (file){
                        var fd = new FormData();

                        var description = $target.find("input[name='description']").val();
                        fd.append( "file", file );
                        fd.append( "description", description );

                        $.ajax({
                            url: '/?action=setting&method=uploadFile',
                            type: "POST",
                            data : fd,
                            cache: false,
                            dataType: "json",
                            timeout : 10000, //10S
                            processData: false,  // 不处理数据
                            contentType: false   // 不设置内容类型
                        }).done(function(json){ console.log(json); })
                            .fail(function(e){ alert(e); });

                    }

                } else {
                    Utils.log("error : fileUpload.");
                }

                return false;

            },

            /**
             * 初期化
             */
            initialize : function (){
                this.super();
            },

            super : function (){
                //処理
                _.bindAll(this, "render", 'operationByPageid', 'operationByModalid', 'renderDisplay', 'fetch', 'toggleSubmenu', 'destroy', 'toolTip', 'fileUpload');

                //モデル
                this.model || (this.model = new BaseModel());
                //コレクション
                this.collection || (this.collection = new BaseCollection());
                this.collectionView || (this.collectionView = {});

                //監視
                this.listenTo(this.model, "change:display", this.renderDisplay);

            },

            toggleSubmenu : function (event){
                Utils.debug(event);
                var $target = $(event.currentTarget);
                var submenus = $target.data('submenu');
                if (submenus && $(submenus).length == 1){
                    $(submenus).css('display') == 'none' ? $(submenus).css('display', 'block') : $(submenus).css('display', 'none');
                }
                else if (submenus && $(submenus).length > 0){
                    _.each(submenus, function(menu){
                        $(menu).css('display') == 'none' ? $(menu).css('display', 'block') : $(menu).css('display', 'none');
                    }, this);
                }
                return false;

            },

            toolTip : function (event){
                Utils.debug(event);
                console.log("toolTip TODO" );
                return false;

            },

            /**
             * 
             */
            operationByPageid : function(event){
                Utils.debug(event);

                console.log("operationByPageid");

                var $target = $(event.currentTarget);
                var fromPageid = this.model.get('pageid');
                var fromType = this.model.get('type');
                var data = {fromPageid : fromPageid, fromType : fromType};
                Radio.channel("page").trigger("show", Utils.radioData(data, $target));
                return false;
            },

            /**
             * 
             */
            operationByModalid : function(event){
                Utils.debug(event);
                var $target = $(event.currentTarget);
                var fromPageid = this.model.get('pageid');
                var fromType = this.model.get('type');
                var data = {fromPageid : fromPageid, fromType : fromType};
                Radio.channel("modal").trigger("show", Utils.radioData(data, $target));
                return false;
            },


            /***
             * 
             */
            fetch : function(event){
                var self = this;
                var $target = $(event.currentTarget);
                var data = Utils.radioData({}, $target);
                var formid = $target.data('formid');
                $form = null;
                if (formid){
                    var $form = this.$el.find('#' + formid);
                }
                Utils.ajaxJson(data)
                    .done(function(json){
                        //フォームデータ
                        if ($form && json && json.insert){
                            _.each(json.insert, function(value,key){
                                $form.find('[name="'+ key +'"]').val(value);
                            }, self);
                        }
                        //メッセージ
                        self.$el.find('[data-return-msg="form"]').html("");
                        if (json && json.msg){
                            self.$el.find('[data-return-msg="form"]').html(json.msg);
                        }
                    })
                    .fail(function(e){Utils.log(e);self.$el.find('[data-return-msg="form"]').html("エラーが発生しました。");});
            },

            /**
             * 
             */
            render : function(){
                if (this.templateHtml){
                    var data = this.model.get('template') || {};
                    this.$el.html(this.template(data));
                }
                return false;
            },

            renderDisplay : function(){
                var display = this.model.get("display");
                Utils.toggleWrapperPage(this.$el, display);

            },

            destroy : function(){
                this.$el.off('click');
                this.unbind();
                this.remove();
            }


        });

        return BaseView;
    }
);