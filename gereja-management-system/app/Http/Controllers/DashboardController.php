<?php

namespace App\Http\Controllers;

use App\Models\Jemaat;
use App\Models\Keuangan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with notifications and church information
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get all notifications for the user (if jemaat)
        $notifikasi = [];
        $notifikasi_belum_dibaca = 0;
        
        if ($user->role === 'jemaat') {
            $jemaat = $user->jemaat;
            $notifikasi = Notifikasi::where('jemaat_id', $jemaat->id)
                ->orderBy('tanggal_kirim', 'desc')
                ->paginate(10);
            
            $notifikasi_belum_dibaca = Notifikasi::where('jemaat_id', $jemaat->id)
                ->where('sudah_dibaca', false)
                ->count();
        } elseif ($user->isAdmin()) {
            // Admin dan Pendeta dapat melihat semua notifikasi
            $notifikasi = Notifikasi::orderBy('tanggal_kirim', 'desc')
                ->paginate(10);
        }
        
        // Get financial summary (untuk admin/pendeta)
        $keuangan_summary = [];
        if ($user->isAdmin()) {
            $keuangan_summary = [
                'total_pemasukan' => Keuangan::where('tipe', 'Pemasukan')
                    ->sum('jumlah'),
                'total_pengeluaran' => Keuangan::where('tipe', 'Pengeluaran')
                    ->sum('jumlah'),
                'saldo_akhir' => Keuangan::where('tipe', 'Pemasukan')
                    ->sum('jumlah') - Keuangan::where('tipe', 'Pengeluaran')
                    ->sum('jumlah'),
                'total_transaksi' => Keuangan::count(),
            ];
        }
        
        // Get church information
        $informasi_gereja = [
            'nama_gereja' => 'Gereja Kristen Indonesia',
            'alamat_gereja' => 'Jl. Gereja No. 123, Kota',
            'nomor_telepon' => '(021) 123-4567',
            'email' => 'gereja@example.com',
            'total_jemaat' => Jemaat::where('status_aktif', 'Aktif')->count(),
            'total_jemaat_tidak_aktif' => Jemaat::where('status_aktif', 'Tidak Aktif')->count(),
        ];
        
        // Get recent transactions (untuk admin)
        $transaksi_terbaru = [];
        if ($user->isAdmin()) {
            $transaksi_terbaru = Keuangan::orderBy('tanggal_transaksi', 'desc')
                ->take(5)
                ->get();
        }
        
        // Get latest announcements
        $pengumuman_terbaru = Notifikasi::where('tipe', 'Pengumuman')
            ->orderBy('tanggal_kirim', 'desc')
            ->take(5)
            ->get();
        
        return view('dashboard.index', [
            'user' => $user,
            'notifikasi' => $notifikasi,
            'notifikasi_belum_dibaca' => $notifikasi_belum_dibaca,
            'keuangan_summary' => $keuangan_summary,
            'informasi_gereja' => $informasi_gereja,
            'transaksi_terbaru' => $transaksi_terbaru,
            'pengumuman_terbaru' => $pengumuman_terbaru,
        ]);
    }
    
    /**
     * Display notification details
     */
    public function showNotifikasi($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        
        // Check if user has access
        if (Auth::user()->role === 'jemaat' && $notifikasi->jemaat_id !== Auth::user()->jemaat->id) {
            abort(403);
        }
        
        // Mark as read
        if (!$notifikasi->sudah_dibaca) {
            $notifikasi->update(['sudah_dibaca' => true]);
        }
        
        return view('dashboard.notifikasi-detail', [
            'notifikasi' => $notifikasi,
        ]);
    }
    
    /**
     * Display church information page
     */
    public function informasiGereja()
    {
        $informasi = [
            'nama_gereja' => 'Gereja Kristen Indonesia',
            'alamat_gereja' => 'Jl. Gereja No. 123, Kota',
            'nomor_telepon' => '(021) 123-4567',
            'email' => 'gereja@example.com',
            'tentang_gereja' => 'Gereja kami adalah tempat beribadat yang terbuka untuk semua umat Kristen.',
            'visi' => 'Menjadi gereja yang hidup, berkembang, dan melayani dengan sepenuh hati kepada Tuhan.',
            'misi' => [
                'Memberitakan Injil Yesus Kristus',
                'Membina jemaat dalam iman yang kuat',
                'Melayani masyarakat dengan kasih',
            ],
            'jadwal_ibadah' => [
                ['hari' => 'Minggu', 'waktu' => '09:00 - 11:00', 'keterangan' => 'Ibadah Umum'],
                ['hari' => 'Rabu', 'waktu' => '19:00 - 20:30', 'keterangan' => 'Doa Bersama'],
                ['hari' => 'Jumat', 'waktu' => '19:00 - 21:00', 'keterangan' => 'Persekutuan Pemuda'],
            ],
        ];
        
        $total_jemaat = Jemaat::where('status_aktif', 'Aktif')->count();
        
        return view('dashboard.informasi-gereja', [
            'informasi' => $informasi,
            'total_jemaat' => $total_jemaat,
        ]);
    }
    
    /**
     * Display all announcements
     */
    public function semuaPengumuman()
    {
        $pengumuman = Notifikasi::where('tipe', 'Pengumuman')
            ->orderBy('tanggal_kirim', 'desc')
            ->paginate(15);
        
        return view('dashboard.semua-pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }
}