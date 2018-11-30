
/**
 * baseView
 */
define(['jquery', 'underscore','velocity','three'], 
    function ($, _, Three) {
        'use strict';

        var UtilsParams;
        if (!window['utils_UtilsParams']){
            var Paramas = function(){};
            UtilsParams = window['utils_UtilsParams'] = new Paramas();
            UtilsParams.sequenceValue = {};
            UtilsParams.loadingToggleFlag = false;

        }

        var configMap = window['utils_configMap'] || {};
        if (!window['utils_configMap']){
            window['utils_configMap'] = configMap;
        }

        return {
            config : function(val){
                val && (_.extend(configMap, val));
            },

            nextSequence : function(/* string not null **/key, /* int **/start, /* int **/step){
                if (!key) return void 0;
                
                var sequenceValue = UtilsParams.sequenceValue;
                if (start == null) start = 0;
                if (!step || step < 0) step = 1;

                sequenceValue[key] || (sequenceValue[key] = {
                    start : start,
                    step : step,
                    value : start
                });
                sequenceValue[key]['value'] += sequenceValue[key]['step'];
                return _.clone(sequenceValue[key]);
            },

            nowSequence : function(/* string not null **/key){
                var sequenceValue = UtilsParams.sequenceValue;
                if (key && sequenceValue[key]){
                    return sequenceValue[key]['value']
                }
                return void 0;
            },

            /**
             * サーバーからテキストを取得
             * URL : URLが必要
             * dataType : HTMLの場合、テキストを返却と想定する。
             * @param {*} json 
             */
            ajaxTxt : function(json){
                
                return $.ajax({
                    url: json['url'],
                    type: json['method'] || "POST",
                    data : json['params'] || "",
                    cache: false,
                    dataType: "HTML",
                    timeout : 10000, //10S
                    //processData: false,  // 不处理数据
                    //contentType: false   // 不设置内容类型
                });

            },

            /**
             * サーバーからJSONデータを取得
             * URL : URLが必要
             * dataType : HTML以外の場合、テキストを返却と想定する。
             * @param {*} json 
             */
            ajaxJson : function(json){
                return $.ajax({
                    url: json['url'],
                    type: json['method'] || "POST",
                    data : json['params'] || "",
                    cache: false,
                    dataType: "JSON",
                    timeout : 10000, //10S
                    //processData: false,  // 不处理数据
                    //contentType: false   // 不设置内容类型
                });

            },


            jsonToUrl : function(json){
                if (!json) return '/';

                var url = '';
                _.each(json, function(value, key){
                    if (value == null){
                        url += '&' + key + '=';
                    } else if (_.isArray(value)){
                        for(var i=0; i<value.length; i++){
                            url += '&' + key + '=' + encodeURIComponent(value[i]);
                        }
                    } else {
                        url += '&' + key + '=' + encodeURIComponent(value);
                    }
                });

                return url.length == 0 ? '/' : ('/' + url.slice(1))
            },

            /**
             * データと要素により、ラジオ送信するとき、渡すデータを取得
             * 
             * @param {*} data {fromPageid, fromType }
             * @param {*} $target 
             */
            radioData : function(data, $target){

                var elData = {};
                var returnVal = {};
                if($target){
                    var pageid = $target.data('pageid');           //画面ID(TYPE:0/2/3)
                    var modalid = $target.data('modalid');         //画面ID(TYPE:1)
                    var url = $target.data('url');                 //テンプレートURL
                    var params = $target.data('params');           //テンプレートとテンプレート項目のパラメタ取得するフォーム
                    var formid = $target.data('formid');           //テンプレートとテンプレート項目のパラメタ取得するフォーム
                    var historyback = $target.data('historyback'); //戻るフラグ
                    var dataType = $target.data('dataType'); //戻るフラグ

                    //戻る場合
                    if (historyback){
                        elData['historyback'] = !!historyback;
                    } else {

                        //To Page Id 
                        if(pageid){
                            elData['toPageid'] = pageid;
                            // elData['toType'] = 0;
    
                        } else if (modalid){
                            elData['toPageid'] = modalid;
                            elData['toType'] = 2;
                        }

                        //template Url
                        if (url){
                            elData['url'] = url;
                        }

                        //template data params 
                        if (formid){
                            elData['params'] = $('#' + formid).serialize();
                        } else if (params){
                            elData['params'] = params;
                        }

                        //dataType
                        if (dataType){
                            elData['dataType'] = dataType;
                        }

                    }
                }

                //戻る場合
                if (elData['historyback']){
                    return _.extend(elData);

                }

                //例: a=b&b=t
                if (elData['params'] && configMap && configMap['token']){
                    //add token
                    elData['params'] += '&token=' + configMap['token']
                }

                //ベースデータ
                if (configMap['map'] && data['toPageid'] && configMap['map'][data['toPageid']]){
                    returnVal = _.extend({}, configMap['map'][data['toPageid']]);
                } else if (configMap['map'] && elData['toPageid'] && configMap['map'][elData['toPageid']]){
                    returnVal = _.extend({}, configMap['map'][elData['toPageid']]);
                }

                // baseConfig < el.data < from < data
                return _.extend(returnVal ,elData, data);
                
            },

            /**
             * ページ切り替え
             * 
             * return Jquery.Deferred
             */
            toggleWrapperPage : function($from, flag){
                
                var deferred = new $.Deferred();
                if (!!flag){
                    $from.velocity({"right":"0%"},{
                        begin : function(){
                            $from.addClass('wrapper-content-changeing');
                            $from.css("right","-100%");
                            $from.removeClass("common-hide");
                        }
                        ,complete : function(){
                            $from.removeClass('wrapper-content-changeing');
                            $from.css("right","0%");
                            deferred.resolve();
                        }
    
                    });

                } else {
                    $from.velocity({"right":"100%"},{
                        begin : function(){
                            $from.addClass('wrapper-content-changeing');
                            $from.css("right","0%");
                        }
                        ,complete : function(){
                            $from.css("right","100%");
                            $from.addClass("common-hide");
                            $from.removeClass('wrapper-content-changeing');
                            deferred.resolve();
                        }
    
                    });

                }
                return deferred.promise();
            },

            /**
             * ページ切り替え
             * 
             * return Jquery.Deferred
             */
            slide : function($from, flag){
                
                var deferred = new $.Deferred();

                if (flag){
                    //表示
                    $from.velocity({"right":"0%"},{
                        begin : function(){
                            $from.css("right","-100%");
                            $from.removeClass("common-hide");
                        }
                        ,complete : function(){
                            $from.css("right","0%");
                            deferred.resolve();
                        }
    
                    });

                } else {
                    //非表示
                    $from.velocity({"right":"100%"},{
                        begin : function(){
                            $from.css("right","0%");
                        }
                        ,complete : function(){
                            $from.css("right","100%");
                            $from.addClass("common-hide");
                            deferred.resolve();
                        }
    
                    });

                }
                return deferred.promise();
            },

            /**
             * 
             * アニメション
             * 
             * @param {*} from 
             * @param {*} to 
             */
            slideTo : function($from, $to, next){
                var deferred1 = new $.Deferred();
                var deferred2 = new $.Deferred();

                var self = this;

                next = next ===true ? true : false;
        
                var sliderStyleFrom = {
                    "from" : {left: "0%"},
                    "to" : {left: next ? "100%" : "-100%"}
                };
                var sliderStyleTo = {
                    "from" : {left: next ? "-100%" : "100%"},
                    "to" : {left: "0%"}
                };
                
                $from.velocity(sliderStyleFrom.to, {
                    begin : function(){
                        $from.css("left","0%");
                    },
                    complete : function(){
                        deferred1.resolve();
        
                    }
                });
                
                $to.velocity(sliderStyleTo.to, {
                    begin : function(){
                        self.status = 2;
                        $to.css("left",(next ? "-100%" : "100%"));
                    },
                    complete : function(){
                        deferred2.resolve();

                    }
                });

                return $.when(deferred1.promise(),deferred2.promise());

            },

            debug : function(){

                // console.log(">>>------------------------------------------------------------------------");
                // for(var i=0; i<arguments.length; i++){
                //     console.log(arguments[i]);
                // }
                // console.log("------------------------------------------------------------------------<<<");

            },

            info : function(event){
                // console.log(event);
            },

            warn : function(event){
                // console.log(event);
            },

            log : function(event){
                console.log(event);
            },

            todo : function(){
    
            }

        }
    }
);
