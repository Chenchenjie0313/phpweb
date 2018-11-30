/**
 * DialogView
 */
define(['base/baseView','underscore','utils','backbone.radio'], 
    function (BaseView, _, Utils, Radio) {

        return BaseView.extend({

            tagName:  "div",

            /**
             * イベントの紐付
             * */
            events : _.extend({}, BaseView.events, {
                "click [data-dialog='close']" : "closeDialog",
                "click a[data-pageid]": "operationByPageid",
                "click a[data-modalid]": "operationByModalid",
                "click [data-fetch]": "fetch",
                "click [data-submenu]": "toggleSubmenu",
                "click [data-toolTip]": "toolTip",
                "click [data-templateid]": "operationByTemplate",
                "click [data-upload]": "fileUpload"
            }),

            /**
             * 初期化
             */
            initialize : function (){
                //処理
                this.super && this.super();
                _.bindAll(this, 'closeDialog', 'renderZindex', 'openDialog', 'closeDialog','destroy');

                //モデル
                this.model || (this.model = new BaseModel());
                this.model.set('type', 1);

                //０：非表示、1：非表示のアニメション、２：表示、３：表示のアニメション
                if (!this.model.get('display')){
                    this.model.set("status", 0);
                } else {
                    this.model.set("status", 2);
                }
                if (!this.model.has("zindex") || !this.model.get("zindex")){
                    this.model.set("zindex", Utils.nextSequence("DialogView-Zindex", 1000, 2)['value']);
                }
                //監視
                this.listenTo(this.model, "change:zindex", this.renderZindex);

            },

            /**
             * 閉じるイベント
             */
            openDialog : function(event){
                this.model.set("display" , true);
            },

            /**
             * 閉じるイベント
             */
            closeDialog : function(event){
                this.model.set("display" , false);
            },

            /**
             * 初期化
             */
            render : function (){
                if (this.templateHtml){
                    var data = this.model.get('template') || {};
                    this.$el.html(this.template(data));
                }
                this.renderDisplay();
                this.renderZindex();
                return this;
            },


            /**
             * 
             */
            renderZindex : function(){
                if (!this.$backdrop){
                    this.$backdrop = $('<div class="modal-backdrop fade" style="zindex:' + (this.model.get("zindex")-1) + ';"></div>');
                    this.$backdrop.appendTo(document.body);
                }
                var $first = $(this.el);
                var $second = $(this.$backdrop);
                
                $first.css("zIndex", this.model.get('zindex'));
                $second.css("zIndex", this.model.get('zindex')-1);

                return this;

            },

            /**
             * 表示非表示
             */
            renderDisplay : function (){

                var display = this.model.get('display');

                var self = this;
                if (display){
                    this.model.set("status", 3);
                } else {
                    this.model.set("status", 1);
                }

                this.renderZindex();

                var $first = $(this.el);
                var $second = $(this.$backdrop);

                Utils.debug($first);
                Utils.debug($second);

                
                var fd = new $.Deferred();
                var td = new $.Deferred();

                if (display){

                    //表示
                    $second.velocity({"right":"0%"},{
                        begin : function(){
                            $second.removeClass("common-hide");
                            $second.css({"right" : '100%', "display" : "block", opacity : 0.5});
                        }
                        ,complete : function(){
                            display || $second.addClass("common-hide");
                            $second.css({"right" : "0%", "display" : "block", opacity : 0.5});

                            $first.velocity({"right":"0%"},{
                                begin : function(){
                                    $first.removeClass("common-hide");
                                    $first.css({"right" : "100%", "display" : "block"});
                                }
                                ,complete : function(){
                                    display || $first.addClass("common-hide");
                                    td.resolve();
                                    fd.resolve();
                                    self.model.set("status", 2);
                                }
            
                            });
                        }
    
                    });

                } else {

                    //非表示
                    $first.velocity({"right":"100%"},{
                        begin : function(){
                            $first.css({"right" : "0%", "display" : "block"});
                            $first.removeClass("common-hide");
                        }
                        ,complete : function(){
                            display || $first.addClass("common-hide");
                            fd.resolve();
                        }
    
                    });
    
                    $second.velocity({"right":"100%"},{
                        begin : function(){
                            $second.css({"right" : "0%", "display" : "block", opacity : 0.5});
                            $second.removeClass("common-hide");
                        }
                        ,complete : function(){
                            display || $second.addClass("common-hide");
                            self.model.set("status", 0);
                            td.resolve();

                            Radio.channel("modal").trigger("close.end", self.model.toJSON());

                        }
    
                    });
                }

                return $.when(fd.promise(),td.promise());


            },


            destroy : function(){
                this.$backdrop.remove();
                this.unbind();
                this.remove();
            }

        });
    }
);