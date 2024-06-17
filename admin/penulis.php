<?php
include 'ceklogin.php';
include 'function.php';
//session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Kelola Konten</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">MENU UTAMA</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">  
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="artikel.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-file-earmark-text-fill"></i></i></i></div>
                                Artikel
                            </a>
                            <a class="nav-link" href="kategori.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-bookmark-check-fill"></i></i></div>
                                Kategori
                            </a>
                            <a class="nav-link" href="penulis.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-fill"></i></i></div>
                                Penulis
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-door-closed-fill"></i></i></div>
                                Logout
                            </a>

                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['email'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Penulis</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Silahkan kelola penulis</li>
                        </ol>
                        

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                <button class="btn btn-primary" name="btn_artikel_baru" data-bs-toggle="modal" data-bs-target="#modalFormpenulis">
                                Penulis baru
                                </button> 
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Penulis</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                        $sql = "SELECT id_penulis, username, email, password FROM penulis ORDER BY id_penulis DESC ";
                                        $result = mysqli_query($conn, $sql);
                                        
                                        if (mysqli_num_rows($result) > 0) {
                                            $nomor_urut = 0;

                                          // output data of each row
                                          while($row = mysqli_fetch_assoc($result)) {
                                            $nomor_urut++;
                                            $data_id_penulis = $row['id_penulis'];
                                            $data_nama = $row['username'];
                                            $data_email = $row['email'];
                                            $data_password = $row['password'];
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor_urut;?></td>
                                            <td><?php echo $data_nama;?></td>
                                            <td><?php echo $data_email;?></td>
                                            
                                            <td>
                                            <button class="btn btn-warning" name="btn-ubah-penulis" data-bs-toggle="modal" data-bs-target="#modalFormUpdatepenulis<?php echo $data_id_penulis; ?>">Ubah</button>
                                            <button class="btn btn-danger" name="btn-hapus-penulis" data-bs-toggle="modal" data-bs-target="#modalFormHapuspenulis<?php echo $data_id_penulis; ?>">Hapus</button>
                                            </td>
                                        </tr>
                                            <!-- Modal Form Update penulis-->
                                            <div class="modal fade" data-bs-backdrop="static" id="modalFormUpdatepenulis<?php echo $data_id_penulis; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah penulis</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal Form Tambah penulis -->
                                                <div class="modal-body">
                                                <form method="POST">
                                                    <div class="mb-3 ">
                                                        <label for="nama" class="form-label">Nama penulis:</label>
                                                        <input type="text" class="form-control" id="nama" value="<?php echo $data_nama ;?>" name="nama">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <textarea class="form-control" rows="2" id="email" name="email"><?php echo $data_email ;?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password:</label>
                                                        <textarea class="form-control" rows="2" id="password" name="password"></textarea>
                                                    </div>
                                                    <input type="hidden" name="id_penulis_update" value="<?php echo $data_id_penulis ;?>">
                                                    <div>

                                                    </div>
                                                    <div class="d-flex justify-content-end gap-2">
                                                    <button class="btn btn-warning" name="btn_ubah_penulis">Ubah</button>
                                                    <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form> 
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                            <!-- The Modal Hapus penulis -->
                                            <div class="modal fade" id="modalFormHapuspenulis<?php echo $data_id_penulis; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus penulis</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <form method="POST">
                                                    <div class="modal-body mt-3 mb-3 ">
                                                        Apakah penulis dengan nama: <?php echo "<b>".$data_nama."</b>";?> akan dihapus? 
                                                    <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
                                                    <button class="btn btn-danger" name="btn_hapus_penulis">Hapus</button>
                                                    <input type="hidden" name="id-hapus-penulis" value="<?php echo $data_id_penulis;?>">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                          }
                                        } else {
                                          echo "0 results";
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Fakhar Muhammad Hidayat &copy; 19650106</div>
                           
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <!-- Modal Form Tambah penulis-->
        <div class="modal fade" data-bs-backdrop="static" id="modalFormpenulis">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah penulis</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Form Tambah Artikel -->
            <div class="modal-body">
            <form method="POST">
                <div class="mb-3 ">
                    <label for="nama" class="form-label">Nama penulis:</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama penulis..." name="nama">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <textarea class="form-control" rows="2" id="email" name="email" placeholder="Masukkan email..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <textarea class="form-control" rows="2" id="password" name="password" placeholder="Masukkan password..."></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-primary" name="btn_simpan_penulis">Simpan</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form> 
            </div>
            </div>
        </div>
    </div>

    </body>
</html>
