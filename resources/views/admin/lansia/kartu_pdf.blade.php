<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', sans-serif; 
            background-color: #f0f4f8; 
            margin: 0; padding: 0; 
        }
        .canvas { padding: 50px; }

        /* KARTU UTAMA */
        .card {
            width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* AKSEN DEKORASI */
        .deco-circle {
            position: absolute;
            top: -50px; right: -50px;
            width: 200px; height: 200px;
            background: linear-gradient(135deg, #10b981 0%, #064e3b 100%);
            border-radius: 50%;
            z-index: 1;
        }

        /* HEADER */
        .header {
            padding: 40px;
            position: relative;
            z-index: 2;
        }
        .brand { font-size: 32px; font-weight: 800; color: #062C26; margin: 0; letter-spacing: -1.5px; }
        .brand span { color: #10b981; }
        .tagline { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: 3px; margin-top: 5px; }

        /* BODY */
        .body { padding: 0 40px 30px 40px; position: relative; z-index: 2; }
        
        .status-pill {
            display: inline-block;
            background: #be123c;
            color: #ffffff;
            padding: 6px 18px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(190, 18, 60, 0.2);
        }

        .data-row { margin-bottom: 25px; }
        .label { font-size: 9px; font-weight: bold; color: #94a3b8; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 8px; }
        .val-name { font-size: 26px; color: #0f172a; font-weight: 800; margin: 0; }
        .val-nik { font-family: 'Courier', monospace; font-size: 22px; color: #334155; font-weight: bold; letter-spacing: 4px; }

        /* REKOMENDASI BOX */
        .suggestion-card {
            background: #f8fafc;
            border-radius: 20px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            position: relative;
        }
        .suggestion-card h4 { 
            margin: 0 0 10px 0; font-size: 11px; color: #059669; 
            text-transform: uppercase; letter-spacing: 1px;
        }
        .suggestion-text { font-size: 15px; color: #1e293b; font-style: italic; line-height: 1.6; font-weight: 600; }

        /* FOOTER */
        .footer {
            background: #062C26;
            padding: 30px 40px;
            color: #ffffff;
        }
        .footer-table { width: 100%; border-collapse: collapse; }
        .footer-info { font-size: 10px; opacity: 0.7; line-height: 1.6; }
        
        .qr-container {
            background: #ffffff;
            padding: 10px;
            border-radius: 15px;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="canvas">
    <div class="card">
        <div class="deco-circle"></div>
        
        <div class="header">
            <h1 class="brand">Eco<span>Health</span></h1>
            <div class="tagline">Medical Monitoring System</div>
        </div>

        <div class="body">
            <div class="status-pill">{{ strtoupper($lansia->penyakit) }}</div>

            <div class="data-row">
                <div class="label">Nama Pasien</div>
                <div class="val-name">{{ $lansia->nama }}</div>
            </div>

            <div class="data-row">
                <div class="label">NIK Identitas</div>
                <div class="val-nik">{{ $lansia->nik }}</div>
            </div>

            <div class="suggestion-card">
                <h4>🌿 Rekomendasi Terapi</h4>
                <div class="suggestion-text">"{{ $saran }}"</div>
            </div>
        </div>

        <div class="footer">
            <table class="footer-table">
                <tr>
                    <td style="vertical-align: middle;">
                        <div class="footer-info">
                            <strong>DESA MEKARJAYA TERPADU</strong><br>
                            Kartu ini adalah dokumen digital resmi.<br>
                            Generated on: {{ $tanggal }}
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <div class="qr-container">
                            <!-- Pastikan variabel $qrCode dikirim dari Controller dalam format Base64 -->
                            <img src="{{ $qrCode }}" width="70" height="70">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

</body>
</html>