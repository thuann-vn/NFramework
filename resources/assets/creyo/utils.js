import Vue from 'vue';

//Filters
Vue.filter('image', function (image, size) {
    if(image && size){
        var ext = /^.+\.([^.]+)$/.exec(image);
        ext = ext == null ? "" : ext[1];
        image = image.replace('.'+ext, '').replace(' ','%20');
        return '/storage/' + image + '-' + size + '.' + ext;
    }
    return '/storage/' + image;
})

Vue.filter('price', function (value) {
    if(value){
        value = value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        return value + ' ？';
    }
    return '0';
})


//Directives
Vue.directive('popover', {
    inserted: function (el) {
        // Focus the element
        $(el)["webuiPopover"]({
            trigger: "hover",
            placement: "top",
            width: 280,
            animation: "pop"
        })
    }
})

Vue.directive('simple-popover', {
    inserted: function (el) {
        // Focus the element
        $(el)["webuiPopover"]({
            trigger: "hover",
            animation: "pop"
        })
    }
})

//Cleave directive
import Cleave from 'cleave.js'

Vue.directive('cleave', {
    bind(el, binding) {
        const input = el.querySelector('input')
        input._vCleave = new Cleave(input, binding.value)
    },
    update(el, binding) {
        const input = el.querySelector('input')
        input._vCleave.destroy()
        input._vCleave = new Cleave(input, binding.value)
    },
    unbind(el) {
        const input = el.querySelector('input')
        input._vCleave.destroy()
    }
})