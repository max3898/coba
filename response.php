<?php
session_start(); 
include("connect.php"); 

if($_POST['jenis'] == "ubahkota") {
	$pk = $_POST['pk']; 
	$qry= mysqli_query($con,"select * from divisi where kodekota = '".$pk."'"); 
	while($row = mysqli_fetch_array($qry)) {
		echo "<option value='".$row['namadivisi']."'>".$row['namadivisi']."</option>"; 
	}
}
else if($_POST['jenis'] == "showall") {
	echo "<table border='1'>";
	$qry= mysqli_query($con,"select * from pegawai"); 
	while($row = mysqli_fetch_array($qry)) {
		echo "<tr>";
			echo "<td>".$row['nik']."</td>";
			echo "<td>".$row['nama']."</td>";
			echo "<td>".$row['gaji']."</td>";
			echo "<td>".$row['tgllahir']."</td>";
			echo "<td>".$row['kota']."</td>";
			echo "<td>".$row['divisi']."</td>";
		echo "</tr>";	
	}
	echo "</table>";
}
else if($_POST['jenis'] == "searchpegawai") {
	$cari = $_POST['cari'];
	echo "<table border='1'>";
	$qry= mysqli_query($con,"select * from pegawai where nama like '".$cari."%'"); 
	while($row = mysqli_fetch_array($qry)) {
		echo "<tr>";
			echo "<td>".$row['nik']."</td>";
			echo "<td>".$row['nama']."</td>";
			echo "<td>".$row['gaji']."</td>";
			echo "<td>".$row['tgllahir']."</td>";
			echo "<td>".$row['kota']."</td>";
			echo "<td>".$row['divisi']."</td>";
		echo "</tr>";	
	}
	echo "</table>";
}

else if($_POST['jenis'] == "simpanpegawai") {
	$nama = $_POST['nama']; 
	$gaji = $_POST['gaji']; 
	$lahir= $_POST['lahir']; 
	$kt = $_POST['kt']; 
	$dv = $_POST['dv']; 
	if ($gaji <5000000)
	{
		echo "dibawah";
	}
	else if ($gaji > 10000000)
	{
		echo "diatas";
	}
	else
	{
		$usia = date("Y") - date("Y",strtotime($lahir));
		if($usia>=17){
			$qry2 = mysqli_query($con,"select * from pegawai where nama = '".$nama."'");
			if(mysqli_num_rows($qry2)==0){
				$nik = strtoupper(substr($kt,0,3).substr($dv,0,2)); 
				$qry = mysqli_query($con,"select * from pegawai where nik like '".$nik."%'");
				
				$num = mysqli_num_rows($qry); 
				$num++; 
				if($num < 10) { $nik = $nik."00".$num; }
				else if($num < 100) { $nik = $nik."0".$num; }
				else  { $nik = $nik.$num; }
				mysqli_query($con,"insert into pegawai values ('$nik','$nama',$gaji,'$lahir','$kt','$dv')");
				echo "sukses";
			}else{
				echo "double";
			}
		}else{
			echo "tidakcukupumur";
		}
		
	}
}
else if($_POST['jenis'] == "insert") { 
	$p1 = $_POST['p1']; 
	$p2 = $_POST['p2']; 
	$p3 = $_POST['p3']; 
	
	$row = mysqli_query($con, "select * from mhs where nrp = '$p1'"); 
	if(mysqli_num_rows($row) > 0) { 
		echo "double"; 
	}
	else {
		mysqli_query($con, "insert into mhs values ('$p1','$p2',$p3)"); 
		echo "sukses"; 
	}
}
else if($_POST['jenis'] == "update"){
	$p1 = $_POST['p1'];
	$p2 = $_POST['p2'];
	$p3 = $_POST['p3'];
	$sql = mysqli_query($con, "select * from mhs where nrp = '$p1'");
	if(mysqli_num_rows($sql) == 0){
		echo "nothing";
	}
	else{
		mysqli_query($con, "update mhs set nrp='$p1', nama='$p2', nilai ='$p3' where nrp = '$p1'");
		echo "sukses";
	}
}
else if($_POST['jenis'] == "delete"){
	$p1 = $_POST['p1'];
	$sql = mysqli_query($con, "select * from mhs where nrp = '$p1'");
	if(mysqli_num_rows($sql) == 0){
		echo "nothing";
	}
	else{
		mysqli_query($con, "delete from mhs where nrp='$p1'");
		echo "sukses";
	}
}
else if($_POST['jenis'] == "searchmhs") {
	$p1 = $_POST['p1']; 
	echo "<table border='1'>"; 
	$row = mysqli_query($con,"select * from mhs where nrp like '$p1%'"); 
	while($r = mysqli_fetch_array($row)) 
	{
		echo "<tr>"; 
			echo "<td>".$r['nrp']."</td>"; 
			echo "<td>".$r['nama']."</td>"; 
			echo "<td>".$r['nilai']."</td>"; 
		echo "</tr>"; 
	}
	echo "</table>"; 
}
?>
