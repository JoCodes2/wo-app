class ProposalService {
    constructor() { }

    ajaxRequest(url, method, data = null) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url,
                method,
                data,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => resolve(response),
                error: (xhr) => reject(xhr)
            });
        });
    }

    async createData(formElement) {
        const submitButton = $('#btnProsesProposal');
        const originalText = submitButton.html();

        confirmAlert('Pastikan data proposal sudah benar?', async () => {
            try {
                loadingAllert('Sedang memproses pengajuan...');
                submitButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengajukan...');

                const formData = new FormData(formElement);
                await this.ajaxRequest(`${appUrl}/ikp/proposal_pengajuan/create`, 'POST', formData);

                Swal.close();
                await successAlert('Proposal berhasil diajukan');
                window.location.href = `${appUrl}/`;
            } catch (error) {
                Swal.close();
                const status = error.status;
                const response = error.responseJSON;

                if (status === 422) {
                    warningAlert('Periksa kembali inputan form Anda');
                } else if (status === 409) {
                    warningAlert(response?.message || 'Anda sudah mengajukan proposal di kegiatan ini');
                } else {
                    errorAlert(response?.message || 'Gagal mengajukan proposal');
                }
            } finally {
                submitButton.attr('disabled', false).html(originalText);
            }
        }, 'Ajukan Proposal?');
    }
}

export default ProposalService;
