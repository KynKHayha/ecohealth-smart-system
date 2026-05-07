<!DOCTYPE html>
<html>
<head>
    <title>Print Label - {{ $plant->nama_tanaman }}</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
        .label-box {
            width: 8cm;
            height: 5cm;
            border: 2px solid #064e3b;
            padding: 15px;
            display: flex;
            align-items: center;
            font-family: sans-serif;
            border-radius: 10px;
        }
        .qr-side { flex: 1; }
        .info-side { flex: 2; padding-left: 15px; }
        h1 { margin: 0; font-size: 18px; color: #064e3b; }
        p { margin: 5px 0; font-size: 12px; color: #666; }
    </style>
</head>
<body onload="window.print()">
    <div class="label-box">
        <div class="qr-side">
            {!! QrCode::size(100)->generate(route('plant.detail', $plant->slug)) !!}
        </div>
        <div class="info-side">
            <p style="font-size: 8px; font-weight: bold; color: #10b981;">ECOHEALTH MEKARJAYA</p>
            <h1>{{ $plant->nama_tanaman }}</h1>
            <p><i>{{ $plant->nama_latin }}</i></p>
            <p>Wilayah: RW 0{{ $plant->rw }}</p>
        </div>
    </div>
    <button class="no-print" onclick="window.print()" style="margin-top: 20px;">Cetak Lagi</button>
</body>
</html>