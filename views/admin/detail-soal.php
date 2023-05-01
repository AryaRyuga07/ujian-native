<?php 
require '../../model/db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MyExam | Detail Soal</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
	<link rel="stylesheet" href="../../assets/css/style.css">
	<link rel="stylesheet" href="../../assets/css/card.css">
</head>

<body>
	<div class="container">
		<aside>
			<div class="top">
				<div class="logo">
					<img src="../../assets/img/me.jpg">
					<h2>MyExam</h2>
				</div>
				<div class="close" id="close-btn">
					<span class="material-symbols-sharp">close</span>
				</div>
			</div>

			<div class="sidebar">
				<a href="index.php" class="off">
					<span class="material-symbols-sharp">dashboard</span>
					<h3>Dashboard</h3>
				</a>
				<a href="jurusan.php" class="off">
					<span class="material-symbols-sharp">groups</span>
					<h3>Jurusan</h3>
				</a>
				<a href="kelas.php" class="off">
					<span class="material-symbols-sharp">meeting_room</span>
					<h3>Kelas</h3>
				</a>
				<a href="guru.php" class="off">
					<span class="material-symbols-sharp">supervisor_account</span>
					<h3>Guru</h3>
				</a>
				<a href="siswa.php" class="off">
					<span class="material-symbols-sharp">person</span>
					<h3>Siswa</h3>
				</a>
				<a href="mapel.php" class="off">
					<span class="material-symbols-sharp">menu_book</span>
					<h3>Mata Pelajaran</h3>
				</a>
				<a href="soal.php" class="off">
					<span class="material-symbols-sharp">sticky_note_2</span>
					<h3>Soal</h3>
				</a>
				<a href="detail-soal.php" class="active">
					<span class="material-symbols-sharp">sticky_note_2</span>
					<h3>Detail Soal</h3>
				</a>
				<a href="func/out.php">
					<span class="material-symbols-sharp">logout</span>
					<h3>Logout</h3>
				</a>
			</div>
		</aside>

		<main>
			<h1>Detail Soal</h1>

			<div class="recent-orders">
				<h2>Daftar Detail Soal</h2>
				<form action="" method="post">
					<select name="soal" id="soal" style="margin: 10px 0; border: 1px solid black; border-radius: 10px; padding: 3px 10px;">
						<option>--pilih soal--</option>
						<?php
						$soal = mysqli_query($conn, "SELECT * FROM tb_headsoal");
						while($s = mysqli_fetch_object($soal)) {
						?>
							<option value="<?= $s->id_soal ?>"><?= $s->id_soal ?></option>
						<?php } ?>
					</select>
					<button style="background-color: lightblue; margin: 0 10px; border: 1px solid black; border-radius: 10px; padding: 3px 10px;">Generate</button>
				</form>
				<table>
					<thead>
						<tr>
							<th>ID Soal</th>
							<th>Soal</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						
						// error_reporting(0);
						if($_POST != NULL){
							$idSoal = $_POST['soal'];
							$dsoal = mysqli_query($conn, "SELECT * FROM tb_detail_soal WHERE id_soal = '" . $idSoal . "' ORDER BY id_soal DESC");
						} else {
							$dsoal = mysqli_query($conn, "SELECT * FROM tb_detail_soal ORDER BY id_soal DESC");
						}
						if (mysqli_num_rows($dsoal) > 0) {
							while ($ds = mysqli_fetch_object($dsoal)) {
						?>
								<tr>
									<td><?= $ds->id_soal ?></td>
									<td><?= $ds->soal ?></td>
									<td>
										<a href="detail-soal.php?id=<?= $ds->id ?>#edit" class="primary">Edit</a>
										<div class="overlay" id="edit">
											<a href="detail-soal.php" class="close"><span class="material-symbols-sharp">close</span></a>
											<div class="add-card">
												<div class="middle">
													<div class="left">
														<h1>Edit Detail Soal</h1>
														<div class="form">
															<form action="func/ubah-detail-soal.php" method="post" class="input-form">
																<?php
																$id = $_GET['id'];
																$ds_sl = mysqli_query($conn, "SELECT * FROM tb_detail_soal WHERE id = '$id'");
																$dsl = mysqli_fetch_object($ds_sl);
																?>
																<select name="id_soal" required>
																	<option value="">--pilih soal--</option>
																	<?php
																	$soal = mysqli_query($conn, "SELECT * FROM tb_headsoal ORDER BY id_soal DESC");
																	while ($s = mysqli_fetch_object($soal)) {
																	?>
																		<option value="<?= $s->id_soal ?>" <?= ($dsl->id_soal == $s->id_soal) ? 'selected' : ''; ?>><?= $s->id_soal ?></option>
																	<?php } ?>
																</select>
																<input type="hidden" name="id" value="<?= $dsl->id ?>">
																<textarea name="soal" cols="30" placeholder="Soal" style="resize: none; padding-bottom: 50px;"><?= $dsl->soal ?></textarea>
																<input type="text" name="a" placeholder="Jawaban A" value="<?= $dsl->a ?>" autocomplete="off">
																<input type="text" name="b" placeholder="Jawaban B" value="<?= $dsl->b ?>" autocomplete="off">
																<input type="text" name="c" placeholder="Jawaban C" value="<?= $dsl->c ?>" autocomplete="off">
																<input type="text" name="d" placeholder="Jawaban D" value="<?= $dsl->d ?>" autocomplete="off">
																<select name="jawaban" required>
																	<option value="">--pilih jawaban--</option>
																	<option value="A" <?= ($dsl->jawaban == 'A') ? 'selected' : ''; ?>>A</option>
																	<option value="B" <?= ($dsl->jawaban == 'B') ? 'selected' : ''; ?>>B</option>
																	<option value="C" <?= ($dsl->jawaban == 'C') ? 'selected' : ''; ?>>C</option>
																	<option value="D" <?= ($dsl->jawaban == 'D') ? 'selected' : ''; ?>>D</option>
																</select>
																<button name="edit">Save</button>
															</form>
															<form action="detail-soal.php" method="post" class="cancel-form">
																<button>Cancel</button>
															</form>
														</div>
													</div>
												</div>
												<small class="text-muted"></small>
											</div>
										</div>
									</td>
									<td>
										<a href="detail-soal.php?id=<?= $ds->id ?>#del" class="danger">
											Delete
										</a>
										<div class="overlay" id="del">
											<a href="detail-soal.php" class="close"><span class="material-symbols-sharp">close</span></a>
											<div class="add-card">
												<div class="middle">
													<div class="left">
														<h2>Apakah anda ingin menghapus data ini?</h2>
														<div class="form">
															<form action="func/hapus-detail-soal.php" method="post" class="input-form">
																<?php
																$id = $_GET['id'];
																$ds_sl = mysqli_query($conn, "SELECT * FROM tb_detail_soal WHERE id = '$id'");
																$dsl = mysqli_fetch_object($ds_sl);
																?>
																<input type="hidden" name="id" value="<?= $dsl->id ?>">
																<button name="del">Delete</button>
															</form>
															<form action="detail-soal.php" method="post" class="cancel-form">
																<button>Cancel</button>
															</form>
														</div>
													</div>
												</div>
												<small class="text-muted"></small>
											</div>
										</div>
									</td>
									<td>
										<a href="#details" class="primary">Details</a>
										<div class="overlay" id="details">
											<a href="detail-soal.php" class="close"><span class="material-symbols-sharp">close</span></a>
											<div class="add-card">
												<div class="middle">
													<div class="left">
														<h1>Detail Soal</h1>
													</div>
												</div>
												<small class="text-muted"></small>
											</div>
										</div>
									</td>
								</tr>
							<?php }
						} else { ?>
							<tr>
								<td colspan="6">Tidak Ada Data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<a href="#tambah" class="primary">+ Tambah Detail Soal</a>
				<div class="overlay" id="tambah">
					<a href="detail-soal.php" class="close"><span class="material-symbols-sharp">close</span></a>
					<div class="add-card">
						<div class="middle">
							<div class="left">
								<h1>Tambah Detail Soal</h1>
								<div class="form">
									<form action="func/tambah-detail-soal.php" method="post" class="input-form">
										<select name="id_soal" required>
											<option value="">--pilih soal--</option>
											<?php
											$soal = mysqli_query($conn, "SELECT * FROM tb_headsoal ORDER BY id_soal DESC");
											while ($s = mysqli_fetch_object($soal)) {
											?>
												<option value="<?= $s->id_soal ?>"><?= $s->id_soal ?></option>
											<?php } ?>
										</select>
										<?php
										// error_reporting(0);
										?>
										<textarea name="soal" cols="30" placeholder="Soal" style="resize: none; padding-bottom: 50px;"></textarea>
										<input type="text" name="a" placeholder="Jawaban A" autocomplete="off">
										<input type="text" name="b" placeholder="Jawaban B" autocomplete="off">
										<input type="text" name="c" placeholder="Jawaban C" autocomplete="off">
										<input type="text" name="d" placeholder="Jawaban D" autocomplete="off">
										<select name="jawaban" required>
											<option value="">--pilih jawaban--</option>
											<option value="A">A</option>
											<option value="B">B</option>
											<option value="C">C</option>
											<option value="D">D</option>
										</select>
										<button name="save">Save</button>
									</form>
									<form action="detail-soal.php" method="post" class="cancel-form">
										<button>Cancel</button>
									</form>
								</div>
							</div>

						</div>
						<small class="text-muted"></small>
					</div>
				</div>
			</div>
		</main>


		<div class="right">
			<div class="top">
				<button id="menu-btn">
					<span class="material-symbols-sharp">menu</span>
				</button>
				<div class="theme-toggler">
					<span class="material-symbols-sharp active">light_mode</span>
					<span class="material-symbols-sharp">dark_mode</span>
				</div>
				<div class="profile">
					<div class="info">
						<p>Hey, <b>Ryuga</b></p>
						<small class="text-muted">Admin</small>
					</div>
					<div class="profile-photo">
						<img src="../../assets/img/profile.png">
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../../assets/js/script.js"></script>
</body>

</html>