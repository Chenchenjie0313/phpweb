
/**
 * 
 */
define(['backbone','view/base/baseModel'], 
    function (Backbone, BaseModel) {
        return Backbone.Collection.extend({
            model: BaseModel
        });
    }
);
