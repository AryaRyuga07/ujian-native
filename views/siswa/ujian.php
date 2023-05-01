<?php
session_start();
if($_SESSION["status_login"] !== true) {
	echo '<script>window.location="../login/login.php"</script>';
}
require '../../model/db.php';

$jumlahDataPerHalaman = 5;
$jumlahData = count(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_detail_soal WHERE id_soal = '" . $_POST["id_soal"] . "'")));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$soal = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_detail_soal WHERE id_soal = '" . $_POST["id_soal"] . "' LIMIT $awalData, $jumlahDataPerHalaman"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyExam</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/home.css">
</head>

<body>

    <header class="header">
        <nav class="navbar" style="margin-right: 1500px;">
            <a href="index.php">Back</a>
        </nav>

        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box" class="fas fa-search"></label>
        </div>
    </header>

    <section class="menu" id="menu">
        <div class="box-container" style="display: inline-block;">
            <?php
            $mapel = mysqli_query($conn, "SELECT tb_headsoal.id_soal, tb_mapel.nama_mapel FROM `tb_headsoal` INNER JOIN tb_mapel ON tb_headsoal.id_mapel = tb_mapel.id_mapel WHERE id_soal = '" . $_POST["id_soal"] . "'");
            $m = mysqli_fetch_assoc($mapel);
            ?>
            <h1 style="margin-top: 70px; color: white; font-size: 30px;"><?= $m["nama_mapel"]; ?></h1>
            <?php
            $no = 1;
            foreach ($soal as $s) {
            ?>
                <div class="box" style="margin-top: 20px; padding-bottom: auto;">
                    <h3 style="margin-top: 0px;"><?= $no++; ?>.<?= " " . $s["soal"] . " ?" ?></h3>
                    <div style="float: left;">
                        <div class="price" style="font-size: 20px; margin-left: 5px;">
                            <input type="radio" id="a" name="jawaban" value="<?= $s["a"]; ?>">
                            <label for="a"><?= $s["a"]; ?></label>
                        </div>
                        <div class="price" style="font-size: 20px; margin-left: 5px;">
                            <input type="radio" id="b" name="jawaban" value="<?= $s["b"]; ?>">
                            <label for="b"><?= $s["b"]; ?></label>
                        </div>
                        <div class="price" style="font-size: 20px; margin-left: 5px;">
                            <input type="radio" id="c" name="jawaban" value="<?= $s["c"]; ?>">
                            <label for="c"><?= $s["c"]; ?></label>
                        </div>
                        <div class="price" style="font-size: 20px; margin-left: 5px;">
                            <input type="radio" id="d" name="jawaban" value="<?= $s["d"]; ?>">
                            <label for="d"><?= $s["d"]; ?></label>
                        </div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            <?php } ?>
        </div>
    </section>

    <footer class="footer" style="position: absolute; margin-top: 0px; left: 0; right: 0;">
        <div class="credit">created by <span>Ryuga</span> | all rights reserved</div>
    </footer>

</body>

</html>