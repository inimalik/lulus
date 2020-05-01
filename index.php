<?php
include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($que);
$timestamp = strtotime($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="aplikasi sederhana untuk menampilkan pengumuman hasil ujian nasional secara online">
    <meta name="author" content="slamet.bsan@gmail.com">
    <title>Pengumuman Kelulusan</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/kelulusan.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">Info Kelulusan <?=$hsl['sekolah'] ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    
    <div class="container">
        <!-- <h2 align="center">Pengumuman Kelulusan <?=$hsl['tahun'] ?></h2> -->
        <h3 align="center" style="font-weight: bold;">Pengumuman Kelulusan </h3>
        <h3 align="center" style="font-weight: bold;">SMP IT - SMA - SMK YP IPPI Petojo Tahun 2019/2020</h3>
		<!-- countdown -->
		
		<div id="clock" class="lead"></div>
		
		<div id="xpengumuman">
<?php
	if(isset($_REQUEST['submit']))
	{
		//tampilkan hasil queri jika ada
		$no_ujian = $_REQUEST['nomor'];
		
		$hasil = mysqli_query($db_conn,"SELECT * FROM un_siswa WHERE no_ujian='$no_ujian'");
		if(mysqli_num_rows($hasil) > 0)
		{
			$data = mysqli_fetch_array($hasil);
			
?>
			<table class="table table-bordered">
				<tr>
					<td>Nomor Ujian</td>
					<td><?php echo $data['no_ujian']; ?></td>
				</tr>
				<tr>
					<td>NISN</td>
					<td><?php echo $data['nisn']; ?></td>
				</tr>
				<tr>
					<td>Nama Siswa</td>
					<td><?php echo strtoupper($data['nama']); ?></td>
				</tr>
				<tr>
					<?php
						if($data['komli']=='MIPA'||$data['komli']=='IPS')
						{
					?>

						<td>Jurusan</td>
						<td><?php echo "12 ".$data['komli']; ?></td>
					<?php 
						}
						elseif ($data['komli']=='TKJ'||$data['komli']=='AP'||$data['komli']=='AK'||$data['komli']=='PM')
						{?>
						<td>Kompetensi Keahlian</td>
						<td><?php echo "12 ".$data['komli']; ?></td>
					<?php
						} ?>
				</tr>
			</table>
			<table class="table table-bordered">
			<?php
				if($data['instansi']=="sma")
				{
			?>
				<tr>
					<td class="text-center" width="5%">No</td>
					<td class="text-center" width="85%">Mata Pelajaran</td>
					<td class="text-center" width="10%">Nilai</td>
				</tr>
				<tr>
					<td colspan="3" class="text-center">Kelompok A (Wajib)</td>
				</tr>
				<tr>
					<td>1</td>
					<td>Pendidikan Agama dan Budi Pekerti</td>
					<td class="text-center"><?php echo $data['n_pai']; ?></td>
				</tr>
				<tr>
					<td>2</td>
					<td>Pendidikan Kewarganegaraan</td>
					<td class="text-center"><?php echo $data['n_pkn']; ?></td>
				</tr>
				<tr>
					<td>3</td>
					<td>Bahasa Indonesia</td>
					<td class="text-center"><?php echo $data['n_bindo']; ?></td>
				</tr>
				<tr>
					<td>4</td>
					<td>Matematika</td>
					<td class="text-center"><?php echo $data['n_mtk']; ?></td>
				</tr>
				<tr>
					<td>5</td>
					<td>Sejarah Indonesia</td>
					<td class="text-center"><?php echo $data['n_sejin']; ?></td>
				</tr>
				<tr>
					<td>6</td>
					<td>Bahasa Inggris</td>
					<td class="text-center"><?php echo $data['n_bing']; ?></td>
				</tr>
				<tr>
					<td colspan="3" class="text-center">Kelompok B (Wajib)</td>
				</tr>
				<tr>
					<td>7</td>
					<td>Seni Budaya</td>
					<td class="text-center"><?php echo $data['n_sen']; ?></td>
				</tr>
				<tr>
					<td>8</td>
					<td>Pendidikan Jasmani dan Kesehatan</td>
					<td class="text-center"><?php echo $data['n_penj']; ?></td>
				</tr>				
				<tr>
					<td>9</td>
					<td>Prakarya dan Kewirausahaan</td>
					<td class="text-center"><?php echo $data['n_pkwu']; ?></td>
				</tr>
				<tr>
					<td colspan="3" class="text-center">Kelompok C (Peminatan)</td>
				</tr>
				<?php
					if($data['komli']=="MIPA")
					{
				?>
				<tr>
					<td>10</td>
					<td>Matematika</td>
					<td class="text-center"><?php echo $data['n_mtkp']; ?></td>
				</tr>
				<tr>
					<td>11</td>
					<td>Biologi</td>
					<td class="text-center"><?php echo $data['n_bio']; ?></td>
				</tr>
				<tr>
					<td>12</td>
					<td>Fisika</td>
					<td class="text-center"><?php echo $data['n_fis']; ?></td>
				</tr>
				<tr>
					<td>13</td>
					<td>Kimia</td>
					<td class="text-center"><?php echo $data['n_kim']; ?></td>
				</tr>				
				<?php
					}
					elseif ($data['komli']=="IPS") 
					{
				?>
				<tr>
					<td>10</td>
					<td>Geografi</td>
					<td class="text-center"><?php echo $data['n_geo']; ?></td>
				</tr>
				<tr>
					<td>11</td>
					<td>Sejarah</td>
					<td class="text-center"><?php echo $data['n_sej']; ?></td>
				</tr>
				<tr>
					<td>12</td>
					<td>Sosiologi</td>
					<td class="text-center"><?php echo $data['n_sos']; ?></td>
				</tr>
				<tr>
					<td>13</td>
					<td>Ekonomi</td>
					<td class="text-center"><?php echo $data['n_eko']; ?></td>
				</tr>
				<?php
					
					}
				?>
				<tr>
					<td colspan="3" class="text-center">Kelompok D (Pendalaman Minat)</td>
				</tr>
				<tr>
					<td>14</td>
					<td>Bahasa Arab</td>
					<td class="text-center"><?php echo $data['n_barab']; ?></td>
				</tr>
			<?php

				}
				elseif ($data["instansi"]=="smk")
				{
					echo "wokeh";
				}

			?>

				
			</table>
			
			<?php
			
				if( $data['status'] == 1 )
				{
					echo '<div class="alert alert-success" role="alert"><strong>SELAMAT !</strong> Anda dinyatakan LULUS.</div>';
				} else 

				{
					echo '<div class="alert alert-danger" role="alert"><strong>MAAF !</strong> Anda dinyatakan TIDAK LULUS.</div>';
			}
			?>
			
			<form method="post" action="prosespdf.php">
				<input type="hidden" name="nopes" value=<?php echo $data["no_ujian"]; ?>>
				<input type="submit" name="submit" value="Klik Untuk Download SKL" class="btn btn-primary btn-sm">
			</form>

		<?php
		}
		else 
		{
			echo 'nomor ujian yang anda inputkan tidak ditemukan! periksa kembali nomor ujian anda.';
			//tampilkan pop-up dan kembali tampilkan form
		}
	}
	else
	{
		//tampilkan form input nomor ujian
	?>
    <p>Masukkan nomor ujianmu pada form yang disediakan.</p>
    
    <form method="post">
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <input type="text" name="nomor" class="form-control" placeholder="Nomor Ujian" required>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" name="submit">Periksa!</button>
            </span>
        </div>
    </form>
	<?php
	}
?>
		</div>
    </div><!-- /.container -->
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?=$hsl['tahun'] ?> &middot; Tim IT <?=$hsl['sekolah'] ?></p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?=$hsl['tgl_pengumuman'] ?>", {elapse: true})
	.on('update.countdown', function(event) {
	var $this = $(this);
	if (event.elapsed) {
		$( "#xpengumuman" ).show();
		$( "#clock" ).hide();
	} else {
		$this.html(event.strftime('Pengumuman dapat dilihat: <span>%D Hari %H Jam %M Menit %S Detik</span> lagi'));
		$( "#xpengumuman" ).hide();
	}
	});

	</script>
</body>
</html>