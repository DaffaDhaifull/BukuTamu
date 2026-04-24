<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Buku Tamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        .text-center {
            text-align: center;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        h1 {
            font-size: 18px;
            margin: 0 0 10px 0;
            text-transform: uppercase;
        }
        .summary {
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }
        .summary-item {
            display: table-cell;
            width: 33.33%;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            text-align: center;
        }
        .summary-label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-size: 11px;
        }
        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.data-table th, table.data-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        table.data-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        table.data-table td.text-center {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="header text-center">
        <h1>LAPORAN BUKU TAMU OPEN HOUSE TIP</h1>
    </div>

    <div class="summary">
        <div class="summary-item">
            <span class="summary-label">TOTAL TAMU</span>
            <span class="summary-value">{{ number_format($totalGuests) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">TOTAL ASAL SEKOLAH</span>
            <span class="summary-value">{{ number_format($uniqueSchools) }}</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">SEKOLAH TERBANYAK</span>
            <span class="summary-value">
                {{ $topSchools->keys()->first() ?? '-' }}
                @if($topSchools->isNotEmpty())
                    ({{ $topSchools->first() }})
                @endif
            </span>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Tamu</th>
                <th width="30%">Nama Sekolah</th>
                <th width="20%">Nomor Telepon</th>
                <th width="20%">Tanggal Hadir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guests as $index => $guest)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->school }}</td>
                <td>{{ $guest->phone_number ?? '-' }}</td>
                <td>{{ $guest->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center" style="padding: 20px;">Tidak ada data tamu</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ date('d M Y H:i') }}
    </div>

</body>
</html>
