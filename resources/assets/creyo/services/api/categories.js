import axios from 'axios';

export default {
    list(){
        return axios.get('/productCategories')
        .then(response => {
            return response.data
        });
    }
}