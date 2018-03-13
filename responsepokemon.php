<?php
	include("connect.php");

	

	if($_POST['jenis'] == "simpan"){
		$p1 = $_POST['p1'];
		$p2 = $_POST['p2'];
		$p3 = $_POST['p3'];
		$p4 = $_POST['p4'];
		$p5 = $_POST['p5'];
		$qry = mysqli_query($conn,"select * from pokemon where id = '$p1'");
		if(mysqli_num_rows($qry) > 0){
			echo "double";
		}
		else{
			mysqli_query($conn, "insert into pokemon values ('$p1','$p2','$p3','$p4','$p5')");
			echo "sukses";
		}
	}
	else if($_POST['jenis'] == "delete") {
		$p1 = $_POST['p1']; 
		mysqli_query($conn,"delete from pokemon where id = '$p1'"); 
		echo "sukses"; 
	}
	else if($_POST['jenis'] == "edit") {
		$p1 = $_POST['p1']; 
		$qry= mysqli_query($conn,"select * from pokemon where id = '$p1'"); 
		$row= mysqli_fetch_array($qry); 
		echo $row['id']."-".$row['nama']."-"; 
	}
	else if($_POST['jenis'] == "update"){
		echo "sukses";
		$p1 = $_POST['p1']; 
		$qry = mysqli_query($conn,"select * from pokemon where id = '$p1'");
		$row = mysqli_fetch_array($qry);
		$id = $row['id'];
		$nama = $row['nama'];
		$jenis = $row['jenis'];
		$hp = $row['hp'];
		$sp = $row['sp'];
		if(mysqli_num_rows($qry) == 0){
			echo "kosong";
		}
		else{
			mysqli_query($conn,"update pokemon set nama = '$nama', jenis ='$jenis', hp ='$hp', sp ='$sp' where id = '$id'"); 
			echo "sukses";
		}
		
	}
	
	else if($_POST['jenis'] == "showall") {
		echo "<table border='1'>";
		$qry= mysqli_query($conn,"select * from pokemon"); 
		echo "<tr>"; 
			echo "<td align='center'>KODE</td>"; 
			echo "<td align='center'>NAMA</td>"; 
			echo "<td align='center'>JENIS</td>"; 
			echo "<td align='center'>HP</td>"; 
			echo "<td align='center'>SP</td>";
			echo "<td align='center'>EDIT</td>"; 
			echo "<td align='center'>DELETE</td>";   
		echo "</tr>"; 
		while($row = mysqli_fetch_array($qry)) {
			echo "<tr>";
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['nama']."</td>";
				echo "<td>".$row['jenis']."</td>";
				echo "<td>".$row['hp']."</td>";
				echo "<td>".$row['sp']."</td>";
				echo "<td  align='center'><img src='edit.jpg' width='20px' height='20px' onclick=edit('".$row['id']."')></td>";
				echo "<td  align='center'><img src='delete.jpg' width='20px' height='20px' onclick=hapus('".$row['id']."')></td>";
			echo "</tr>";	
		}
		echo "</table>";
	}
	else if($_POST['jenis'] == "searchmhs") {
		$p1 = $_POST['p1']; 
		$row = mysqli_query($con,"select * from mhs where nrp like '$p1%'");
		echo "<table border='1'>"; 
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