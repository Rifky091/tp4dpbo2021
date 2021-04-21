<?php
class Task extends DB
{

	// Mengambil data

	function getTask()
	{
		// Query mysql select data ke mahasiswa
		$query = "SELECT * FROM mahasiswa";

		// Mengeksekusi query
		return $this->execute($query);
	}
	function add($nim, $nama, $jk, $ttl, $kelas, $status_td = "Belum")
	{
		// Query mysql insert data ke mahasiswa
		$query = "INSERT INTO mahasiswa  (nim, nama, jk, ttl, kelas, status_td)  VALUES ('$nim','$nama','$jk','$ttl','$kelas','$status_td')";
		return $this->execute($query);
	}
	function delete($id)
	{
		// Query mysql delete data dari mahasiswa
		$query = "DELETE FROM mahasiswa where id = $id";
		return $this->execute($query);
	}
	function setStatus($id)
	{

		$query = "UPDATE mahasiswa SET status_td='Sudah' WHERE id='$id'";

		return $this->execute($query);
	}
}
