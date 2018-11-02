import axios from 'axios';

export default {
    list(){
        return axios.get('/productBrands')
        .then(response => {
            return response.data
        });
    }
}