<?php

/******************************************
PRAKTIKUM RPL
 ******************************************/

use phpDocumentor\Reflection\Location;

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");
// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

if (isset($_POST['add'])) {
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$jk = $_POST['jk'];
	$ttl = $_POST['ttl'];
	$kelas = $_POST['kelas'];
	$status = "Belum";

	$otask->add($nim, $nama, $jk, $ttl, $kelas, $status);
	header("location:index.php");
}
if (isset($_GET['id_hapus'])) {
	$id = $_GET['id_hapus'];
	echo ($id);

	$otask->delete($id);
	header("location:index.php");
}
if (isset($_GET['id_status'])) {
	$id = $_GET['id_status'];

	$otask->setStatus($id);
	header("location:index.php");
}




while (list($id, $nim, $nama, $jk, $ttl, $kelas, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if ($tstatus == "Sudah") {
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $nim . "</td>
		<td>" . $nama . "</td>
		<td>" . $jk . "</td>
		<td>" . $ttl . "</td>
		<td>" . $kelas . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else {
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $nim . "</td>
		<td>" . $nama . "</td>
		<td>" . $jk . "</td>
		<td>" . $ttl . "</td>
		<td>" . $kelas . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();
