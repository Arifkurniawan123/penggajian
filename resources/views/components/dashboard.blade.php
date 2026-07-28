<div>
    <!-- Welcome -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}! 👋</h4>
            <p class="text-muted">Ringkasan data sistem penggajian</p>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Total Karyawan</div>
                        <div class="number">{{ $totalKaryawan }}</div>
                    </div>
                    <div class="icon blue"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Total Departemen</div>
                        <div class="number">{{ $totalDepartemen }}</div>
                    </div>
                    <div class="icon green"><i class="fas fa-building"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Total Jabatan</div>
                        <div class="number">{{ $totalJabatan }}</div>
                    </div>
                    <div class="icon orange"><i class="fas fa-briefcase"></i></div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="label">Total Penggajian</div>
                        <div class="number">{{ $totalPenggajian }}</div>
                    </div>
                    <div class="icon purple"><i class="fas fa-money-bill-wave"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart & Recent -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-chart-bar me-2"></i>Statistik Penggajian per Bulan</h6>
                </div>
                <div class="card-body">
                    <canvas id="gajiChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-clock me-2"></i>Penggajian Terbaru</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($recentPenggajian as $p)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <small class="fw-bold">{{ $p->karyawan->nama ?? 'N/A' }}</small>
                                <br>
                                <small class="text-muted">{{ $p->periode }}</small>
                            </div>
                            <span class="badge bg-success">Rp {{ number_format($p->total_gaji, 0, ',', '.') }}</span>
                        </div>
                        @empty
                        <div class="list-group-item text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x d-block mb-2"></i>
                            Belum ada data penggajian
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('gajiChart').getContext('2d');
        
        const labels = @json($chartLabels);
        const data = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Gaji (Rp)',
                    data: data,
                    backgroundColor: 'rgba(52, 152, 219, 0.7)',
                    borderColor: '#3498db',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush