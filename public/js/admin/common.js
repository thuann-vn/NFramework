const eCMS = {
    init: function(){
        this.initImagePicker();
        this.initLanguage();
    },
    initLanguage: function(){
        Lang.setLocale('en');
    },
    initImagePicker: function(){
        $(".image-picker").find('input').change(function() {
            var self = this;
            if (self.files && self.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(self).next('img').attr('src', e.target.result);
                }

                reader.readAsDataURL(self.files[0]);
            }
        });
    },
    block: function(){
        $.blockUI({
            message: '<div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div>',
            css: {
                backgroundColor: 'transparent',
                zIndex: '1001',
                border: 'none'
            }
        });
    },
    unblock:function(){
        $.unblockUI();
    }
}

$(document).ready(function() {
    eCMS.init();
});
