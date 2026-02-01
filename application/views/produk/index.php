<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-700">Data Produk</h1>
        <a href="<?= site_url('produk/tambah') ?>"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Tambah Produk
        </a>
    </div>

    <table class="w-full border border-gray-200">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-3 text-left">Nama Produk</th>
                <th class="p-3 text-left">Harga</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produk as $p): ?>
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3"><?= $p->nama_produk ?></td>
                <td class="p-3">Rp <?= number_format($p->harga) ?></td>
                <td class="p-3 text-center space-x-2">
                    <a href="<?= site_url('produk/edit/'.$p->id_produk) ?>"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                        Edit
                    </a>
                    <a href="<?= site_url('produk/hapus/'.$p->id_produk) ?>"
                       onclick="return confirm('Yakin ingin menghapus data ini?')"
                       class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

</body>
</html>
