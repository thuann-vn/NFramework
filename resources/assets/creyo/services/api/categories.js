import axios from 'axios';

export default {
    getCategories(){
        return axios.get('/productCategories')
        .then(response => {
            return response.data
        });
    }
}