<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f2f3f5;
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #dadce0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .header {
            background-color: #1a73e8;
            color: white;
            padding: 24px;
            text-align: center;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .logo {
            margin-bottom: 12px;
        }

        .content {
            padding: 32px 24px;
            text-align: left;
        }

        h2 {
            font-size: 18px;
            color: #202124;
            margin: 0 0 12px;
        }

        .info {
            font-size: 14px;
            color: #5f6368;
            margin-bottom: 16px;
        }

        .message {
            font-size: 15px;
            line-height: 1.6;
            color: #202124;
            margin-bottom: 24px;
        }

        .btn {
            display: inline-block;
            background-color: #1a73e8;
            color: white;
            padding: 12px 24px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 24px 0;
        }

        .footer {
            font-size: 12px;
            color: #5f6368;
            text-align: center;
            padding: 16px 24px;
            background-color: #fafafa;
        }

        .footer a {
            color: #1a73e8;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <!-- Ganti logo di bawah dengan logo instansi Anda -->
                <!-- <img src="{{ secure_asset('assets/img/logo/logogaruda.png') }}" alt="Logo" width="100"> -->
            </div>
            <h1>Layanan E-Learning</h1>
        </div>

        <div class="content">
            <h2>Informasi</h2>
            <div class="info">
                Jenis Layanan: <strong>{{ $data['jenis'] ?? 'Tidak tersedia' }}</strong><br>
            </div>

            <div class="message">
                {{ $data['text'] ?? 'Tidak ada pesan.' }}
            </div>

            <a href="http://127.0.0.1:8000/auth" class="btn">{{ $buttonText ?? 'Lihat Detail' }}</a>

            <div class="divider"></div>

            <div class="footer">
                &copy; {{ date('Y') }} E-Learning<br>
                {{-- <a href="mailto:supportlayanankecamatankuba@gmail.com">supportlayanankecamatankuba@gmail.com</a> --}}
                <a href="">Email Support E-Learning</a> <br>
                <a href="">WhatsApp Support Layanan E-Learning</a>
            </div>
        </div>
    </div>
</body>
</html>
