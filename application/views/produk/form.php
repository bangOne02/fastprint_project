<!DOCTYPE html>
<html>
<head>
    <title><?= isset($produk) ? 'Edit Produk' : 'Tambah Produk' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-6">
    <h3 class="text-2xl font-bold text-gray-700 mb-6">
        <?= isset($produk) ? 'Edit Produk' : 'Tambah Produk' ?>
    </h3>

    <form method="post" class="space-y-4">

        <!-- Nama Produk -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Nama Produk
            </label>
            <input type="text" name="nama_produk"
                   value="<?= isset($produk) ? $produk->nama_produk : set_value('nama_produk') ?>"
                   class="w-full rounded border border-gray-300 px-3 py-2
                          focus:outline-none focus:ring focus:ring-blue-300">
            <?= form_error('nama_produk', '<small class="text-red-500">', '</small>') ?>
        </div>

        <!-- Harga -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Harga
            </label>
            <input type="number" name="harga"
                   value="<?= isset($produk) ? $produk->harga : set_value('harga') ?>"
                   class="w-full rounded border border-gray-300 px-3 py-2
                          focus:outline-none focus:ring focus:ring-blue-300">
            <?= form_error('harga', '<small class="text-red-500">', '</small>') ?>
        </div>

        <!-- Kategori -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Kategori
            </label>
            <select name="kategori_id"
                    class="w-full rounded border border-gray-300 px-3 py-2
                           focus:outline-none focus:ring focus:ring-blue-300">
                <option value="1" <?= isset($produk) && $produk->kategori_id == 1 ? 'selected' : '' ?>>ATK</option>
                <option value="2" <?= isset($produk) && $produk->kategori_id == 2 ? 'selected' : '' ?>>Elektronik</option>
                <option value="3" <?= isset($produk) && $produk->kategori_id == 3 ? 'selected' : '' ?>>Konsumsi</option>
            </select>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Status
            </label>
            <select name="status_id"
                    class="w-full rounded border border-gray-300 px-3 py-2
                           focus:outline-none focus:ring focus:ring-blue-300">
                <option value="1" <?= isset($produk) && $produk->status_id == 1 ? 'selected' : '' ?>>Bisa Dijual</option>
                <option value="2" <?= isset($produk) && $produk->status_id == 2 ? 'selected' : '' ?>>Tidak Bisa Dijual</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex justify-between items-center pt-4">
            <a href="<?= site_url('produk') ?>"
               class="text-gray-500 hover:text-gray-700 hover:underline">
                ← Kembali
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition">
                Simpan
            </button>
        </div>

    </form>
</div>

</body>
</html>
