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
