class profilWoService {
    async ajaxRequest(url, method, data = null) {
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

    async getProfilData(userId) {
        try {
            const response = await this.ajaxRequest(`${appUrl}/wo/user/get/${userId}`, 'GET');
            const data = response.data;
            const wo = data.profil_wo;

            $('#display_nama_wo').text(wo.nama_wo);
            $('#display_email').text(data.email);
            $('#display_status').text(data.status_akun === 'aktif' ? 'Akun Aktif' : 'Pending');
            $('#display_tahun').text(wo.tahun_bergabung || '-');
            $('#display_kontak').text(wo.kontak);
            if (wo.foto_logo) $('#display_logo').attr('src', `${appUrl}/uploads/logo/${wo.foto_logo}`);

            $('#user_id').val(data.id);
            $('#wo_id').val(wo.id);
            $('#nama_lengkap').val(data.nama_lengkap);
            $('#email').val(data.email);
            $('#no_hp').val(data.no_hp);

            $('#nama_wo').val(wo.nama_wo);
            $('#biodata_pengelola').val(wo.biodata_pengelola);
            $('#alamat_wo').val(wo.alamat_wo);
            $('#deskripsi_wo').val(wo.deskripsi_wo);
            $('#kontak').val(wo.kontak);
            $('#sosial_media').val(wo.sosial_media);

        } catch (error) {
            console.error(error);
            errorAlert("Gagal mengambil data profil.");
        }
    }

    async updateProfil(formElement, userId) {
        const submitButton = $(formElement).find('#btnSimpanProfil');
        const originalText = submitButton.html();

        confirmAlert("Apakah Anda yakin ingin memperbarui profil WO?", async () => {
            try {
                const formData = new FormData(formElement);
                loadingAllert('Memperbarui Profil', 'Mohon tunggu sebentar...');
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin me-2"></i>Menyimpan...');

                let responseData = await this.ajaxRequest(`${appUrl}/wo/user/update/${userId}`, 'POST', formData);
                console.log(responseData);

                Swal.close();
                await successAlert("Profil Wedding Organizer berhasil diperbarui.");
                location.reload();

            } catch (error) {
                Swal.close();
                submitButton.attr('disabled', false).html(originalText);

                if (error.status === 422) {
                    warningAlert("Validasi gagal, mohon periksa kembali inputan Anda.");
                } else {
                    errorAlert("Gagal memperbarui profil.");
                }
            }
        });
    }
}

export default profilWoService;
