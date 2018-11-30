(function(factory){
    var jQuery = jQuery || window.jQuery;
    factory(jQuery);
})(function($){
    
    var NavBar = function(){
        var _self = this;
        this.defaultMenuId = 'home'
        this.oldActiveMenuId = null;

        var state = UtilsHistory.getState();
        if(state){
            UtilsHistory.popStateCallBackList = [function(){
                var state = UtilsHistory.getState();
                _self.activeMenu(state.data.currentMenuId);
            }];
            this.activeMenu(state.data.currentMenuId);
        }

        $('[data-menu-id]').on('click', function(){
            consoleLog("menu click...");
            var menuId = $(this).data('menuId');
            _self.activeMenu(menuId);
            UtilsHistory.pushState({currentMenuId:menuId});
        });

        $("[data-event='login']").on('click', function(){
        })

    };

    NavBar.prototype.activeMenu = function(id){
        consoleLog("activeMenu run...");
        var activeId = id ? id : this.defaultMenuId;
        if(activeId !== this.oldActiveMenuId){
            $("[data-main-menu-id='"+ activeId + "']").addClass('active');
            if(this.oldActiveMenuId){
                $("[data-main-menu-id='"+this.oldActiveMenuId + "']").removeClass('active');
            }
            this.oldActiveMenuId = activeId;
        }

    };
    
    //state ={currentMenuId}
    NavBar.prototype.changeHistory = function(json){
        consoleLog("changeHistory run and data:");
        consoleLog(json);
        if(json){
            var state = History.getState();
            for(var key in json){
                state[key] = json[key];
            }
            consoleLog(state);

        }
    
    };
    
    // var changeHistoryState = function(navBar){

    //     consoleLog("changeHistoryState run...");
    //     var state = History.getState();
    //     navBar.activeMenu(state.currentMenuId);
    //     console.log(state);

    // };



    $(document).ready(function(){
        consoleLog("document ready run...");
        var navBar = new NavBar();
    });

});
