/**
 * CarouselView
 */
define(['base/baseView','underscore','utils','backbone.radio','base/baseCollection','base/baseModel'], 
    function (BaseView, _, Utils, Radio, BaseCollection, BaseModel) {
        return BaseView.extend({

            templete : false, //TODO

            /**
             * イベントの紐付
             * */
            events : {
                "click [data-carouse='prev']" : "prevPage",
                "click [data-carouse='next']" : "nextPage",
                "click [data-slide-to]" : "slideTo",
            },

            /**
             * 初期化
             */
            initialize : function (){

                this.super && this.super();

                _.bindAll(this, 'prevPage', 'nextPage', 'slideTo', 'stop', 'play', 'autoPlay');


                this.model || (this.model = new BaseModel());
                this.model.set('type', 2);

                //０：AUTO、1：非表示のアニメション、２：表示、３：表示のアニメション
                if (!this.model.has("status")){
                    this.model.set("status", 0); //auto
                }
                if (!this.model.has("interval")){
                    this.model.set("interval", 3000);
                }

                if (!this.model.has("next")){
                    this.model.set("next", true);
                }
                //item model
                this.collection || (this.collection = new BaseCollection());

                var items = this.$el.find('.carousel-inner .carousel-item');

                //Itemを追加する。
                _.each(items, function(item, index){
                    var $item = $(item);
                    if ($item.hasClass('clone')){
                        this.$cloneItem = $(item);
                    } else {
                        var data = {id : this.collection.length+1};
                        data['$el'] = $(item);
                        var model = new BaseModel(data);
                        if ($item.hasClass('active')) {
                            this.activeIndex = data.id;;
                            model.set('active', true);
                        }
                        this.collection.add(model);

                    }
                },this);

                this.activeIndex || (this.activeIndex = 1);
                this.timeoutID = null;
                this.autoPlay();

            },

            autoPlay : function(){
                var self = this;
                self.timeoutID = setTimeout(function(){
                    self.next ? self.nextPage() : self.prevPage();
                }, self.model.get('interval'));

            },


            play : function($from,$to,next){
                var self = this;

                //３：表示のアニメション
                if (self.model.get("status") == 3){
                    return ;
                }
                self.model.set("status", 3);

                if(typeof self.timeoutID === 'number'){
                    clearTimeout(self.timeoutID);
                }
                self.timeoutID = null;

                //スライドショー
                Utils.slideTo($from,$to,next).then(function(){
                    self.$el.find("[data-slide-to]").removeClass('active');
                    self.$el.find("[data-slide-to='" + self.activeIndex + "']").addClass('active');
                    self.model.set('status', 0);
                    self.autoPlay();
                    // self.timeoutID = setTimeout(function(){
                    // }, self.model.get('interval'));
                });
            },

            prevPage : function (){

                var currentIndex = this.activeIndex;

                nextIndex = currentIndex - 1;

                if (nextIndex <= 0){
                    nextIndex = this.collection.length;
                }

                // console.log("from : " + currentIndex + ", to : " + nextIndex);
                var $from = this.collection.get(currentIndex).get('$el');
                var $to = this.collection.get(nextIndex).get('$el');

                this.activeIndex = nextIndex;
                var next = this.next = false;

                this.play($from, $to, next);

            },

            nextPage : function (){
                
                var currentIndex = this.activeIndex;

                nextIndex = currentIndex + 1;

                if (nextIndex > this.collection.length){
                    nextIndex = 1;
                }

                $from = this.collection.get(currentIndex).get('$el');
                $to = this.collection.get(nextIndex).get('$el');

                this.activeIndex = nextIndex;
                var next = this.next = true;

                this.play($from, $to, next);

            },

            slideTo : function (event){

                var $target = $(event.currentTarget);
                var nextIndex = $target.data('slideTo');
                if (!this.collection.get(nextIndex)){
                    return this;
                }

                $to = this.collection.get(nextIndex).get('$el');

                var currentIndex = this.activeIndex;
                $from = this.collection.get(currentIndex).get('$el');
                this.activeIndex = nextIndex;

                this.next = currentIndex < nextIndex;
                this.play($from, $to, this.next);


            },

            stop : function (){
                if(typeof self.timeoutID === 'number'){
                    clearTimeout(self.timeoutID);
                }
            }

        });
    }
);