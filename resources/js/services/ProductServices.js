import http from '../http-common';

class ProductServices {
    
    async products(data) {
        try {
            const response = await http.get(`products?page=${data.page}&category=${data.category}&search=${data.search}`);
            return response;
        } catch (error) {
            console.error("Error", error.response);
            return false;
        }
    }

    async deleteProduct(id) {
        try {
            const response = await http.delete(`products/delete/${id}`);
            return response;
        } catch (error) {
            console.error("Error", error.response);
            return false;
        }
    }
    
    async createProduct(data, config) {
        try {
            const response = await http.post(`products/create`, data, config);
            return response;
        } catch (error) {
            console.error("Error", error.response);
            return false;
        }
    }

    async editProduct(id) {
        try {
            const response = await http.get(`products/edit/${id}`);
            return response;
        } catch (error) {
            console.error("Error", error.response);
            return false;
        }
    }

    async updateProduct(id, data, config) {
        try {
            const response = await http.post(`products/update/${id}`, data, config);
            return response;
        } catch (error) {
            console.error("Error", error.response);
            return false;
        }
    }

}

export default new ProductServices();