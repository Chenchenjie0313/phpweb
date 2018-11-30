/**
 * navView
 * 
 * ※レフトメニュービューと同じモデルを使っている。
 */
define(['jquery', 'backbone.radio','underscore','base/baseModel','base/baseView','base/baseCollection','utils','dialogView', 'carouselView'],
    function ($, Radio, _, BaseModel, BaseView, BaseCollection, Utils, DialogView, CarouselView) {
        'use strict';
        
        return BaseView.extend({
            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

            events : function(){
                return false;
            },
            
            /**
             * 初期化
             */
            initialize : function (){
                this.super && this.super();

                _.bindAll(this,'fetch');

                this.collection || (this.collection = new BaseCollection());
                this.collectionView || (this.collectionView = {});


                if ((this.model.get('BaseView') && this.model.get('BaseView').length > 1)
                 || (this.model.get('CarouselView') && this.model.get('CarouselView').length > 1)){
                    return false
                }
                else {
                    this.$el.on('click', '[data-pageid]' , this.operationByPageid );
                    this.$el.on('click', '[data-modalid]' , this.operationByModalid );
                    this.$el.on('click', '[data-fetch]' , this.fetch );
                    this.$el.on('click', '[data-submenu]' , this.toggleSubmenu );
                    this.$el.on('click', '[data-toolTip]' , this.toolTip );
                    this.$el.on('click', '[data-fileUpload]' , this.fileUpload );
                };

            },

            /**
             * 
             */
            render : function(){

                if (this.templateHtml){
                    var data = this.model.get('template') || {};
                    this.$el.html(this.template(data));
                }

                //サブビュー
                if (this.model.get('BaseView')){
                    _.each(this.model.get('BaseView'), function(data){
                        var viewid = data['id'];
                        if (this.$el.find('#' + viewid).length == 1){
                            var model = new BaseModel({id : viewid, pageid : viewid});
                            var view = new BaseView({model : model, el : $('#' + viewid) });
                            this.collection.add(model);
                            this.collectionView[viewid] = view;

                        }

                    }, this);
                }
                if (this.model.get('CarouselView')){
                    _.each(this.model.get('CarouselView'), function(data){
                        var viewid = data['id'];
                        if(this.$el.find('#' + viewid).length == 1){
                            var model = new BaseModel({id : viewid, pageid : viewid, type : 2});
                            var view = new CarouselView({model : model, el : $('#' + viewid) });
                            this.collection.add(model);
                            this.collectionView[viewid] = view;

                        }

                    }, this);
                }

                return false;
            },

            destroy : function(){
                
                if (this.collection.length == 0){
                    this.$el.off('click');
                } else {
                    _.each(this.collectionView, function(view, viewid){
                        Utils.debug(view, viewid);
                        try{                        
                            var model = view.model;
                            this.collection.remove(model);
                            view.$el.off('click');
                            view.unbind();
                            view.remove();
                            this.collectionView[model.get('id')] = void 0;

                        }catch(e){
                            Utils.debug(model, e);
                        }


                    }, this);

                }
                this.unbind();
                this.remove();

            }


            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

        });
    }
);
