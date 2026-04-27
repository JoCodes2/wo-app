class TiketService {
    constructor() {
        this.appUrl = window.appUrl;
    }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            const isFormData = data instanceof FormData;
            $.ajax({
                url,
                method,
                data,
                processData: isFormData ? false : (method === 'GET' ? true : false),
                contentType: isFormData ? false : (method === 'GET' ? 'application/x-www-form-urlencoded' : false),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    resolve(response);
                },
                error: (xhr) => {
                    reject(xhr);
                }
            });
        });
    }

    async createTicket(formData) {
        try {
            return await this.ajaxRequest(`${this.appUrl}/ikp/tiket_tugas/create`, 'POST', formData);
        } catch (error) {
            console.error('Gagal membuat tiket:', error);
            throw error;
        }
    }

    async getMyTickets() {
        try {
            return await this.ajaxRequest(`${this.appUrl}/ikp/tiket_tugas/my-tickets`, 'GET');
        } catch (error) {
            console.error('Gagal mengambil data tiket:', error);
            throw error;
        }
    }
}

export default TiketService;
