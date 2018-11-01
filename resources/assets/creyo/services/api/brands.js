import axios from 'axios';

export default {
    getBrands(){
        return axios.get('/productBrands')
        .then(response => {
            return response.data
        });
    }
}