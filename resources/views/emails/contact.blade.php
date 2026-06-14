<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            background-color: #ffffff;
        }
        .header {
            background-color: #065f46;
            color: white;
            padding: 20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .field {
            margin-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
        }
        .label {
            font-weight: bold;
            color: #065f46;
            display: block;
            text-transform: uppercase;
            font-size: 12px;
        }
        .value {
            font-size: 16px;
            margin-top: 5px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pesan Warga Baru</h1>
            <p>Melalui Website EcoHealth Mekarjaya</p>
        </div>
        
        <div class="content">
            <div class="field">
                <span class="label">Nama Pengirim:</span>
                <div class="value">{{ $details['name'] }}</div>
            </div>

            <div class="field">
                <span class="label">Alamat Email:</span>
                <div class="value">{{ $details['email'] }}</div>
            </div>

            <div class="field">
                <span class="label">Subjek:</span>
                <div class="value">{{ $details['subject'] }}</div>
            </div>

            <div class="field">
                <span class="label">Pesan:</span>
                <div class="value" style="white-space: pre-wrap;">{{ $details['message'] }}</div>
            </div>
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh sistem EcoHealth Mekarjaya.</p>
        </div>
    </div>
</body>
</html>