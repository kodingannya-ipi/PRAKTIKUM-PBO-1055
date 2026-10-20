<?php
require_once 'Product.php';

$error  = '';
$detail = null;
$form   = ['id' => '', 'nama' => '', 'harga' => '', 'stok' => '']; // kosong = mode tambah

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';

    // delete
    if ($aksi === 'hapus') {
        Product::delete((int) ($_POST['id'] ?? 0));
        header('Location: index.php');
        exit;
    }

    // create atau update (tergantung ada id atau tidak)
    if ($aksi === 'simpan') {
        $id    = (int) ($_POST['id'] ?? 0);
        $nama  = trim($_POST['nama'] ?? '');
        $harga = $_POST['harga'] ?? '';
        $stok  = $_POST['stok'] ?? '';

        if ($nama === '' || !is_numeric($harga) || $harga < 0 || !is_numeric($stok) || $stok < 0) {
            $error = 'Nama wajib diisi, harga dan stok harus angka (tidak boleh negatif).';
            $form  = ['id' => $id ?: '', 'nama' => $nama, 'harga' => $harga, 'stok' => $stok];
        } else {
            $produk = new Product();
            $produk->setNama($nama)->setHarga((int) $harga)->setStok((int) $stok);

            if ($id > 0) {
                $produk->update($id);   // update
            } else {
                $produk->save();        // create
            }
            header('Location: index.php');
            exit;
        }
    }
} else {
    // klik "edit" akan mengisi form dengan data lama (findById)
    if (isset($_GET['edit'])) {
        $row = Product::findById((int) $_GET['edit']);
        if ($row) { $form = $row; } else { $error = 'Produk tidak ditemukan.'; }
    }
    // klik "detail" akan menampilkan satu produk (findById)
    if (isset($_GET['lihat'])) {
        $detail = Product::findById((int) $_GET['lihat']);
        if (!$detail) { $error = 'Produk tidak ditemukan.'; }
    }
}

// read all
$daftar = Product::findAll();
$modeEdit = $form['id'] !== '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Produk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', 'Segoe UI', Arial, sans-serif;
            max-width: 780px; margin: 30px auto; padding: 0 16px 40px;
            color: #44506b;
            background: #eaf2fd;
        }
        h1 { text-align: center; color: #5b86d6; font-weight: 800; margin-bottom: 24px; }
        h2 { color: #6f97e0; font-weight: 700; font-size: 1.2rem; margin: 26px 0 10px; }

        /* form tambah/edit */
        form:not(.inline) {
            background: #fff;
            padding: 18px 22px; border-radius: 16px;
            box-shadow: 0 4px 14px rgba(120, 160, 220, 0.18);
        }
        label { font-weight: 600; font-size: 0.9rem; }
        input {
            font-family: inherit; font-size: 1rem; color: #44506b;
            padding: 9px 12px; margin: 4px 0 12px; width: 100%; box-sizing: border-box;
            border: 1.5px solid #d3e1f8; border-radius: 10px; background: #fff;
        }
        input:focus { outline: none; border-color: #7aa2e8; box-shadow: 0 0 0 3px #d9e7fc; }

        /* tombol */
        button, .btn {
            font-family: inherit; font-size: 0.85rem; font-weight: 600;
            padding: 6px 14px; cursor: pointer; text-decoration: none; display: inline-block;
            border: 1.5px solid #bcd1f5; background: #fff; color: #5b86d6; border-radius: 20px;
            transition: all 0.15s;
        }
        button:hover, .btn:hover { background: #eef4ff; transform: translateY(-1px); }
        button.utama {
            font-size: 0.95rem; padding: 9px 22px; color: #fff; border: none;
            background: #7aa2e8;
            box-shadow: 0 3px 10px rgba(122, 162, 232, 0.4);
        }
        button.utama:hover { background: #6a95e0; }
        form.inline { display: inline; background: none; padding: 0; box-shadow: none; }
        form.inline button { color: #8593b3; border-color: #d3dcee; }
        form.inline button:hover { background: #f1f4fa; }

        /* tabel */
        table {
            width: 100%; border-collapse: separate; border-spacing: 0; overflow: hidden;
            background: #fff; border-radius: 16px;
            box-shadow: 0 4px 14px rgba(120, 160, 220, 0.18);
        }
        th, td { padding: 11px 12px; text-align: left; border-bottom: 1px solid #e8eefa; }
        th { background: #8fb3ee; color: #fff; font-weight: 700; border-bottom: none; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f3f7fe; }

        /* pesan */
        .error { background: #e3ecfb; color: #3f5fa3; padding: 10px 14px; border-radius: 12px; margin-bottom: 12px; border-left: 4px solid #5b86d6; }
        .detail { background: #dfeafc; color: #3f5fa3; padding: 12px 16px; border-radius: 12px; margin-bottom: 12px; line-height: 1.6; }
        .detail a { color: #5b86d6; }
    </style>
</head>

<body>
    <h1>Manajemen Produk</h1>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if ($detail): ?>
    <div class="detail">
        <b>Detail produk #<?= $detail['id'] ?></b><br>
        Nama: <?= htmlspecialchars($detail['nama']) ?><br>
        Harga: Rp <?= number_format($detail['harga'], 0, ',', '.') ?><br>
        Stok: <?= $detail['stok'] ?><br>
        <a href="index.php">Tutup</a>
    </div>
    <?php endif; ?>

    <h2><?= $modeEdit ? 'Edit Produk #' . $form['id'] : 'Tambah Produk' ?></h2>
    <form method="post">
        <input type="hidden" name="aksi" value="simpan" style="display:none">
        <input type="hidden" name="id" value="<?= htmlspecialchars($form['id']) ?>" style="display:none">
        <label>Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($form['nama']) ?>" required>
        <label>Harga (Rp)</label>
        <input type="number" name="harga" min="0" value="<?= htmlspecialchars($form['harga']) ?>" required>
        <label>Stok</label>
        <input type="number" name="stok" min="0" value="<?= htmlspecialchars($form['stok']) ?>" required>
        <button class="utama" type="submit"><?= $modeEdit ? 'Simpan Perubahan' : 'Simpan' ?></button>
        <?php if ($modeEdit): ?><a class="btn" href="index.php">Batal</a><?php endif; ?>
    </form>

    <h2>Daftar Produk</h2>
    <table>
        <tr><th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
        <?php if (!$daftar): ?>
            <tr><td colspan="5">Belum ada produk.</td></tr>
        <?php endif; ?>
        <?php foreach ($daftar as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nama']) ?></td>
            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
            <td><?= $p['stok'] ?></td>
            <td>
                <a class="btn" href="index.php?lihat=<?= $p['id'] ?>">Detail</a>
                <a class="btn" href="index.php?edit=<?= $p['id'] ?>">Edit</a>
                <form class="inline" method="post" onsubmit="return confirm('Yakin hapus produk ini?')">
                    <input type="hidden" name="aksi" value="hapus" style="display:none">
                    <input type="hidden" name="id" value="<?= $p['id'] ?>" style="display:none">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>