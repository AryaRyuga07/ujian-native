<?php 
require '../../../model/db.php';
// error_reporting(0);

function tambah($data){
	global $conn;

	$id_soal =  htmlspecialchars($data["id_soal"]);
	$soal =  htmlspecialchars($data["soal"]);
	$a =  htmlspecialchars($data["a"]);
	$b =  htmlspecialchars($data["b"]);
	$c =  htmlspecialchars($data["c"]);
	$d =  htmlspecialchars($data["d"]);
	$jawaban =  htmlspecialchars($data["jawaban"]);

	$query = "INSERT INTO tb_detail_soal
			VALUES 
			('','$id_soal','$soal','$a','$b','$c','$d','$jawaban')
			";
	mysqli_query($conn, "$query");

	return mysqli_affected_rows($conn);
}

if (isset($_POST["save"])) {
    if (isset($_FILES['uploaded_file'])) {
        $file_name = $_FILES['uploaded_file']['name'];
        $file_size = $_FILES['uploaded_file']['size'];
        $file_tmp = $_FILES['uploaded_file']['tmp_name'];
        $file_type = $_FILES['uploaded_file']['type'];

    }

    if (tambah($_POST) > 0) {
        echo "<script>
            alert('Soal berhasil ditambahkan');
            document.location.href = '../detail-soal.php';
        </script>";
    } else {
        echo "<script>
            alert('Soal gagal ditambahkan');
            document.location.href = '../detail-soal.php#tambah';
        </script>";
    }
}

 ?>