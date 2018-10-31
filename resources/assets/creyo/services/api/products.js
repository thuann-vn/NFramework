import axios from 'axios';

export default {
    status: [
        {code: 'FEATURED', name:'Featured'},
        {code: 'ACTIVE', name:'Available', isDefault: true},
        {code: 'DEACTIVE',name:'Hidden'}
    ],
    getProducts(page){
        return axios.get('/products?page=' + page)
        .then(response => {
            return response.data
        });
    }
}