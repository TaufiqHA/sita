<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Jadwal Seminar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .logo {
            max-height: 80px;
            margin-bottom: 10px;
        }
        h1 {
            color: #0056b3;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .recipient {
            margin-bottom: 20px;
        }
        .seminar-details {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .seminar-details h2 {
            color: #0056b3;
            font-size: 18px;
            margin-top: 0;
        }
        .examiners {
            margin-bottom: 20px;
        }
        .requirements {
            background-color: #e6f7ff;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .requirements h2 {
            color: #0056b3;
            font-size: 18px;
            margin-top: 0;
        }
        .requirements ol {
            padding-left: 20px;
        }
        .footer {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
        .contact {
            margin-top: 20px;
            font-style: italic;
        }
        .signature {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pengumuman Jadwal Seminar {{ $seminar->jenis_seminar }}</h1>
    </div>

    <p>Berdasarkan hasil koordinasi dengan dosen penguji, kami informasikan bahwa seminar {{ $seminar->jenis_seminar }} Anda telah dijadwalkan dengan rincian sebagai berikut:</p>

    <div class="seminar-details">
        <h2>Detail Seminar:</h2>
        <table>
            <tr>
                <td width="150"><strong>Tanggal</strong></td>
                <td>: {{ $seminar->tanggal }}</td>
            </tr>
            <tr>
                <td><strong>Ruangan</strong></td>
                <td>: {{ $seminar->ruangan }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Seminar</strong></td>
                <td>: Seminar {{ $seminar->jenis_seminar }}</td>
            </tr>
        </table>
    </div>

    <div class="examiners">
        <h2>Tim Penguji:</h2>
        <ol>
            <li><strong>{{ $seminar->penguji1 }}
            <li><strong>{{ $seminar->penguji2 }}
        </ol>
    </div>

    <p>Demikian informasi ini kami sampaikan. Selamat mempersiapkan seminar dan semoga sukses!</p>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
    </div>
</body>
</html>