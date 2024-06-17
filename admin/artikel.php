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
        <style type="text/css">
            .ck-editor__editable[role="textbox"] {
                /* Editing area */
                min-height: 350px;
            }
        </style>
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
                        <h1 class="mt-4">Artikel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Silahkan kelola artikel</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <button class="btn btn-primary" name=btn-artikel-baru id="btn-artikel-baru"
                                 data-bs-toggle="modal" data-bs-target="#modalformArtikel">Artikel Baru</button>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Penulis</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $sql = "SELECT
                                        kontributor.id_kontributor,
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
                                        ORDER BY id_kontributor DESC";
                                        $result = $conn->query($sql);
                                        $nomor_urut = 0;
                                        if ($result->num_rows > 0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                $nomor_urut++;
                                                $data_tanggal = $row['tanggal'];
                                                $data_judul = $row['judul'];
                                                $data_kategori = $row['nama_kategori'];
                                                $data_penulis = $row['username'];
                                                $data_gambar = $row['gambar'];
                                                $data_id_kontributor = $row['id_kontributor'];
                                                $data_idkategori = $row['id_kategori'];
                                                $data_isi = $row['isi'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nomor_urut?></td>
                                        <td><?php echo $data_tanggal?></td>
                                        <td><?php echo $data_judul?></td>
                                        <td><?php echo $data_kategori?></td>
                                        <td><?php echo $data_penulis?></td>
                                        <td><img src="<?php echo $data_gambar?>" alt="Gambar Artikel" style="width: 100px;"></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" name="btn_ubah" data-bs-toggle="modal" data-bs-target="#modalubah"<?php echo $data_id_kontributor;?>>Ubah</button>
                                            <button class="btn btn-danger btn-sm" name="btn_hapus" data-bs-toggle="modal" data-bs-target="#modalhapus"<?php echo $data_id_kontributor;?>>Hapus</button>
                                        </td>
                                    </tr>
                                            <!-- The Modal HAPUS -->
                                            <div class="modal fade" id="modalhapus" <?php echo $data_id_kontributor;?>>
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <form method="POST">
                                                <div class="modal-body mt-3 mb-3 ">
                                                    Apakah artikel dengan judul: <?php echo "<b>".$data_judul."</b>";?> akan dihapus? 
                                                <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
                                                <button class="btn btn-danger" name="btn-hapus-artikel">Hapus</button>
                                                <input type="hidden" name="id-hapus-artikel" value="<?php echo $data_id_kontributor;?>">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                                <!-- Modal Form Ubah Artikel -->
                                        <div class="modal" data-bs-backdrop="static" id="modalubah" <?php echo $data_id_kontributor;?>>
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Artikel</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form  method="POST" enctype="multipart/form-data">
                                                <div class="mb-3 mt-3">
                                                    <label for="tanggal" class="form-label">Tanggal</label>
                                                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data_tanggal; ?>" readonly>
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <label for="judul" class="form-label">Judul</label>
                                                    <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $data_judul;?>">
                                                </div>
                                                <div class="mb-2 mt-3">
                                                    <label for="kategori" class="form-label">Kategori:</label>
                                                    <select class="form-select" id="kategori" name="kategori">
                                                    <?php
                                                        $sql_kategori = "SELECT id_kategori, nama_kategori FROM kategori";
                                                        $hasil = $conn->query($sql_kategori);
                                                        
                                                        if ($hasil->num_rows > 0) {
                                                        // output data of each row
                                                        while($row = $hasil->fetch_assoc()) {
                                                            $data_id_kategori = $row['id_kategori'];
                                                            $data_nama_kategori = $row['nama_kategori'];
                                                    ?>
                                                    <option value="<?php echo $data_id_kategori; ?>"><?php echo $data_nama_kategori;?></option>
                                                    <?php
                                                        }
                                                        } else {
                                                            echo "0 results";
                                                            }
                                                    ?>
                                                    <option value="<?php echo $data_idkategori; ?>"selected><?php echo $data_kategori;?></option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 mt-3">
                                                    <label for="isi">Isi Artikel:</label>
                                                    <textarea class="form-control" rows="5" id="ubah_isi" name="isi"><?php echo $data_isi;?></textarea> 
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gambar" class="form-label">Gambar:</label>
                                                    <input class="form-control" type="file" id="gambar" name="gambar">
                                                </div>
                                                <div><input type="hidden" name="id_kontributor_ubah" value="<?php echo $data_id_kontributor;?>"></div>
                                                <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
                                                    <button class="btn btn-primary" name="btn-ubah-artikel">Ubah</button>
                                                    <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>

                                    <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>Tidak ada artikel ditemukan.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </main>
                                    ?>
                                    <tbody>    
                                        
                                </table>
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
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
        
        <!-- Modal Form Artikel -->
        <div class="modal" data-bs-backdrop="static" id="modalformArtikel">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Modal Heading</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form  method="POST" enctype="multipart/form-data">
                <?php
                date_default_timezone_set("Asia/Jakarta");
                $hari = date("l");
                $tanggal = date("d");
                $bulan = date("m");
                $tahun = date("Y");
                $waktu = date("H:i");
                $tanggal_lengkap = $hari . ", " . $tanggal . "-" . $bulan . "-" . $tahun . " | " . $waktu;
                ?>
                <div class="mb-3 mt-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal_lengkap; ?>" readonly>
                </div>
                <div class="mb-3 mt-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
                <div class="mb-2 mt-3">
                    <label for="kategori" class="form-label">Kategori:</label>
                    <select class="form-select" id="kategori" name="kategori">
                    <?php
                        $sql = "SELECT id_kategori, nama_kategori FROM kategori";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $data_id_kategori = $row['id_kategori'];
                            $data_nama_kategori = $row['nama_kategori'];
                    ?>
                    <option value="<?php echo $data_id_kategori; ?>"><?php echo $data_nama_kategori;?></option>
                    <?php
                        }
                        } else {
                            echo "0 results";
                            }
                    ?>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                    <label for="isi">Isi Artikel:</label>
                    <textarea class="form-control" rows="5" id="isi" name="isi"></textarea> 
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar:</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                </div>

                <div class="mb-3 mt-3 d-flex justify-content-end gap-2">
                    <button class="btn btn-primary" name="btn-simpan">Simpan</button>
                    <button class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                </div>
            </form> 
        </div>
    </div>
    <script>
            // This sample still does not showcase all CKEditor&nbsp;5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("isi"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Tulis artikel disini...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'MultiLevelList',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
            });
        </script>

<script>
            // This sample still does not showcase all CKEditor&nbsp;5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            CKEDITOR.ClassicEditor.create(document.getElementById("ubah_isi"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Tulis artikel disini...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "superbuild" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'MultiLevelList',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange'
                ]
            });
        </script>
    </body>
</html>
