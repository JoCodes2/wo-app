class loginService {
    constructor() {
        this.isSubmitting = false;
    }

    async ajaxRequest(url, method, formData) {
        try {
            const response = await $.ajax({
                url: url,
                type: method,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            return response;
        } catch (jqXHR) {
            throw {
                status: jqXHR.status,
                responseJSON: jqXHR.responseJSON || {}
            };
        }
    }

    async login(e) {
        if (this.isSubmitting) return;
        this.isSubmitting = true;

        try {
            Swal.fire({
                title: 'Loading...',
                html: 'Please wait while processing...',
                allowOutsideClick: false,
                showCancelButton: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const formData = new FormData(e.target);
            const responseData = await this.ajaxRequest(`/simmp/login`, 'POST', formData);
            if (responseData.status === 'success') {
                Swal.close();
                successAlert().then(() => {
                    window.location.href = `/`;
                });
            }
        } catch (error) {
            Swal.close();
            console.error('Error:', error);

            if (error.status === 401) {
                warningAlert("Login gagal.");
            } else if (error.status === 422) {
                warningAlert("Mohon periksa kembali inputan Anda.");
            } else if (error.status === 419) {
                warningAlert("Request dobel / CSRF token tidak valid.");
            } else {
                errorAlert("Terjadi kesalahan sistem.");
            }
        } finally {
            this.isSubmitting = false;
        }
    }
}

export default loginService;
