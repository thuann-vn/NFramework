const eProductManager = {
    init: function(){
        this.initComponents();
        this.initPropertyForm();
        this.initAttributeForm();
        this.initVariantForm();
    },
    initComponents: function(){
        $('.toggleswitch').bootstrapToggle();

        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function (idx, elt) {
            if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            }
        });

        //Init slug
        $('.side-body input[data-slug-origin]').each(function (i, el) {
            $(el).slugify();
        });

        //Init multilingual
        $('.side-body').multilingual({"editing": true});
    },
    initPropertyForm: function(){
        $(".property_select_new").select2({
            tags: true,
            width: 'resolve',
            placeholder: $(this).attr('placeholder')
        });

        $(".property_select_new").val('').trigger('change');
    },
    initAttributeForm: function(){
        $(".attribute_select_new").select2({
            tags: true,
            width: 'resolve',
            placeholder: $(this).attr('placeholder')
        });

        $(".attribute_select_value").select2({
            tags: true,
            multiple: 'multiple',
            width: 'resolve',
            placeholder: $(this).attr('placeholder')
        });

        $(".attribute_select_new").val('').trigger('change');

        //On change attribute form
        $('.attribute_select_new').change(function(){
            //Clear value options
            $(".attribute_select_value").empty().trigger("change");

            //Call ajax
            var name = $(this).val();
            $.ajax('/admin/get-attribute-value/' + name).then(function(response){
                console.log(response);
                response.forEach(function (item) {
                    // create the option and append to Select2
                    var option= new Option(item.value, item.value, false, false);
                    $(".attribute_select_value").append(option);
                })

                $(".attribute_select_value").val('').trigger('change').focus().select2('open')
            });
        });
    },
    initVariantForm: function(){
        $('#generateVariants').click(function(e){
            e.preventDefault();
            $.ajax($(this).attr('href')).then(function(response){
                console.log(response);
            });
        })
    }
}

$(document).ready(function() {
    eProductManager.init();
});
