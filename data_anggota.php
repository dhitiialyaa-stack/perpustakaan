<?php
// data.php - READ: menampilkan data anggota (SELECT), dilengkapi Detail dan Hapus
require_once "koneksi.php";
$sql = "SELECT * FROM anggota ORDER BY id DESC";
$hasil = mysqli_query($koneksi, $sql);
$jumlah = $hasil ? mysqli_num_rows($hasil) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #eef3fb; color: #222; }
        h1 { color: #1f3864; }
        table { border-collapse: collapse; background: #fff; }
        th, td { border: 1px solid #999; padding: 8px 12px; text-align: left; }
        th { background: #1f3864; color: #fff; }
        tr:nth-child(even) td { background: #f3f6fc; }
        form.inline { display: inline; }
</style>
    </style>
</head>
<body>
    <h1>Data Anggota Perpustakaan</h1>
    <p>Jumlah anggota: <?php echo $jumlah; ?></p>
    <table>
        <tr>
            <th>No</th><th>No. Anggota</th><th>Nama Lengkap</th><th>Email</th><th>No. HP</th>
            <th>Jenis Anggota</th><th>Alamat</th><th>Aksi</th>
        </tr>
        <?php $no = 1; while ($hasil && ($baris = mysqli_fetch_assoc($hasil))) { ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($baris['no_anggota']); ?></td>
            <td><?php echo htmlspecialchars($baris['nama_lengkap']); ?></td>
            <td><?php echo htmlspecialchars($baris['email']); ?></td>
            <td><?php echo htmlspecialchars($baris['no_hp']); ?></td>
            <td><?php echo htmlspecialchars($baris['jenis_anggota']); ?></td>
            <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
            <td>
                <a href="detail.php?id=<?php echo (int) $baris['id']; ?>">Detail</a>
                <form class="inline" action="hapus.php" method="post"
                onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id" value="<?php echo (int) $baris['id']; ?>">
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php if ($hasil) { mysqli_free_result($hasil); } ?>
</body>
</html>