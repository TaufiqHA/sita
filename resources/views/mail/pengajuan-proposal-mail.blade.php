<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .body {
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }
        .body p {
            margin: 10px 0;
        }
        .details {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
        }
        .details p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
            background: #f4f4f4;
        }
        .button {
            display: inline-block;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            Penerimaan Pengajuan Seminar {{ $mailData['jenis'] }}
        </div>
        <div class="body">
            <p>Dengan ini kami menginformasikan bahwa pengajuan seminar {{ $mailData['jenis'] }} Anda telah diterima. Berikut adalah detail seminar Anda:</p>
            <div class="details">
                <p><strong>Tempat:</strong> {{ $mailData['tempat'] }} </p>
                <p><strong>Tanggal:</strong> {{ $mailData['tanggal'] }} </p>
                <p><strong>Waktu:</strong> {{ $mailData['waktu'] }} </p>
            </div>
            <p>Harap hadir tepat waktu dan membawa dokumen yang diperlukan. Jika ada perubahan atau pertanyaan, jangan ragu untuk menghubungi kami.</p>
            <p>Salam hangat,</p>
            <p><strong>Tim Seminar</strong></p>
        </div>
        <div class="footer">
            &copy; 2024 Tim Seminar. Semua Hak Dilindungi.
        </div>
    </div>
</body>
</html>
