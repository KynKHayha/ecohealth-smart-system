<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Tanaman Desa Mekarjaya</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #444; pb: 10px; mb: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { bg-color: #f2f2f2; font-weight: bold; }
        .footer { margin-top: 50px; text-align: right; }
        .stempel { margin-top: 60px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin-bottom: 5px;">ECOHEALTH SYSTEM - DESA MEKARJAYA</h2>
        <p style="margin-top: 0;">Laporan Ketersediaan Tanaman Obat Keluarga (TOGA)</p>
        <p style="font-size: 10px;">Dicetak pada: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tanaman</th>
                <th>Kategori</th>
                <th>Lokasi RW</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plants as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama_tanaman }}</td>
                <td>{{ $p->kategori }}</td>
                <td>RW 0{{ $p->rw }}</td>
                <td>{{ $p->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <strong>Total Keseluruhan Stok: {{ $total_bibit }} Bibit</strong>
    </div>

    <div class="footer">
        <p>Mekarjaya, {{ $tanggal }}</p>
        <p>Admin EcoHealth,</p>
        <div class="stempel">( .................................... )</div>
    </div>
</body>
</html>