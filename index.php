<!DOCTYPE html>
<html lang="en">
<?php mysql_connect('localhost','root',''); mysql_select_db('latansa'); include 'fungsi.php';?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>La Tansa</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/num.js"></script>

    <!-- Add custom CSS here -->
    <style>
    body {
        margin-top: 60px;
    }
    </style>

</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">La Tansa</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="?hal=pengaturan">Pengaturan</a></li>
                    <li><a href="?hal=smp">Siswa SMP</a></li>
                    <li><a href="?hal=sma">Siswa SMA</a></li>
                    <li><a href="?hal=laporan">Laporan Pembayaran</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <?php if(!isset($_GET['hal'])){ ?>
                <h1>Simulasi Pembayaran La Tansa</h1>
                <p>Oleh Tim La Tansa dan Reza Nurfachmi (alumni 2007)</p>
                <?php }else{ $hal=$_GET['hal']; include "$hal.php";} ?>
            </div>
        </div>

    </div>
    <!-- /.container -->

</body>

</html>
