<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Judul Skripsi Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4b7bec;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #666;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .info-table td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .button {
            display: inline-block;
            background-color: #4b7bec;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .congrats {
            font-weight: bold;
            color: #2ecc71;
            font-size: 18px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="content">
        <p class="congrats">Judul Skripsi Anda Telah Disetujui</p>
        
        <p>Dengan ini kami informasikan bahwa judul skripsi yang Anda ajukan telah <strong>DISETUJUI</strong> oleh Dosen Pembimbing dan Koordinator Skripsi pada tanggal <strong><?php echo date('d F Y', strtotime($judul->tanggal_disetujui)); ?></strong>.</p>
        
        <table class="info-table">
            <tr>
                <td>Nama</td>
                <td><?php echo $mahasiswa->name ?? '123456789'; ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td><?php echo $mahasiswa->mahasiswaDetail->nim ?? '123456789'; ?></td>
            </tr>
            <tr>
                <td>Judul Skripsi</td>
                <td><?php echo $judul->judul; ?></td>
            </tr>
            <tr>
                <td>Dosen Pembimbing 1</td>
                <td><?php echo $judul->dospem1->name ?? 'Nama Dosen Pembimbing 1'; ?></td>
            </tr>
            <tr>
                <td>Dosen Pembimbing 2</td>
                <td><?php echo $judul->dospem2->name ?? 'Nama Dosen Pembimbing 2'; ?></td>
            </tr>
            <tr>
                <td>Tanggal Disetujui</td>
                <td><?php echo date('d F Y', strtotime($judul->tanggal_disetujui)); ?></td>
            </tr>
        </table>
        
        <p>Silakan masuk ke sistem informasi untuk melihat detail lengkap</p>
        <a href="http://localhost:8000/auth" class="button">Akses Sistem Informasi Tugas Akhir</a>
        
        <p>Atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>
    </div>
    
    <div class="footer">
        <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.<br>
        Jika ada pertanyaan, silakan hubungi koordinator skripsi di skripsi@university-example.ac.id</p>
        <p>&copy; <?php echo date('Y'); ?> Universitas Example. All rights reserved.</p>
    </div>
</body>
</html>