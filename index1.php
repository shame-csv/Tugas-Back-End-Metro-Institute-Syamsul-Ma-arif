<?php
$host = "localhost";
$user = "root";
$password = "";
$db= "perpustakaan";

$koneksi = mysqli_connect($host, $user, $password, $db);
if(!$koneksi){
    die ("Tidak bisa terkoneksi ke database.");
} else {
    echo "Koneksi Sukses.";
}

$kode = "";
$judul = "";
$pengarang = "";
$penerbit = "";
$tahun_terbit = "";
$sukses = "";
$error = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op = "";
}

if($op == 'delete')
{
    $id = $_GET['id'];
    $sql1 = "DELETE FROM buku WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

if($op == 'edit')
{
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM buku WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kode = $r1['kode'];
    $judul = $r1['judul'];
    $pengarang = $r1['pengarang'];  
    $penerbit = $r1['penerbit'];
    $tahun_terbit = $r1['tahun_terbit'];

    if($kode == ''){
        $error = "Data tidak ditemukan";
    }
}

if(isset($_POST['simpan'])){
    $kode = $_POST['kode'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    if($kode && $judul && $pengarang && $penerbit && $tahun_terbit){
        if($op == 'edit'){ 
            $sql1 = "UPDATE buku SET kode = '$kode', judul = '$judul', pengarang = '$pengarang', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if($q1){
                $sukses = "Data berhasil diupdate!!";
            } else {
                $error = "Data gagal diupdate!!";
            }
        } else {                 
        $sql1 = "INSERT INTO buku (kode, judul, pengarang, penerbit, tahun_terbit) VALUES ('$kode', '$judul', '$pengarang', '$penerbit', '$tahun_terbit')";
        $q1 = mysqli_query ($koneksi, $sql1);
        if($q1){
            $sukses = "Berhasil memasukkan data!!";
        } else {
            $error = "Gagal memasukkan data!!";
        }
        }
} else {
        $error = "Silahkan isi semua data!";    
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width : 800px
        }
        .card {
            margin-top : 10px;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
    <! -- UNTUK MEMASUKKAN DATA -- > 
        <div class="card">
            <div class="card-header">Create/Edit data
            </div>
            <div class="card-body">
                <?php
                if($error){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if($sukses){
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>  
                <form action="" method="POST">
                    <input type ="hidden" name="op" value="<?php echo $op; ?>">
                    <input type ="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3 row">
                        <label for="kode" class="col-sm-2 col-form-label">KODE</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nim" name="kode" value="<?php echo $kode; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $pengarang; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $penerbit; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $tahun_terbit; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"
                    </div>
                </form>
            </div>
        </div>

        <!-- UNTUK MENAMPILKAN DATA -->
        <div class="card">
            <div class="card-header text-white bg-secondary">Data Buku
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">KODE</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Pengarang</th>
                            <th scope="col">Penerbit</th>
                            <th scope="col">Tahun Terbit</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        <tbody>
                            <?php
                            $sql2 = "SELECT * FROM buku ORDER BY id DESC";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urut = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $id = $r2['id'];
                                $kode = $r2['kode'];
                                $judul = $r2['judul'];
                                $pengarang = $r2['pengarang'];
                                $penerbit = $r2['penerbit'];
                                $tahun_terbit = $r2['tahun_terbit'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $kode; ?></td>
                                    <td scope="row"><?php echo $judul; ?></td>
                                    <td scope="row"><?php echo $pengarang; ?></td>
                                    <td scope="row"><?php echo $penerbit; ?></td>
                                    <td scope="row"><?php echo $tahun_terbit; ?></td>
                                    <td scope="row">
                                        <a href="index1.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <a href="index1.php?op=delete&id=<?php echo $id?>" onclick="return confirm  ('Apakah anda yakin ingin menghapus data ini?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            </tr>
                            <?php
                        }   
                        ?>
                        </tbody>
                    </thead>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>