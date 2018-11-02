import axios from 'axios';

export default {
    list(page){
        return axios.get('/images?page=' + page)
        .then(response => {
            return response.data
        });
    }
}