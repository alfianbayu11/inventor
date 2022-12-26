<?php
require 'function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mutasi Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Inventor</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->

        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-archive"></i></div>
                            Stok Barang
                        </a>
                        <a class="nav-link" href="mutasi.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-archive"></i></div>
                            Mutasi Barang
                        </a>



            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Mutasi Barang</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Mutasi Barang
                            </button>
                            <br>
                            <div class="row mt-4">
                                <div class="col">
                                    <form method="post" class="form-inline">
                                        <input type="date" name="awal" class="form-control">
                                        <input type="date" name="akhir" class="form-control ml-3">
                                        <button type="submit" name="filter" class="btn btn-info ml-3">Filter</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No. Bukti</th>
                                            <th>Nama Barang</th>
                                            <th>Status Barang</th>
                                            <th>Quantity</th>
                                            <th>Saldo</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if(isset($_POST['filter'])){
                                            $awal = $_POST['awal'];
                                            $akhir = $_POST['akhir'];
                                            $ambildatamutasi = mysqli_query($conn, "select * from mutasi m, stock s where s.idbarang = m.idbarang and tanggal BETWEEN '$awal'and DATE_ADD('$akhir', INTERVAL 1 DAY)");
                                        }else{
                                            $ambildatamutasi = mysqli_query($conn, "select * from mutasi m, stock s where s.idbarang = m.idbarang");
                                        }
                                    
                                    while($data=mysqli_fetch_array($ambildatamutasi)){

                                        $tanggal = $data['tanggal'];
                                        $nobukti= $data['nobukti'];
                                        $idbarang = $data['idbarang'];
                                        $namabarang = $data['namabarang'];
                                        $statusbarang = $data['statusbarang'];
                                        $qty = $data['qty'];
                                        $saldo = $data['saldo'];
                                        $id = $data['id'];




                                        ?>
                                        <tr>
                                            <td><?=$tanggal?></td>
                                            <td><?=$nobukti?></td>
                                            <td><?=$namabarang?></td>
                                            <td><?=$statusbarang?></td>
                                            <td><?=$qty?></td>
                                            <td><?=$saldo?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#edit<?=$id?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete<?=$id?>">
                                                    Delete
                                                </button>
                                            </td>

                                        </tr>
                                        <div class="modal fade" id="edit<?=$id?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Mutasi</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="number" class="form-control" name="nobukti"
                                                                value="<?=$nobukti?>" required><br>

                                                            <select name="barangnya" class="form-control" required>
                                                                <option value="<?= $idbarang; ?>"><?= $namabarang; ?>
                                                                    <?php
                        $ambilsemuadatanya = mysqli_query($conn, 'select * from stock');
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarang = $fetcharray['idbarang'];

                        ?>

                                                                <option value="<?= $idbarang; ?>"><?= $namabarangnya; ?>
                                                                </option>
                                                                <?php
                        }
                        ?>
                                                            </select><br>
                                                            <select class="custom-select" name="statusbarang" required>
                                                                <option value="<?=$statusbarang?>"><?=$statusbarang?>
                                                                </option>
                                                                <option value="In">In</option>
                                                                <option value="Out">Out</option>
                                                            </select><br><br>
                                                            <input type="number" class="form-control" name="qty"
                                                                value="<?=$qty?>" required><br>
                                                            <input type="hidden" name="id" value="<?=$id?>">
                                                            <button type="submit" class="btn btn-primary"
                                                                name="updatemutasi">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="modal fade" id="delete<?=$id?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Mutasi</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin menghapus data ini?
                                                            <input type="hidden" name="id" value="<?=$id?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger"
                                                                name="hapusmutasi">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                            </div>


                            <?php
                                        };


                                        ?>

                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    <script src="assets/demo/datatables-demo.js"></script>
</body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">

                    <input type="number" class="form-control" name="nobukti" placeholder="No.Bukti" required><br>

                    <select name="barangnya" class="form-control" required>
                        <option selected>Nama Barang</option>
                        <?php
                        $ambilsemuadatanya = mysqli_query($conn, 'select * from stock');
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $namabarangnya = $fetcharray['namabarang'];
                            $idbarang = $fetcharray['idbarang'];
                            $harga = $fetcharray['hargabarang'];
                        ?>

                        <option value="<?= $idbarang; ?>"><?= $namabarangnya; ?></option>
                        <?php
                        }
                        ?>
                    </select><br>
                    <select class="custom-select" name="statusbarang" required>
                        <option selected>Status Barang</option>
                        <option value="In">In</option>
                        <option value="Out">Out</option>
                    </select><br><br>
                    <input type="number" class="form-control" name="qty" placeholder="Quantity" required><br>
                    <button type="submit" class="btn btn-primary" name="addnewmutasi">Submit</button>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>
            </form>

</html>