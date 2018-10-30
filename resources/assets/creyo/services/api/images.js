import axios from 'axios';

export default {
    getImages(page){
        return axios.get('/images?page=' + page)
        .then(response => {
            return response.data
        });
    }
}