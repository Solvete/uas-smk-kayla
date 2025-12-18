<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Struk Pembayaran - SMK Multicomp</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px; /* lebih kecil */
        }

        .container {
            width: 100%;
            padding: 10px 20px; /* diperkecil */
        }

        .header {
            text-align: center;
            margin-bottom: 5px; /* kecil */
        }

        .logo {
            width: 70px; /* diperkecil */
            margin-bottom: 5px;
        }

        .divider {
            border-bottom: 1px solid #000;
            margin: 5px 0 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
        }

        table th, table td {
            padding: 5px 6px;
            border: 1px solid #000;
        }

        table th {
            background: #f2f2f2;
        }

        .signature {
            text-align: center;
            margin-top: 20px; /* biar hemat space */
        }

    </style>
</head>

<body>

    <div class="container">

        <div class="header">
            <img src="{{ public_path('compiled/jpg/SMK_Multicomp_Logo.png') }}" class="logo">
            <h3 style="margin:0;">SMK MULTICOMP</h3>
            <p style="margin:2px 0;">Kel. Kalimulya Kec. Cilodong Depok, 16471</p>
            <p style="margin:0;">Telp: (021) 77823607 – smkmulticomp.sch.id</p>
            <h4 style="margin:5px 0;">STRUK PEMBAYARAN</h4>
        </div>

        <div class="divider"></div>

        {{-- ==== INFORMASI SISWA ==== --}}
        <table>
            <tr>
                <th width="25%">Nama Siswa</th>
                <td>{{ $transaction->student->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $transaction->student->schoolClass->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Pembayaran</th>
                <td>{{ $transaction->date_paid }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>{{ $transaction->student->schoolMajor->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $transaction->paymentCategory->name ?? '-' }}</td>
            </tr>
        </table>

        {{-- ==== DETAIL PEMBAYARAN ==== --}}
        <h4 style="margin-top: 10px;">Detail Pembayaran</h4>
        <table>
            <tr>
                <th>Nominal</th>
                <td>Rp {{ number_format($transaction->amount,0,',','.') }}</td>
            </tr>
        </table>

        {{-- ==== STATUS LUNAS ==== --}}
        <div style="text-align:center; margin-top:20px;">
            <h2 style="font-size:20px; font-weight:bold; letter-spacing:2px;">L U N A S</h2>
        </div>

        {{-- ==== TTD PETUGAS ==== --}}
        <div class="signature">
            <p>Petugas Sekolah</p>
            <br><br>
            <p>_______________________</p>
        </div>

    </div>

</body>
</html>
