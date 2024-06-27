<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Laporan Denda</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * { font-family: "Poppins", sans-serif; }

        body { margin: 0; }

        p { margin: 0; }

        .header-elements {
            border-collapse: collapse;
            outline: none;
            width: 100%;
        }

        .header-elements td {
            border: none;
            border-style: none;
        }

        .header-right {
            min-width: 100px;
        }

        .header-right-elements {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        .main-table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table class="header-elements">
        <tr>
            <td>
                <h2>Laporan Denda</h2>
                <p>Dicetak pada <?php echo date("l, d F Y") ?></p>
            </td>
            <td>
                <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M204.055 213.905q-18.12-5.28-34.61-9a146 146 0 0 1-6.78-44.33c0-65.61 42.17-118.8 94.19-118.8s94.15 53.14 94.15 118.76a146.3 146.3 0 0 1-6.16 42.32q-20.52 4.3-43.72 11.05c-22 6.42-39.79 12.78-48.56 16.05c-8.72-3.27-26.51-9.63-48.51-16.05m-127.95 84.94a55.16 55.16 0 1 0 55.16 55.15a55.16 55.16 0 0 0-55.16-55.15m359.79 0a55.16 55.16 0 1 0 55.16 55.15a55.16 55.16 0 0 0-55.15-55.15zm-71.15 55.15a71.24 71.24 0 0 1 42.26-65v-77.55c-64.49 0-154.44 35.64-154.44 35.64s-89.95-35.64-154.44-35.64v74.92a71.14 71.14 0 0 1 0 135.28v7c64.49 0 154.44 41.58 154.44 41.58s89.99-41.55 154.44-41.55v-9.68a71.24 71.24 0 0 1-42.26-65" />
                </svg>
                <h2 style="text-align: center">Informasi Perpustakaan</h2>
                <p style="text-align: center">SD Negeri 2 Madu</p>
            </td>
        </tr>
    </table>
    <div style="width: 100%; height: 50px;"></div>
    <div class="content">
        <table class="main-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Anggota</th>
                    <th>Kelas</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($dataDenda))
                    @foreach ($dataDenda as $index => $denda)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>{{ $denda->user->name ?? 'John Doe' }}</td>
                            <td style="text-align: center;">{{ $denda->user->kelas ?? 'XII RPL' }}</td>
                            <td style="text-align: right;">Rp. {{ number_format($denda->nominal ?? 10000, 0, '.', '.') }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td style="text-align: center;">1</td>
                        <td>John Doe</td>
                        <td style="text-align: center;">XII RPL</td>
                        <td style="text-align: right;">Rp 10.000</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>
