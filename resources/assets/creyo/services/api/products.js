import axios from 'axios';

export default {
    status: [
        {code: 'FEATURED', name:'Featured'},
        {code: 'ACTIVE', name:'Available', isDefault: true},
        {code: 'DEACTIVE',name:'Hidden'}
    ],
    list(page){
        return axios.get('/products?page=' + page)
        .then(response => {
            return response.data
        });
    },
    show(id){
        return axios.get('/products/' + id)
            .then(response => {
                return response.data
            });
    }
}