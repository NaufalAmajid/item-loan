<?php
session_start();
if(!isset($_SESSION['admin'])) {
   header('location:login.php');
} else {
   $username = $_SESSION['admin'];
}

 include'config/koneksi.php';
    
if(isset($_POST["tambah"])) {
    $id_brg = $_POST ['id_brg'];
    $nama_brg = $_POST['nama_brg'];
    $jenis_brg = $_POST ['jenis_brg'];
    $stok_brg = $_POST ['stok_brg'];
    
    $nama_file = $_FILES['uploadgambar']['name'];
    $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
    $random = crypt($nama_file, time());
    $ukuran_file = $_FILES['uploadgambar']['size'];
    $tipe_file = $_FILES['uploadgambar']['type'];
    $tmp_file = $_FILES['uploadgambar']['tmp_name'];
    $path = "images/".$random.'.'.$ext;
    $pathdb = $random.'.'.$ext;


    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
      if($ukuran_file <= 5000000){ 
      if(move_uploaded_file($tmp_file, $path)){ 
      
        $query = "INSERT INTO barang(id_brg,nama_brg,jenis_brg,stok_brg,foto) values (NULL, '$nama_brg','$jenis_brg','$stok_brg','$pathdb')";
        $sql = mysqli_query($mysqli, $query); // Eksekusi/ Jalankan query dari variabel $query
        
        if($sql){ 
        
        echo "<script>alert('Data Berhasil Ditambahkan!')</script>";
        echo "<script>window.location.href='barang.php'</script>";
          
        }else{
        // Jika Gagal, Lakukan :
        echo "<script>alert('Data Gagal Ditambahkan!')</script>";
        echo "<script>window.location.href='barang.php'</script>";
        }
      }else{
        // Jika gambar gagal diupload, Lakukan :
        echo "<script>alert('Data Gagal Ditambahkan!')</script>";
        echo "<script>window.location.href='barang.php'</script>";
      }
      }else{
      // Jika ukuran file lebih dari 1MB, lakukan :
      echo "<script>alert('Data Gagal Ditambahkan Karena ukuran lebih 1MB!')</script>";
        echo "<script>window.location.href='barang.php'</script>";
      }
    }else{
      // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
      echo "<script>alert('Data Gagal Ditambahkan Karena bukan JPG / PNG!')</script>";
        echo "<script>window.location.href='barang.php'</script>";
    }
  
  };
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
  
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

    <title>Peminjaman Alat</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="bootstrap/dist/css/global.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  </head>


  <body>
<div id="preloader">
        <div class="loader"></div>
    </div>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Peminjaman Alat</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user fa-fw"></i>Admin <i class="fa fa-caret-down"></i>
              </a>
            <ul class="dropdown-menu dropdown-user">
             <li class="divider"></li>
              <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>

          </li>
          </ul>
          
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class=""><a href="dashboard.php"><i class="fa fa-dashboard">&nbsp;&nbsp;&nbsp;Dashboard</i></a></li>
            <li><a href="barang.php"><i class="fa fa-flask">&nbsp;&nbsp;&nbsp;Barang</i></a></li>
            <li><a href="peminjam.php"><i class="fa fa-user">&nbsp;&nbsp;&nbsp;Anggota</i></a></li>
            <li><a href="peminjaman.php"><i class="fa fa-gear">&nbsp;&nbsp;&nbsp;Peminjaman</i></a></li>
            <li><a href="pengembalian.php"><i class="fa fa-book">&nbsp;&nbsp;&nbsp;Pengembalian</i></a></li>
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="page-header">Data Barang</h2>
                  <div class="d-sm-flex justify-content-between align-items-center">
                  <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Barang</button>
                  </div>
              <div class="data-tables datatable-light">
                     <table id="dataTable3" class="display" style="width:100%">
                     <thead class="thead-light">
                     
                        <tr>
                          <th>Kode Barang</th>
                          <th>Nama Barang</th>
                          <th>Jenis Barang</th>
                          <th>Stok Barang</th>
                          <th>Opsi</th>
                        </tr>
                     </thead>
                <tbody>
                <?php
                     $query = $mysqli->query("SELECT * FROM barang ");
                     $id_brg=1;
                     while ($lihat=mysqli_fetch_array($query)){
                      ?>
                      
                        <tr>
                          <td><?php echo $id_brg++; ?></td>
                          <td><?php echo $lihat['nama_brg']; ?></td>
                          <td><?php echo $lihat['jenis_brg'];?></td>
                          <td><?php echo $lihat['stok_brg']; ?></td>
                          
                          <td> <a href="editbrg.php?id_brg=<?php echo $lihat['id_brg']; ?>" class="btn btn-warning">&nbsp;&nbsp;Edit</a>
                          <a href="hapusbrg.php?id=<?php echo $lihat['id_brg']; ?>" class="btn btn-danger">Hapus</a>
                          </td>



                        </tr>
                        <?php

                        } ?>

                      </tbody>

              </table>
        </div>
      </div>
    </div>

    <!-- modal input -->
      <div id="myModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Barang</h4>
            </div>
            <div class="modal-body">
              <form action="barang.php" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                  <label for="">Kode Barang </label>
                    <input type="text" name="id_brg" class="form-control" placeholder="Kode Barang" required autofocus>
                </div>
                <div class="form-group">
                    <label for="">Nama Barang </label>
                    <input type="text"  name="nama_brg" class="form-control" placeholder="Nama Barang" required>
                </div>
                <div class="form-group">
                    <label for="">Jenis Barang</label>
                    <input type="text"   name="jenis_brg" class="form-control" placeholder="Jenis Barang" required>
                </div>
                <div class="form-group">
                    <label for="">Stok Barang</label>
                    <input type="number"   name="stok_brg" 
                    class="form-control" placeholder="Stok Barang" required>
                </div>
                <div class="form-group">
                  <label>Gambar</label>
                  <input name="uploadgambar" type="file" class="form-control">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <input name="tambah" type="submit" class="btn btn-primary" value="Tambah">
              </div>
            </form>
          </div>
        </div>
      </div>
<script>
  $(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
  } );
  </script>
    <?php require_once "templates/footer.php" ?>
  <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>

    
  </body>
  <?php require_once "templates/footer.php" ?>
</html>