const eCategory = {
    init: function(){
        this.initSidebarToggle();
        this.initFilters();
        this.initSortForm();
    },
    initSidebarToggle: function(){
        $('.sidebar_toggleable').each(function(){
            var toggleable = $(this);
            toggleable.find('h3').click(function(){
                $(this).toggleClass('collapsed');
            })
        })
    },
    initFilters: function(){
        $('.filter-item').find(':checkbox').change(function(){
            $('#filter-form').find('input').each(function(){
                var name= $(this).attr('name');
                var items = '';
                $('[name="filter_'+name+'"]:checked').each(function(){
                    items+= ((items)?'~':'') +  $(this).val();
                });

                if(items){
                    $(this).val(items);
                }else{
                    $(this).remove();
                }
            })
            $('#filter-form').submit();
        });

        $('.remove-filter').click(function(e){
            e.preventDefault();
            $('.filter-item').find('#' + $(this).data('target')).prop('checked', false).trigger('change');
        })

        $('.clear-filters').click(function(e){
            e.preventDefault();

            $('.filter-item').find(':checkbox').prop('checked', false).trigger('change');
        })
    },
    initSortForm: function(){
        $('#searchSortDropdown').change(function(){
            $(this).parents('form').submit();
        })
    }
}

$(document).ready(function() {
    eCategory.init();
});
