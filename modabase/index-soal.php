<?php    
    session_start();
      include 'dataprofil.php';
      if (!isset($_POST['email']) && !isset($_SESSION['email'])) {
      header("Location: index-sign.php");
    }
    // unset($_SESSION['hasil']); 
    // unset($_SESSION['index']); 
    unset($_SESSION['latihan']); 
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mintone.xyz/index-projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Nov 2018 03:13:52 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Modabase">
<meta name="author" content="Modabase">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="assets/imgs/favicon.png">
<title>Modabase - E-Learning Pemodelan Basis data</title>
<!-- Bootstrap Core CSS -->
<link href="plugins/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="plugins/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
<!-- This page CSS -->
<!-- chartist CSS -->
<link href="plugins/vendors/morrisjs/morris.css" rel="stylesheet">
<!--c3 CSS -->
<link href="plugins/vendors/c3-master/c3.min.css" rel="stylesheet">
<!--Toaster Popup message CSS -->
<link href="plugins/vendors/toast-master/css/jquery.toast.css" rel="stylesheet">
<!-- page css -->
<link href="assets/css/pages/tab-page.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="plugins/vendors/bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
  <div class="loader">
    <div class="loader__figure"></div>
    <p class="loader__label">Modabase</p>
  </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
  <!-- ============================================================== -->
  <!-- Container1140px -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Topbar header - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <header class="topbar">
    <div class="container">
      <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header"> 
            <a class="navbar-brand" href="index-dashboard.php">
                <!-- Logo icon -->
                <div><h3>M<span>odabase</h3></span></div>
                <!--End Logo icon -->
                    <!-- Logo text -->
            </a> 
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="top-bar-main">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <div class="float-left">
            <ul class="navbar-nav">
              <li class="nav-item "><a class="nav-link navbar-toggler navbar-top-on sidebartoggler waves-effect waves-dark float-right" href="javascript:void(0)"><span class="navbar-toggler-icon"></span></a></li>
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <!-- <li class="nav-item hidden-xs-down app-search">
                <input type="text" class="form-control float-left" placeholder="Type for search...">
              </li> -->
              <li class="nav-item hidden-xs-down"> <a class="nav-link navbar-toggler sidebartoggler hidden-xs-down waves-effect waves-dark float-right" href="javascript:void(0)"><span class="navbar-toggler-icon"></span></a> </li>
            </ul>
          </div>
          <!-- ============================================================== -->
          <!-- User profile and search -->
          <!-- ============================================================== -->
          <div class="float-right pr-3">
            <ul class="navbar-nav my-lg-0 float-right">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark note" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell"></i>
                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right mailbox animated fadeIn">
                  <ul>
                    <li>
                      <?php 
                        $email = $_SESSION['email'];
                        $sql = mysqli_query($conn,"SELECT * FROM `notif` where kepada = '$email' AND idtidak = '' ORDER BY idnotif DESC");
                        $hasil =mysqli_num_rows($sql);
                        if($hasil == 0){
                      ?>
                            <div class="drop-title text-secondary text-center pt-3 pb-3">Tidak ada Notifikasi</div>
                      <?php 
                        }
                        else if ($hasil <= 3 ){
                      ?>
                      <div class="drop-title">Anda punya <span class="highlighted"><?php echo $hasil; ?> notifikasi</span> baru</div>
                      <?php 
                        }
                        else{
                      ?>
                      <div class="drop-title">Anda punya <span class="highlighted">3 notifikasi</span> baru</div>
                        <?php }?>
                    </li>
                    <li>
                      <div class="message-center">
                        <!-- Message -->
                        <?php 
                          $i = 1;
                          while (($data2 = mysqli_fetch_array($sql)) && ($i <=3)){
                            $email1 = $data2['email'];
                            $materi = $data2['materi'];
                            $sql2 = mysqli_query($conn,"SELECT * FROM `akun` where email = '$email1'");
                            $data1 = mysqli_fetch_array($sql2);     
                        ?>
                        <a href="diskusi.php">
                          <div class="row">
                              <div class="col-9">
                                  <?php if($data2['iduser'] != ""){  ?>
                                  <div class="mail-content"><?php echo $data1['namad']; ?> berkomentar pada Diskusi: <?php echo $data2['materi'];?></div> 
                                  <?php 
                                      }
                                      else if ($data2['idsuka'] != ""){
                                  ?>
                                  <div class="mail-content"><?php echo $data1['namad']; ?> menyukai komentar anda</div>
                                  <?php }?>
                              </div>
                              <div class="col-3">
                                  <span class="float-right text-light">11.08.2018</span>
                              </div>
                          </div>
                        </a>
                        <?php       
                              $i = $i +1;
                            }
                        ?>
                          
                          <!-- <a href="#">
                              <div class="row">
                                  <div class="col-9">
                                      <div class="mail-content">Alisha menyukai komentar anda</div>
                                  </div>
                                  <div class="col-3">
                                      <span class="float-right text-light">11.08.2018</span>
                                  </div>
                              </div>
                            </a> -->
                        
                     
                      </div>
                    </li>
                    <li> <a class="nav-link text-center" href="index-notif.php">Lihat semua notifikasi </a> </li>
                  </ul>
                </div>
              </li>
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- End mega menu -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Profile -->
              <!-- ============================================================== -->
              <?php 
                  if($data['foto'] != ""){
              ?>
              <li class="nav-item dropdown u-pro"> <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/imgs/users/<?php echo $data['foto']?>" alt="user" class="" /></a>
              <?php 
                  }
                  else { 
              ?> 
              <li class="nav-item dropdown u-pro"> <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/imgs/users/no-pic.jpg" alt="user" class="" /></a> 
              <?php 
                  }
              ?>  
              
                <div class="dropdown-menu dropdown-menu-right animated fadeIn">
                  <ul class="dropdown-user">
                    <li class="text-center">
                      <div class="dw-user-box">
                      
                      <?php 
                        if($data['foto'] != ""){
                      ?>
                      <div class="u-img"><img src="assets/imgs/users/<?php echo $data['foto']?>" alt="user"></div>
                      <?php 
                          }
                          else { 
                      ?>
                      <div class="u-img"><img src="assets/imgs/users/no-pic.jpg" alt="user"></div>
                      <?php 
                          }
                      ?>

                        <div class="clearfix"></div>
                        <div class="u-text p-0 pt-3">
                          <h4><?php echo $data['namad']?></h4>
                        </div>
                      </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="index-profil.php"><i class="fas fa-cog mr-1"></i>Pengaturan</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="Logout.php"><i class="fas fa-sign-in-alt mr-1"></i> Logout</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
      </nav>
    </div>
  </header>
  <!-- ============================================================== -->
  <!-- End Topbar header -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Left Sidebar - style you can find in sidebar.scss  -->
  <!-- ============================================================== -->
  <div class="container">
    <aside class="left-sidebar">
      <!-- <ul class="nav-bar navbar-inverse">
        <li class="nav-item"> <a class="nav-link navbar-toggler sidebartoggler hidden-sm-down waves-effect waves-dark float-right" href="javascript:void(0)"><span class="navbar-toggler-icon"></span></a> </li>
      </ul> -->
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="clearfix"></li>
            <li> <a class="waves-effect waves-dark" href="index-dashboard.php" aria-expanded="false"><i class="flaticon-desktop-computer-screen-with-rising-graph"></i><span class="hide-menu">Dashboard</span></a>
            </li>
            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="flaticon-forms"></i><span class="hide-menu">Materi</span></a>
              <ul aria-expanded="false" class="collapse">
                <li><a href="index-materi.php#pengenalan">1.Pengenalan</a></li>
                  <li><a href="index-materi.php#atribut">2.Atribut</a></li>
                  <li><a href="index-materi.php#kardinalitas">3.Kardinalitas</a></li>
                  <li><a href="index-materi.php#entitas">4.Entitas</a></li>
                  <!-- <li><a href="index-materi.html#spesialisasi">5.Spesialisasi</a></li>
                  <li><a href="index-materi.html#generalisasi">6.Generalisasi</a></li> -->
              </ul>
            </li>
            <li><a href="#" class="active"><i class="flaticon-pencil-edit-button"></i><span class="hide-menu">Soal</span></a></li>
            <li><a href="index-diskusi.php"><i class="flaticon-speech"></i><span class="hide-menu">Diskusi</span></a></li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper"  id="pengenalan">
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        <div class="row page-titles">
          <div class="col-md-5 col-sm-12 align-self-center">
            <h1 class="weight-500 m-0">Soal : Skema Relasi</h1>
          </div>
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-9">
                        <h3 class="weight-500 m-b-25" id="atribut">Latihan Soal 1</h3>
                        <p class="font-16 m-b-30">Latihan soal berisikan materi tentang : <b>Attibut</b>, <b>Kardinalitas</b></p>
                        <a href = "latihansoal.php?latihan=1"><button class="btn btn-primary bbtn-primary rounded pr-4 pl-4 w-25" id="soal1">Mulai</button></a>
                    </div>
                    <div class="col-md-3" >
                    <div class="icon-soal" >
                      <p style="font-size:5em; color:#3fc7bd"><i class="fas fa-file-signature"></i></p>
                    </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-9">
                          <h3 class="weight-500 m-b-25" id="atribut">Latihan Soal 2</h3>
                          <p class="font-16 m-b-30">Latihan soal berisikan materi tentang : <b>Entitas</b></p>
                          <a href = "latihansoal.php?latihan=2"><button class="btn btn-primary bbtn-primary rounded pr-4 pl-4 w-25" id="soal1">Mulai</button></a>
                      </div>
                      <div class="col-md-3">
                      <div class="icon-soal" >
                        <p style="font-size:5em ;color:#3fc7bd"><i class="fas fa-file-signature"></i></p>
                      </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            <!-- Column -->
          </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="plugins/vendors/jquery/jquery.min.js"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="plugins/vendors/bootstrap/js/popper.min.js"></script>
<script src="plugins/vendors/bootstrap/js/bootstrap.min.js"></script>
<script>
function toggleIcon(e) {
    $(e.target)
        .prev('.card-link')
        .find(".more-less")
        .toggleClass('fa-plus fa-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="plugins/vendors/ps/perfect-scrollbar.jquery.min.js"></script>
<!--Wave Effects -->
<script src="assets/js/waves.js"></script>
<!--Menu sidebar -->
<script src="assets/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="assets/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--c3 JavaScript -->
<script src="plugins/vendors/d3/d3.min.js"></script>
<script src="plugins/vendors/c3-master/c3.min.js"></script>
<!--jquery knob -->
<script src="plugins/vendors/knob/jquery.knob.js"></script>
<!--Morris JavaScript -->
<script src="plugins/vendors/raphael/raphael-min.js"></script>
<script src="plugins/vendors/morrisjs/morris.js"></script>
<!-- Popup message jquery -->
<script src="plugins/vendors/toast-master/js/jquery.toast.js"></script>
<!-- Dashboard JS -->
<script src="assets/js/dashboard-projects.js"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="plugins/vendors/styleswitcher/jQuery.style.switcher.js"></script>
<script src="plugins/vendors/datatables/jquery.dataTables.min.js"></script>
<script>
    $('#spesialisasi').click(function () {
			window.location.href = 'latihansoal.html';
	});
    $('#atribut1').click(function () {
			window.location.href = 'latihansoal.html';
	});
   $(function() {
       $('#myTable').DataTable();
           var table = $('#example').DataTable({
              "columnDefs": [{
                  "visible": false,
                  "targets": 2
            }],
            "order": [
                  [2, 'asc']
            ],
            "displayLength": 8,
             "drawCallback": function(settings) {
                var api = this.api();
                 var rows = api.rows({
                     page: 'current'
                 }).nodes();
                var last = null;
             api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
<script>
$('#slimtest1, #slimtest2, #slimtest3, #slimtest4').perfectScrollbar();
</script>
</body>

<!-- Mirrored from mintone.xyz/index-projects.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 04 Nov 2018 03:14:08 GMT -->
</html>
