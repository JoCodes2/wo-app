@extends('Layouts.Base')

@section('content')
    <div class="container-fluid py-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Dashboard</h2>
                <p class="text-muted mb-0">Selamat datang kembali 👋</p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="row g-4 mb-4" id="stats-wrapper">

        </div>

        {{-- Chart + Status --}}
        <div class="row g-4 mb-4">

            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Pemesanan per Bulan</h5>
                        <canvas id="chartPemesanan" height="120"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Status Pemesanan</h5>

                        <div id="status-wrapper"></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Recent Orders --}}
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Pemesanan Terbaru</h5>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Layanan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody id="table-pemesanan">
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Loading...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {

            loadDashboard();

        });

        async function loadDashboard() {
            try {

                const response = await fetch('/dashboard/wo-stats', {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('HTTP Error ' + response.status);
                }

                const result = await response.json();

                console.log(result);

                renderStats(result.data.stats);
                renderStatus(result.data.status_pemesanan);
                renderTable(result.data.pemesanan_terbaru);
                renderChart(result.data.pemesanan_per_bulan);

            } catch (error) {

                console.error(error);

            }
        }

        function renderStats(stats) {
            let html = `

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Layanan</p>
                    <h3 class="fw-bold">${stats.total_layanan ?? 0}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-2">Total Galeri</p>
                    <h3 class="fw-bold">${stats.total_galeri ?? 0}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-2">Pemesanan</p>
                    <h3 class="fw-bold">${stats.total_pemesanan ?? 0}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <p class="text-muted mb-2">Revenue</p>
                    <h3 class="fw-bold">
                        Rp ${formatRupiah(stats.estimasi_revenue ?? 0)}
                    </h3>
                </div>
            </div>
        </div>

    `;

            $('#stats-wrapper').html(html);
        }

        function renderStatus(data) {
            let html = '';

            if (data.length === 0) {
                html = `<p class="text-muted">Belum ada data</p>`;
            }

            data.forEach(item => {

                html += `
            <div class="d-flex justify-content-between mb-3">
                <span class="text-capitalize">${item.status_pesanan}</span>
                <span class="fw-bold">${item.total}</span>
            </div>
        `;

            });

            $('#status-wrapper').html(html);
        }

        function renderTable(data) {
            let html = '';

            if (data.length === 0) {

                html = `
            <tr>
                <td colspan="5" class="text-center py-4">
                    Belum ada data
                </td>
            </tr>
        `;

            } else {

                data.forEach(item => {

                    html += `
                <tr>

                    <td>
                        ${item.nama_user}
                    </td>

                    <td>
                        ${item.nama_layanan}
                    </td>

                    <td>
                        Rp ${formatRupiah(item.harga)}
                    </td>

                    <td>
                        <span class="badge bg-primary">
                            ${item.status_pesanan}
                        </span>
                    </td>

                    <td>
                        ${item.created_at}
                    </td>

                </tr>
            `;

                });

            }

            $('#table-pemesanan').html(html);
        }

        function renderChart(data) {
            const labels = data.map(item => item.bulan);
            const totals = data.map(item => item.total);

            const ctx = document.getElementById('chartPemesanan');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pemesanan',
                        data: totals,
                        tension: 0.4
                    }]
                }
            });
        }

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }
    </script>
@endsection
