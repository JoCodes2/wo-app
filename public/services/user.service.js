class userService {
    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: method,
                data: data,
                processData: data instanceof FormData ? false : true,
                contentType: data instanceof FormData ? false : 'application/x-www-form-urlencoded',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => resolve(response),
                error: (error) => reject(error),
            });
        });
    }

    async registrasi(formElement) {
        const $form = $(formElement);
        const submitButton = $form.find('#btnRegister');
        const originalText = submitButton.html();

        confirmAlert("Apakah Anda yakin data pendaftaran sudah benar?", async () => {
            try {
                const formData = new FormData(formElement);

                loadingAllert('Pendaftaran', 'Sedang memproses akun Anda...');
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i> Memproses...');

                const responseData = await this.ajaxRequest(`${appUrl}/wo/user/create`, 'POST', formData);

                Swal.close();

                if (responseData.data && responseData.data.role === 'wo') {
                    await successAlert("Pendaftaran berhasil, silahkan menunggu aktivasi akun 1x24 jam.")
                } else {
                    await successAlert("Pendaftaran berhasil")

                }

                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);

            } catch (error) {
                Swal.close();
                submitButton.attr('disabled', false).html(originalText);

                if (error.status === 422) {
                    const errors = error.responseJSON?.data ?? error.responseJSON?.errors;
                    const validator = $form.validate();

                    const errorList = {};
                    $.each(errors, function (field, messages) {
                        errorList[field] = messages[0];
                    });

                    validator.showErrors(errorList);
                    warningAlert("Mohon periksa kembali data yang Anda masukkan.");
                    return;
                }

                console.error("Detail Error:", error);
                errorAlert("Terjadi kesalahan sistem, silakan coba lagi nanti.");
            }
        });
    }
}

export default userService;
