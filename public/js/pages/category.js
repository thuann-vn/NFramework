const eCategory = {
    init: function(){
        this.initSidebarToggle();
        this.initFilters();
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
            $('#filter-form').submit();
        })
    }
}

$(document).ready(function() {
    eCategory.init();
});
