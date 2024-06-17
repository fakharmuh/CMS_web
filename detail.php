<?php
require 'admin/function.php';
require 'admin/ceklogin.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title> My Trip Information</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <style type="text/css">
            .tentang{
                text-align: justify;
            }
        </style>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="http://localhost">My Trip Travel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="http://localhost">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Kontak</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                    <?php 
                        $data_id_kontributor = $_GET['id_kontributor'];
                        $data_idkategori = $_GET['id_kategori'];

                                        $sql_post = "SELECT
                                        kontributor.id_kontributor,
                                        kontributor.id_kategori,
                                        artikel.tanggal,
                                        artikel.judul,
                                        artikel.isi,
                                        penulis.username,
                                        kategori.nama_kategori,
                                        kategori.id_kategori,
                                        artikel.gambar
                                    FROM
                                        kontributor
                                    JOIN
                                        penulis ON kontributor.id_penulis = penulis.id_penulis
                                    JOIN
                                        artikel ON kontributor.id_artikel = artikel.id_artikel
                                    JOIN
                                        kategori ON kontributor.id_kategori = kategori.id_kategori
                                        WHERE kontributor.id_kontributor = '$data_id_kontributor' && kontributor.id_kategori = '$data_idkategori'
                                        ";
                                        $result_post = $conn->query($sql_post);
                                        $nomor_urut = 0;
                                        if ($result_post->num_rows > 0) {
                                            while($row = mysqli_fetch_assoc($result_post)){
                                                $nomor_urut++;
                                                $data_tanggal = $row['tanggal'];
                                                $data_judul = $row['judul'];
                                                $data_kategori = $row['nama_kategori'];
                                                $data_penulis = $row['username'];
                                                $data_gambar = $row['gambar'];
                                                $data_id_kontributor = $row['id_kontributor'];
                                                $data_idkategori = $row['id_kategori'];
                                                $data_isi = $row['isi'];
                                                //$data_potongan_artikel = potong_artikel($data_isi, 250);
                    ?>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $data_judul;?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"><?php echo $data_tanggal;?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="kategori.php?id_kategori=<?php echo $data_idkategori;?>"><?php echo $data_kategori;?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" width="900" height="400" src="admin/<?php echo $data_gambar;?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <?php echo $data_isi;?>
                            <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" onclick="history.back()">Kembali</button>

                            </div>
                        </section>
                    <?php
                                            }
                                        }else{

                                        }
                    ?>
                    </article>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Pencarian</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Masukkan kata kunci..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Artikel Terkait</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="list-group">

                                <?php 
                        $data_id_kontributor = $_GET['id_kontributor'];
                        $data_idkategori = $_GET['id_kategori'];

                                        $sql_post = "SELECT
                                        kontributor.id_kontributor,
                                        kontributor.id_kategori,
                                        artikel.tanggal,
                                        artikel.judul,
                                        artikel.isi,
                                        penulis.username,
                                        kategori.nama_kategori,
                                        kategori.id_kategori,
                                        artikel.gambar
                                    FROM
                                        kontributor
                                    JOIN
                                        penulis ON kontributor.id_penulis = penulis.id_penulis
                                    JOIN
                                        artikel ON kontributor.id_artikel = artikel.id_artikel
                                    JOIN
                                        kategori ON kontributor.id_kategori = kategori.id_kategori
                                        WHERE kontributor.id_kategori = $data_idkategori && kontributor.id_kontributor < $data_id_kontributor
                                        ORDER BY kontributor.id_kontributor DESC
                                        ";
                                        $result_post = $conn->query($sql_post);
                                        $nomor_urut = 0;
                                        if ($result_post->num_rows > 0) {
                                            while($row = mysqli_fetch_assoc($result_post)){
                                                $nomor_urut++;
                                                $data_tanggal = $row['tanggal'];
                                                $data_judul = $row['judul'];
                                                $data_kategori = $row['nama_kategori'];
                                                $data_penulis = $row['username'];
                                                $data_gambar = $row['gambar'];
                                                $data_id_kontributor = $row['id_kontributor'];
                                                $data_idkategori = $row['id_kategori'];
                                                $data_isi = $row['isi'];
                                                //$data_potongan_artikel = potong_artikel($data_isi, 250);
                                    ?>
                                    
                                    <a href="detail.php?id_kontributor=<?php echo $data_id_kontributor;?>&id_kategori=<?php echo $data_idkategori;?>" class="list-group-item list-group-item-action"><?php echo $data_judul;?></a>
                                    <?php
                                            }
                                        }else{

                                        }
                                    ?>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Tentang</div>
                        <div class="card-body tentang">Selamat datang di My Trip Travel, blog yang mengajak Anda menjelajahi pesona wisata Kota Malang. Dari keindahan alam yang memukau hingga kekayaan budaya dan kuliner, kami hadir untuk memberikan informasi dan inspirasi perjalanan yang tak terlupakan</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
