const eCMS = {
    init: function(){
        this.initImagePicker();
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
    }
}

$(document).ready(function() {
    eCMS.init();
});
