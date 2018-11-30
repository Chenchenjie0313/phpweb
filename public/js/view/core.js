/**
 * コアー
 */

requirejs(['jquery', 'backbone.radio','underscore','view/base/baseModel','view/base/baseView','view/base/baseCollection','view/dialogView', 'view/cardView','view/utils'], 
    function ($, Radio, _, BaseModel, BaseView, BaseCollection, DialogView, CardView, Utils) {
    //厳格モード
    'use strict';

    var Core = function (json){

        var AppView = BaseView.extend({    

            el : $(document.body),

            events : false,            

            addWindowEvents : function(){

                if(!this.$backToScrollTop){
                    this.$backToScrollTop = $('<div class="backToTopBtn" style="display:none"></div>');
                    this.$backToScrollTop.appendTo(document.body);
                }
                // if(!this.$backToScrollBottom){
                //     this.$backToScrollBottom = $('<div class="backToBottomBtn"></div>');
                //     this.$backToScrollBottom.appendTo(document.body);
                // }
                if(!this.$bottomMenuBtn){
                    this.$bottomMenuBtn = $('<div class="bottomMenuBtn" data-modalid="leftMenuView"><i class="fa fa-bars"></i></div>');
                    this.$bottomMenuBtn.appendTo(document.body);
                }
                $(window).on('scroll', this.scrollEvent);
                $(document.body).on('click', "div.backToTopBtn", this.backToTop);
                $(document.body).on('click', "div.bottomMenuBtn", this.operationByModalid);

            },

            /**
             * トップに戻る。
             */
            backToTop : function(){
                try {
                    Utils.log("Core backToTop");
                    $('html,body').velocity("scroll", { offset: "0", mobileHA: false });
                    
                } catch (error) {
                    Utils.log(error);

                }
            },

            /**
             * スクロールイベント
             */
            scrollEvent : function(e){
                try {
                    var scrollTop = document.body.scrollTop|| document.documentElement.scrollTop || 0;
    
                    //backToScrollTopボタンの表示非表示
                    if(scrollTop > 100){
                        this.$backToScrollTop.css("display","block");
                    } else {
                        this.$backToScrollTop && this.$backToScrollTop.css("display","none");
                    }
                    
                } catch (error) {
                    Utils.log(error);
                    
                }
            },

            /**
             * 初期化
             */
            initialize : function (){
                
                this.super && this.super();
                //メソッドのコンテンツをバインドする
                _.bindAll(this, 
                    //ブラウザサイズ変更、全体スクロールなどイベントを追加
                    'addWindowEvents',
                    'scrollEvent',

                    //クリックイベント
                    'backToTop',

                    //対象画面を表示する。
                    'showPage',
                    'fetchPageDataAndShow',

                    //全モーダル閉じる
                    'closeAllDialog',

                    //指定モーダル表示
                    'openDialog', 

                    //モーダル閉じた後処理
                    'closeAfterDialog', 
                    'dialogTemplate', 
                    'cardTemplate',

                    'toggleLoadPage',

                    'changeDisplayDialogCollection'
                    );

                //モデル
                this.model || (this.model = new BaseModel());


                var config = this.model.get('config') || {};
                var configMap = config['map'];

                Utils.config(config);

                //コレクション
                this.maxCollectionLength = 8;
                this.collection || (this.collection = new BaseCollection());
                this.collectionView || (this.collectionView = {});

                this.dialogCollection || (this.dialogCollection = new BaseCollection());
                this.dialogCollectionView || (this.dialogCollectionView = {});

                //メニュービュー初期化
                this.navModel = new BaseModel({id : 'navView', pageid : "navView"});
                this.navView = new BaseView({model : this.navModel, el : $('#navView') });

                var leftMenuModel = new BaseModel({id : 'leftMenuView', pageid : "leftMenuView", type : 2});
                var leftMenuView = new DialogView({model : leftMenuModel, el : $('#leftMenuView') });
                this.dialogCollection.add(leftMenuModel);
                this.dialogCollectionView['leftMenuView'] = leftMenuView;

                //ホームビュー初期化
                var homeModel = new BaseModel(_.extend({}, configMap['homeView'],  {id : 'homeView', display : true, pageid : "homeView", display : true, index : this.collection.length}));
                var homeView = new CardView({model : homeModel, el : $('#homeView') });
                this.collection.add(homeModel);
                this.collectionView['homeView'] = homeView;


                Radio.channel("modal").on("close.all", this.closeAllDialog);
                Radio.channel("modal").on("show", this.openDialog);
                Radio.channel("modal").on("close.end", this.closeAfterDialog);
                Radio.channel("loadPage").on("toggle", this.closeAfterDialog);

                //コレクションの監視
                this.listenTo(this.dialogCollection, 'change:display', this.changeDisplayDialogCollection);

                //画面とアラードビュー表示
                Radio.channel("page").on("show", this.showPage);
                //イベントを追加する。
                this.addWindowEvents();
                
            },

            /**
             * 表示されているモーダルを監視する処理
             * 
             * @param {*} model 
             */
            changeDisplayDialogCollection : function(model){
                var m = this.dialogCollection.findWhere({display : true});
                if ( m ){
                    $(document.body).addClass("modal-open");
                } else {
                    $(document.body).removeClass("modal-open");

                }
            },

            /**
             * 指定IDのベースモーダルDIVを作成。
             * 
             * @param {*} temp 
             */
            dialogTemplate : function(temp){
                return '<div class="modal-dialog">'+
                           '<div class="modal-content">'+
                             '<div class="modal-header">'+
                               '<% if (title) { %>'+
                               '<h4 class="modal-title"><%- title%></h4>'+
                               '<% } %>'+
                               ' <button type="button" class="close" data-dialog="close">&times;</button>'+
                             '</div>' +
                             '<div class="modal-body" data-html="content">' + (temp ? temp : '<%= body %>') +  '</div>'+
                             '<div class="modal-footer">'+
                               '<button type="button" class="btn btn-danger" data-dialog="close">Close</button>'+
                             '</div>'+
                           '</div>'+
                       '</div>'
            },

            /**
             * 指定IDのベースモーダルDIVを作成。
             * 
             * @param {*} temp 
             */
            cardTemplate : function(title,body){
                return '<div class="card">'+
                           '<div class="card-header">'+
                               (title ? '<h3 class="card-title">'+title+'</h3>' : '<% if (title) { %><h3 class="card-title"><%- title%></h3><% } %>') +
                            '</div>' +
                            '<div class="card-body">' + (body ? body : '<%= body %>') +  '</div>' +
                            '<div class="card-footer">'+
                               '<button type="button" class="btn btn-primary" data-historyback="true" data-pageid="back">戻る</button>'+
                            '</div>'+
                       '</div>'
            },

            /**
             * モーダル閉じる後、発火する処理、
             * cache==falseのモデル、ビューを廃棄する。
             * 
             * @param {*} data 
             */
            closeAfterDialog : function(data){
                var cache = data['cache'];
                var id = data['id'];
                if (cache === false){
                    var view = this.dialogCollectionView[id];
                    this.dialogCollectionView[id] = void 0;
                    this.dialogCollection.remove(view.model);
                    view.destroy();
                    return;
                }
            },


             /**
              * モーダルを表示するラジオを受け取った後、発火する処理
              * 
              * @param {*} urlParams 
              */
            openDialog : function(urlParams){
                
                Utils.debug("core.openDialog is start.", urlParams);
                var modalid = urlParams['toPageid'];
                var url = urlParams['url'];
                var params = urlParams['params'];
                var cache = !!urlParams['cache'];
                var alterMsg = urlParams['alterMsg']; //HTML
                var titleMsg = urlParams['titleMsg']; //HTML
                var dataType = urlParams['dataType']; //dataType

                //チェック
                if (alterMsg && url){
                    Utils.debug("alterMsg and url has value.");
                    return ;
                }
                
                if (modalid && alterMsg){
                    Utils.debug("アラードメッセージを表示する際に、モーダルのIDを指定できない。");
                    return ;
                }

                //既存モーダルの場合、
                var model = modalid ? this.dialogCollection.findWhere({pageid : modalid}) : null;
                if (model){
                    model.set('display', true);
                    return;
                }
                
                //メッセージの場合、
                if (alterMsg){
                    modalid || (modalid = _.uniqueId('M_'));

                    var model = new BaseModel({id : modalid, pageid : modalid, display : true, cache : false });
                    model.set("zindex" , Utils.nextSequence("DialogView-Zindex", 1000, 2)['value']);
                    model.set("template" , {title: titleMsg, body : alterMsg});
                    this.dialogCollection.add(model);

                    var $el = $('<div class="modal alter-dialog" id="' + id + '"></div>');
                    $el.appendTo(document.body);
                    var view = new DialogView({model : model, el : $el});
                    view.templateHtml = this.dialogTemplate();
                    view.render();

                    return ;
                }

                //サーバーからコンテンツを取得するため、URLがNULLできない。
                if (!url){
                    return;
                }
                var self = this;
                //MIDが未採番の場合、採番する。
                modalid || (modalid = _.uniqueId('M_'));
                var model = new BaseModel(_.extend(urlParams, {id : modalid, pageid : modalid, display : true, cache : cache}));
                model.set("zindex" , Utils.nextSequence("DialogView-Zindex", 1000, 2)['value']);

                self.toggleLoadPage(true);
                if (dataType && dataType == 'HTML'){

                    //url, parmas,pageid
                    Utils.ajaxTxt({url : url, params : params})
                        .done(function(html){
                            model.set("template" , {title:null});
                            var $el = $('<div class="modal alter-dialog" id="' + modalid + '"></div>');
                            $el.appendTo(document.body);
                            self.dialogCollection.add(model);
                            var view = new DialogView({model : model, el : $el});
                            self.dialogCollectionView[modalid]=view;
                            view.templateHtml = self.dialogTemplate(html);
                            view.render();
                        })
                        .fail(function(e){Utils.log(e);})
                        .always(function(){self.toggleLoadPage(false)});
                } else {
                    //TODO:
                    Utils.ajaxJson({url : url, params : params})
                    .done(function(json){
                        if (json && json.statusCode == 0){
                            model.set("template" , _extend({title:null},json['templateData']));
                            var $el = $('<div class="modal alter-dialog" id="' + modalid + '"></div>');
                            $el.appendTo(document.body);
                            self.dialogCollection.add(model);
                            var view = new DialogView({model : model, el : $el});
                            self.dialogCollectionView[modalid]=view;
                            view.templateHtml = self.dialogTemplate(json['template']);
                            view.render();

                        }
                    })
                    .fail(function(e){Utils.log(e);})
                    .always(function(){self.toggleLoadPage(false)});
                }
            },

            /**
             * 全て表示されているモーダルを閉じるラジオを受け取った後、発火する処理
             * 
             */
            closeAllDialog : function(){
                this.dialogCollection.each(function(model){
                    model.set('display', false);
                }, this);
                return this;
            },

            
            /**
             * 
             */
            showPage : function(data){

                try {

                    //-----------------------------------------------------------------------------------------------------------------------
                    //
                    //-----------------------------------------------------------------------------------------------------------------------
                    
                    var historyback = data.historyback;
                    // var params = data.data;
                    var self = this;

                    if (historyback === true){
                        //shift pop
                        if (!this.historyStack || this.historyStack.length==0){
                            return;
                        }
                        //戻るの場合、現在画面のデータを削除
                        this.historyStack.pop();
                        //表示のデータを取得
                        if (this.historyStack.length > 0){
                            data = this.historyStack[this.historyStack.length-1];
                        } else {
                            data = {'toPageid' : 'homeView'}
                        }

                    } else {
                        this.historyStack || (this.historyStack=[]);
                        this.historyStack.push(_.clone(data));
                        if (this.historyStack > 30) this.historyStack.shift();
                    }

                    var fromPageid = data.fromPageid;
                    var toPageid = data.toPageid;
                    var url = data.url;
                    var params = data.params;
                    var dataType = data.dataType;
                    var baseData = data;

                    var pageIndex = null;


                    //現在表示されたビュー
                    var currentModel = this.collection.findWhere({display : true});
                    //次表示された画面IDと現在表示されている画面IDと同様の場合、処理なし。
                    if (currentModel.get('pageid') == toPageid){
                        return;
                    }

                    //ヒストリーに記憶している場合、
                    var toPageModel = this.collection.findWhere({pageid : toPageid});
                    if (toPageModel){
                        Radio.channel("modal").trigger("close.all", {});
                        currentModel.set({display:false});
                        toPageModel.set({display:true});
                        return;

                    }
                    

                    //ヒストリーに記憶していない、且つ未使用ビューがある場合、
                    if (this.maxCollectionLength > this.collection.length){                        
                        pageIndex = this.collection.length;
                        
                        this.fetchPageDataAndShow(baseData,dataType, url, params, toPageid, pageIndex, currentModel);
                        return;

                    }

                    //上記以外の場合、そのビュー後をクリアする。
                    //ホームビューの場合、スキップする。
                    pageIndex = currentModel.get("index");
                    pageIndex ++;
                    if (pageIndex == this.collection.length){
                        pageIndex = 0;
                    }
                    toPageModel = this.collection.findWhere({index : pageIndex});
                    if (toPageModel.get('id') == 'homeView' ){
                        pageIndex ++;
                        if (pageIndex >= this.collection.length){
                            pageIndex = 0;
                        }
                        toPageModel = this.collection.findWhere({index : pageIndex});
                    }
                    
                    //ビューとモデルを削除
                    var distroyid = toPageModel.get('id');
                    var distroyView = this.collectionView[distroyid];
                    this.collection.remove(toPageModel);
                    distroyView.destroy();
                    this.collectionView[distroyid] = void 0;

                    this.fetchPageDataAndShow(baseData,dataType, url, params, toPageid, pageIndex, currentModel);
                    
                    return;

                    //-----------------------------------------------------------------------------------------------------------------------
                    
                } catch (error) {
                    Utils.log(error);
                    
                }
                return this;

            },

            /***
             * 
             */
            fetchPageDataAndShow : function(baseData, dataType, url, params, toPageid,pageIndex, currentModel){
                baseData  = baseData || {};
                var self = this;
                var id = _.uniqueId('subHomeView_');
                self.toggleLoadPage(true);
                if (dataType && dataType == 'HTML'){
                    Utils.ajaxTxt({url : url , params : params})
                        .done(function(html){
                            //モデル生成
                            var toPageModel = new BaseModel(_.extend(baseData,{id : id, display : false, pageid : toPageid, index : pageIndex}));
                            self.collection.add(toPageModel);

                            //ベーステンプレートを追加
                            var fromPageView = self.collectionView[currentModel.get('id')];
                            var $el = $('<div class="row" id="' + id + '" style="right: -100%;"></div>');
                            $el.appendTo(fromPageView.$el.parent());

                            //表示ビュー生成
                            var view = new CardView({model : toPageModel, el : $el});
                            view.templateHtml = '<div class="col-md-12" data-html="content">' + html + '</div>' ;
                            self.collectionView[id] = view;
                            view.render();

                            Radio.channel("modal").trigger("close.all", {});
                            currentModel.set("display", false);
                            toPageModel.set("display", true);
                        })
                        .fail(function(e){Utils.log(e);})
                        .always(function(){self.toggleLoadPage(false)});

                } else {
                    Utils.ajaxJson({url : url , params : params})
                        .done(function(json){
                            if (json){
                                //モデル生成
                                var toPageModel = new BaseModel(_.extend(baseData,{id : id, display : false, pageid : toPageid, index : pageIndex, template : json['templateData']}));
                                self.collection.add(toPageModel);
    
                                //ベーステンプレートを追加
                                var fromPageView = self.collectionView[currentModel.get('id')];
                                var $el = $('<div class="row" id="' + id + '" style="right: -100%;"></div>');
                                $el.appendTo(fromPageView.$el.parent());

                                //表示ビュー生成
                                var view = new CardView({model : toPageModel, el : $el});
                                view.templateHtml = '<div class="col-md-12" data-html="content">' + (json['template'] ? json['template'] : self.cardTemplate() ) + '</div>' ;
                                self.collectionView[id] = view;
                                view.render();
    
                                Radio.channel("modal").trigger("close.all", {});
                                currentModel.set("display", false);
                                toPageModel.set("display", true);

                            } else {
                                Utils.log(json);
                            }
                        })
                        .fail(function(e){Utils.log(e);})
                        .always(function(){self.toggleLoadPage(false)});

                }

            },



            toggleLoadPage : function(flag){
                this.toggleLoadPageFlag || (this.toggleLoadPageFlag = false);

                if (arguments.length == 0 || arguments[0]==null){
                    this.toggleLoadPageFlag = !this.toggleLoadPageFlag;
                } else {
                    this.toggleLoadPageFlag = !!flag;
                }
                if (!this.$loadPageView){
                    var zindex = Utils.nextSequence("DialogView-Zindex", 1000, 2)['value'];
                    this.$loadPageView = $('<div id="utils_toggle_load_page" class="loading common-hide" style="z-index:' + zindex + '"><div><img src="/img/loading.gif" ></div></div>');
                    this.$loadPageView.appendTo(document.body);
                }
                return Utils.slide(this.$loadPageView, this.toggleLoadPageFlag);

            },

            /**
             * 
             */
            render : function(){
                _.each(this.collectionView, function(view){
                    view.render();
                }, this);
                // _.each(this.dialogCollectionView['leftMenuView'], function(view){
                //     view.render();
                // }, this);

            }
        });

        this.app = new AppView({model : (new BaseModel(json))});
        this.app.render();

    };


    var config = {
        'config' : {
            'map' : {
                'workCarouselView' : {id : 'workCarouselView', type : 2}, //スライドショー
                'workCarouselView' : {id :'foodCarouselView', type : 2}, //スライドショー
                'homeView' : {   //ホーム
                    id : 'homeView',
                    pageid : 'homeView',
                    type : 4,
                    BaseView : [ {id : 'baseShopInfoCard' }, {id : 'subBaseShopInfoCard'} ],
                    CarouselView : [ {id : 'subWorkCarouselView'}, {id :'foodCarouselView'} ]
                },
                'foodMenuList' : {   //料理
                    id : 'foodMenuList',
                    pageid : 'foodMenuList',
                    type : 4,
                    BaseView : [ {id : 'footMenuListBaseCard'} ],
                    CarouselView :[ {id : 'footMenuListCarouselCard'} ] 
                },
                'noticeList' : {   //お知らせ
                    id : 'noticeList',
                    pageid : 'noticeList',
                    type : 0,
                    BaseView : [ ],
                    CarouselView :[ ] 
                },
                'loginView' : {   //ログイン
                    id : 'loginView',
                    pageid : 'loginView',
                    templateUrl : '/templete/login.txt',
                    type : 1,
                    BaseView : [ ],
                    CarouselView :[ ] 
                },
                'help' : {   //ヘルプ
                    id : 'help',
                    pageid : 'help',
                    type : 0,
                    BaseView : [ ],
                    CarouselView :[ ]
                },
                'todo' : {   //TODO
                    id : 'todo',
                    pageid : 'todo',
                    type : 0,
                    BaseView : [ ],
                    CarouselView :[ ],
                    display : true,
                    cache : false,
                    template : false,
                    templateUrl : '/?method=getTemplate&action=show&templateid=listTemplate',
                    // templateUrl : '/templete/listTemplate.txt',
                    templateData : null,
                    templateDataUrl : '/?',
                    beforeTemplate : false,
                    afterTemplate : false
                }
            }
        }
    };

    var core = new Core(config);
});
