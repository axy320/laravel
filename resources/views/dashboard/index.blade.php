{{-- Dashboard - Halaman utama dengan statistik & grafik --}}
@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Selamat datang di Sistem Perpustakaan')

@section('content')
<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <!-- Total Siswa -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="stat-card blue fade-in stagger-1">
            <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
            <div class="stat-value">{{ number_format($totalSiswa) }}</div>
            <div class="stat-label">Total Siswa</div>
        </div>
    </div>

    <!-- Total Pengunjung -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="stat-card purple fade-in stagger-2">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-value">{{ number_format($totalPengunjung) }}</div>
            <div class="stat-label">Total Pengunjung</div>
        </div>
    </div>

    <!-- Total Buku -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="stat-card green fade-in stagger-3">
            <div class="stat-icon"><i class="fas fa-book"></i></div>
            <div class="stat-value">{{ number_format($totalBuku) }}</div>
            <div class="stat-label">Total Buku</div>
        </div>
    </div>

    <!-- Total Peminjaman -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="stat-card cyan fade-in stagger-4">
            <div class="stat-icon"><i class="fas fa-exchange-alt"></i></div>
            <div class="stat-value">{{ number_format($totalPeminjaman) }}</div>
            <div class="stat-label">Total Peminjaman</div>
        </div>
    </div>

    <!-- Buku Dipinjam -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="stat-card yellow fade-in stagger-5">
            <div class="stat-icon"><i class="fas fa-hand-holding-heart"></i></div>
            <div class="stat-value">{{ number_format($bukuDipinjam) }}</div>
            <div class="stat-label">Buku Dipinjam</div>
        </div>
    </div>

    <!-- Terlambat -->
    <div class="col-xl-3 col-lg-4 col-md-6">
        <div class="stat-card red fade-in stagger-6">
            <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-value">{{ number_format($terlambat) }}</div>
            <div class="stat-label">Terlambat</div>
        </div>
    </div>

    <!-- Total Denda -->
    <div class="col-xl-6 col-lg-12 col-md-12">
        <div class="stat-card pink fade-in stagger-7">
            <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
            <div class="stat-value">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
            <div class="stat-label">Total Denda Terkumpul</div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-3 mb-4">
    <!-- Peminjaman Chart -->
    <div class="col-lg-8">
        <div class="modern-card fade-in">
            <div class="card-header-custom">
                <h5><i class="fas fa-chart-line me-2" style="color:var(--primary)"></i>Statistik Peminjaman</h5>
                <span class="badge-modern badge-primary">6 Bulan Terakhir</span>
            </div>
            <div class="card-body-custom">
                <canvas id="peminjamanChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <!-- Kategori Chart -->
    <div class="col-lg-4">
        <div class="modern-card fade-in">
            <div class="card-header-custom">
                <h5><i class="fas fa-chart-pie me-2" style="color:var(--secondary)"></i>Kategori Buku</h5>
            </div>
            <div class="card-body-custom">
                <canvas id="kategoriChart" height="280"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Peminjaman -->
<div class="row g-3">
    <div class="col-12">
        <div class="modern-card fade-in">
            <div class="card-header-custom">
                <h5><i class="fas fa-clock me-2" style="color:var(--warning)"></i>Peminjaman Terbaru</h5>
                <a href="{{ route('peminjamans.index') }}" class="btn-modern btn-primary-custom btn-sm-modern">
                    <i class="fas fa-arrow-right"></i> Lihat Semua
                </a>
            </div>
            <div class="card-body-custom" style="padding:0;">
                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamanTerbaru as $p)
                            <tr>
                                <td>
                                    <div style="font-weight:600;">{{ $p->peminjam_nama }}</div>
                                </td>
                                <td>{{ $p->buku->judul_buku ?? 'N/A' }}</td>
                                <td>{{ $p->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td>{{ $p->tanggal_kembali->format('d/m/Y') }}</td>
                                <td>
                                    @if($p->status === 'dipinjam')
                                        @if($p->tanggal_kembali < now()->startOfDay())
                                            <span class="badge-modern badge-danger"><i class="fas fa-exclamation-circle"></i> Terlambat</span>
                                        @else
                                            <span class="badge-modern badge-warning"><i class="fas fa-clock"></i> Dipinjam</span>
                                        @endif
                                    @elseif($p->status === 'terlambat')
                                        <span class="badge-modern badge-danger"><i class="fas fa-exclamation-circle"></i> Terlambat</span>
                                    @else
                                        <span class="badge-modern badge-success"><i class="fas fa-check-circle"></i> Dikembalikan</span>
                                    @endif
                                </td>
                                <td style="font-weight:600; color: {{ $p->hitungDenda() > 0 ? 'var(--danger)' : 'var(--success)' }}">
                                    Rp {{ number_format($p->hitungDenda(), 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Belum ada data peminjaman</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ============ PEMINJAMAN CHART ============
    const peminjamanCtx = document.getElementById('peminjamanChart').getContext('2d');

    // Gradient fill
    const gradient = peminjamanCtx.createLinearGradient(0, 0, 0, 280);
    gradient.addColorStop(0, 'rgba(79, 70, 229, 0.3)');
    gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)');

    new Chart(peminjamanCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Peminjaman',
                data: {!! json_encode($chartData) !!},
                fill: true,
                backgroundColor: gradient,
                borderColor: '#4f46e5',
                borderWidth: 3,
                pointBackgroundColor: '#4f46e5',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#f1f5f9',
                    bodyColor: '#94a3b8',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(148,163,184,0.1)', drawBorder: false },
                    ticks: { color: '#94a3b8', font: { size: 12 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 12 } }
                }
            }
        }
    });

    // ============ KATEGORI CHART ============
    const kategoriCtx = document.getElementById('kategoriChart').getContext('2d');
    const kategoriLabels = {!! json_encode($kategoriBuku->keys()) !!};
    const kategoriData = {!! json_encode($kategoriBuku->values()) !!};

    const colors = ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#06b6d4', '#8b5cf6', '#ec4899', '#14b8a6'];

    new Chart(kategoriCtx, {
        type: 'doughnut',
        data: {
            labels: kategoriLabels.length ? kategoriLabels : ['Belum ada data'],
            datasets: [{
                data: kategoriData.length ? kategoriData : [1],
                backgroundColor: kategoriData.length ? colors.slice(0, kategoriLabels.length) : ['#334155'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#94a3b8',
                        font: { size: 12 },
                        padding: 16,
                        usePointStyle: true,
                        pointStyleWidth: 8,
                    }
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 8,
                }
            }
        }
    });
</script>
@endsection