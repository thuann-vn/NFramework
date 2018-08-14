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

        //Select2
        $('select').select2();

        //Init price input
        $('.price-format-input').each(function () {
            var oldElement = $(this);
            var newElement = $(oldElement[0].outerHTML).attr('name',oldElement.attr('name') + '_priceinput').attr('id',oldElement.attr('id') + '_priceinput');
            oldElement.after(newElement);
            oldElement.hide();
            // When user select text in the document, also abort.
            var selection = window.getSelection().toString();
            if (selection !== '') {
                return;
            }

            newElement.on('keyup',function(event){
                // When the arrow keys are pressed, abort.
                if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                    return;
                }

                var $this = $(this);

                // Get the value.
                var value = $this.val();

                value = value.replace(/[\D\s\._\-]+/g, "");
                value = value ? parseInt(value, 10) : 0;

                $this.val(function () {
                    return ( value === 0 ) ? "" : value.toLocaleString("en-US");
                });

                $this.prev().val(value);
            }).trigger('keyup');
        });
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

        $('.delete-attribute, .delete-attribute-value').click(function(e){
            e.preventDefault();

            var deleteHref= $(this);

            swal({
                title: Lang.get('voyager.generic.are_you_sure'),
                text: Lang.get('voyager.generic.are_you_sure_delete'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    eCMS.block();
                    deleteHref.next('form').submit();
                }
            });
        })
    },
    initVariantForm: function(){
        $('#generateVariants').click(function(e){
            eCMS.block();
        });

        $('.product-variants').find('.collapse-content').each(function(){
            var variantEl = $(this);
            var variantHeaderEl = $('.product-variants').find('.collapse-head[data-target="#'+ variantEl.attr('id') +'"]');
            variantEl.find('input[name="name"]').change(function(){
                variantHeaderEl.find('h4').text($(this).val());
            })
        });

        $('.delete-property').click(function(e){
            e.preventDefault();

            var deleteHref= $(this);

            swal({
                title: Lang.get('voyager.generic.are_you_sure'),
                text: Lang.get('voyager.generic.are_you_sure_delete'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        eCMS.block();
                        deleteHref.next('form').submit();
                    }
                });
        });


        $('.delete-sku').click(function(e){
            e.preventDefault();

            var deleteTarget= $(this).attr('href');

            swal({
                title: Lang.get('voyager.generic.are_you_sure'),
                text: Lang.get('voyager.generic.are_you_sure_delete'),
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        eCMS.block();
                        $(deleteTarget).submit();
                    }
                });
        })
    }
}

$(document).ready(function() {
    eProductManager.init();
});
