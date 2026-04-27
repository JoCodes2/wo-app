import ProposalService from "../services/proposal-pengajuan.service.js";

$(document).ready(function () {
    const service = new ProposalService();
    const kegiatanId = $('#kegiatan_id').val();

    const formatTanggalIndo = (dateString) => {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    };

    const formatWita = (timeString) => {
        if (!timeString) return '00:00';
        const [hours, minutes] = timeString.split(':');
        return `${hours}:${minutes} WITA`;
    };

    const loadDetailKegiatan = async () => {
        try {
            const response = await $.get(`${appUrl}/ikp/kegiatan/get/${kegiatanId}`);
            const data = response.data;

            // Format Data
            const tglKegiatan = formatTanggalIndo(data.tanggal_kegiatan);
            const waktuMulai = formatWita(data.waktu_mulai);
            const waktuSelesai = formatWita(data.waktu_selesai);

            // Mapping Kategori Media menjadi Badges
            const kategoriHtml = data.kategori_media && data.kategori_media.length > 0
                ? data.kategori_media.map(kat => `
                    <span class="badge bg-label-primary me-1 mb-1 px-2 border-0 shadow-none">
                        <i class="fa-solid fa-tag me-1 small"></i>${kat.nama_kategori}
                    </span>
                `).join('')
                : '<span class="text-muted small italic">Kebutuhan umum</span>';

            const html = `
            <div class="mb-4">
                <label class="text-muted d-block small text-uppercase fw-bold" style="font-size: 0.65rem;">Judul Kegiatan</label>
                <h5 class="fw-bold text-primary mb-1">${data.judul_kegiatan}</h5>
                <span class="badge bg-label-success text-uppercase" style="font-size: 0.7rem;">
                    <i class="fa-solid fa-circle-check me-1"></i>${data.status_kegiatan}
                </span>
            </div>

            <div class="row g-3">
                <div class="col-12">
                    <div class="d-flex align-items-center p-2 rounded bg-light border-start border-primary border-3">
                        <i class="fa-solid fa-building text-primary me-3 fs-5" style="width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Asal Instansi</small>
                            <span class="fw-bold text-dark small">${data.asal_instansi || '-'}</span>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="d-flex align-items-center p-2 rounded bg-light border-start border-info border-3">
                        <i class="fa-solid fa-envelope-open-text text-info me-3 fs-5" style="width: 20px;"></i>
                        <div>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Nomor Surat</small>
                            <span class="fw-bold text-dark small">${data.nomor_surat || '-'}</span>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <label class="text-muted d-block small"><i class="fa-solid fa-calendar-day me-1"></i> Tanggal</label>
                    <p class="mb-0 fw-bold text-dark small">${tglKegiatan}</p>
                </div>
                <div class="col-6">
                    <label class="text-muted d-block small"><i class="fa-solid fa-clock me-1"></i> Waktu</label>
                    <p class="mb-0 fw-bold text-dark small">${waktuMulai} - ${waktuSelesai}</p>
                </div>

                <div class="col-12 text-truncate">
                    <label class="text-muted d-block small"><i class="fa-solid fa-location-dot me-1 text-danger"></i> Lokasi Pelaksanaan</label>
                    <p class="mb-0 fw-bold text-dark small">${data.lokasi || '-'}</p>
                </div>

                <div class="col-12">
                    <label class="text-muted d-block small text-uppercase fw-bold mb-2" style="font-size: 0.65rem;">Kebutuhan Media Partner:</label>
                    <div class="d-flex flex-wrap">
                        ${kategoriHtml}
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="p-3 rounded-3" style="background-color: #f0f2ff; border: 1px dashed #696cff;">
                        <label class="text-primary d-block small fw-bold text-uppercase mb-2">Deskripsi Kegiatan:</label>
                        <div class="text-muted" style="font-size: 0.85rem; text-align: justify; line-height: 1.5;">
                            ${data.deskripsi_kegiatan || 'Tidak ada deskripsi rincian untuk kegiatan ini.'}
                        </div>
                    </div>
                </div>
            </div>`;

            $('#detailKegiatanWrapper').hide().html(html).fadeIn();
        } catch (error) {
            $('#detailKegiatanWrapper').html(`
            <div class="alert alert-danger d-flex align-items-center small">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> Gagal memuat data kegiatan.
            </div>`);
        }
    };

    loadDetailKegiatan();

    $.validator.addMethod('extension', function (value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    }, 'Ekstensi file tidak valid.');

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param);
    }, 'Ukuran file maksimal 2 MB');
    $('#formSimpanProposal').validate({
        ignore: [],
        rules: {
            judul_proposal: {
                required: true,
                maxlength: 255
            },
            deskripsi_proposal: {
                required: true,
                minlength: 20
            },
            file_proposal: {
                required: true,
                extension: "pdf",
                filesize: 2097152
            }
        },
        messages: {
            judul_proposal: {
                required: "Silakan masukkan judul proposal peliputan Anda",
                maxlength: "Judul terlalu panjang"
            },
            deskripsi_proposal: {
                required: "Deskripsi singkat rencana peliputan wajib diisi",
                minlength: "Berikan deskripsi yang lebih detail (minimal 20 karakter)"
            },
            file_proposal: {
                required: "File dokumen proposal (PDF) wajib diunggah",
                extension: "Hanya dokumen berformat PDF yang diperbolehkan",
                filesize: "Ukuran file terlalu besar. Maksimal 2 MB"
            }
        },
        errorElement: 'small',
        errorClass: 'text-danger',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        }
    });
    $('#btnProsesProposal').on('click', function (e) {
        e.preventDefault();

        if ($('#formSimpanProposal').valid()) {
            service.createData($('#formSimpanProposal')[0]);
        } else {
            const firstError = $('.text-danger:visible').first();
            if (firstError.length) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 150
                }, 500);
            }
        }
    });
});
