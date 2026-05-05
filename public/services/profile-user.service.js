class profileUserService {
    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            const isFormData = data instanceof FormData;
            $.ajax({
                url: url,
                method: method,
                data: data,
                processData: isFormData ? false : true,
                contentType: isFormData ? false : 'application/x-www-form-urlencoded',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => resolve(response),
                error: (error) => reject(error),
            });
        });
    }

    async getProfileData(userId) {
        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/user/get/${userId}`, 'GET');
            const user = response.data;

            $('#display_nama_lengkap, #side_nama_lengkap').text(user.nama_lengkap);
            $('#display_role').text(user.role === 'user' ? 'Mempelai' : user.role.toUpperCase());
            $('#side_email, #email').val(user.email).text(user.email);
            $('#side_no_hp, #no_hp').val(user.no_hp).text(user.no_hp);
            $('#nama_lengkap').val(user.nama_lengkap);

            const date = new Date(user.created_at);
            $('#display_joined').text(date.toLocaleDateString('id-ID', { year: 'numeric', month: 'long' }));

            const statusBadge = $('#display_status');
            statusBadge.removeClass('bg-green-100 text-green-700 bg-yellow-100 text-yellow-700');
            if (user.status_akun === 'aktif') {
                statusBadge.addClass('bg-green-100 text-green-700').text('Akun Aktif');
            } else {
                statusBadge.addClass('bg-yellow-100 text-yellow-700').text('Pending');
            }

            return user;
        } catch (error) {
            console.error(error);
            errorAlert("Gagal memuat profil.");
        }
    }

    async updateProfile(formElement, userId) {
        const $form = $(formElement);
        const submitButton = $form.find('#btnSimpanProfile');
        const originalText = submitButton.html();

        confirmAlert("Simpan perubahan profil Anda?", async () => {
            try {
                const formData = new FormData(formElement);
                loadingAllert('Memproses', 'Mohon tunggu...');
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

                await this.ajaxRequest(`${appUrl}/wo/user/update/${userId}`, 'POST', formData);

                Swal.close();
                await successAlert("Profil berhasil diperbarui");
                $('#password').val('');
                this.getProfileData(userId);
            } catch (error) {
                Swal.close();
                if (error.status === 422) {
                    const errors = error.responseJSON?.data ?? error.responseJSON?.errors;
                    const validator = $form.validate();
                    const errorList = {};
                    $.each(errors, function (field, messages) { errorList[field] = messages[0]; });
                    validator.showErrors(errorList);
                    warningAlert("Data tidak valid");
                } else {
                    errorAlert("Terjadi kesalahan");
                }
            } finally {
                submitButton.attr('disabled', false).html(originalText);
            }
        });
    }
}

export default profileUserService;
