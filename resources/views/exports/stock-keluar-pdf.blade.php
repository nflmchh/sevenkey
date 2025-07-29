<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stock Keluar</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px 8px; font-size: 12px; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3>Laporan Stock Keluar</h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Barcode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Size</th>
                <th>Warna</th>
                <th>QTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->tanggal }}</td>
                <td>{{ $row->barcode }}</td>
                <td>{{ $row->nama_barang }}</td>
                <td>{{ $row->kategori }}</td>
                <td>{{ $row->size }}</td>
                <td>{{ $row->warna }}</td>
                <td>{{ $row->qty }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
