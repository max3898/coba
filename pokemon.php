<?php
	include ("connect.php");
	if (isset($_POST['b2'])){
		$p1 = $_POST['txtkode'];
		$p2 = $_POST['txtnama'];
		$p3 = $_POST['txtjenis'];
		$p4 = $_POST['hp'];
		$p5 = $_POST['sp'];
		mysqli_query($conn,"update pokemon set nama = '$p2', jenis ='$p3', hp ='$p4', sp ='$p5' where id = '$p1'");
	}
		
?>
<script language="javascript">
	function simpan() {
		var a = $("#txtkode").val();
		var b = $("#txtnama").val();
		var c = $("#txtjenis").val();
		var d = $("#hp").val();
		var e = $("#sp").val();
		alert(a); 

		$.post("responsepokemon.php",{jenis:"simpan", p1: a, p2 : b, p3 : c, p4 : d, p5 : e},function(data){
				alert(data);
				if(data == "double"){
					alert("kembar");
				}
				else if(data == "sukses"){
					alert("berhasil");
					$("#txtkode").val("");
					$("#txtnama").val("");
					$("#txtjenis").val("");
					$("#hp").val("");
					$("#sp").val("");
				}
			}
		);
	}

	function searchpokemon(){
			var a = $("#txtsearch").val();
			$.post("responsepokemon.php",{
				jenis: "search", p1:a
			},function(data){
				$("#hasilsearch").html(data);
			}
		);
	}

	function showall(){
			$.post("responsepokemon.php",{
				jenis: "showall"
			},function(data){
				$("#showall").html(data);
			}
		);
	}

	function hapus(id) {
			$.post("responsepokemon.php",{
				jenis: "delete", p1: id
			},function(data){
				showall(); 
			});
	}

	function edit(id) {
			$.post("responsepokemon.php",{
				jenis: "edit", p1: id
			},function(data){
				var arr = data.split("-"); 
				$("#txtkode").val(arr[0]); 
				$("#txtnama").val(arr[1]);
				$("#txtjenis").val(arr[2]);
				$("#hp").val(arr[3]); 
				$("#sp").val(arr[4]);
			});
	}
	function update(){
		var a = $("#txtkode").val();
		$.post("responsepokemon.php",{
			jenis:"update", p1 : a
		},function(data){
			if(data == "kosong"){
					alert("Sudah betul");
				}
			else{
				$("#txtkode").val("");
				$("#txtnama").val("");
				$("#txtjenis").val("");
				$("#hp").val("");
				$("#sp").val("");
				showall();
				alert("Data telah diupdate");

			}
		});
	}
</script>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="jquery.js" type="text/javascript"></script>
	<title> AJAX POKEMON </title>
</head>
<body>
	<form method="post" action="pokemon.php">
		<label>KODE : </label><input type="text" name ="txtkode" id="txtkode" placeholder="kode">
		<label>NAMA : </label><input type="text" name ="txtnama" id="txtnama" placeholder="nama">
		<label>JENIS : </label>
		<select id="txtjenis" name ="txtjenis">
			<?php
				include ("connect.php");
				$row = mysqli_query($conn,"select * from jenispokemon");
				while ($r = mysqli_fetch_array($row)) {
					echo "<option value='".$r['nama']."'>".$r['nama']."</option>";
				}		
			?>
		</select>
		<label>HP : </label><input type="number" name= "hp" id="hp" value="100">
		<label>SP : </label><input type="number" name= "sp" id="sp" value="100">
		<label>CARI : </label><input type="text" id="txtsearch" onkeyup="searchpokemon()" placeholder="CARI">
		<input type="BUTTON" name="b1" id="b1" value="SIMPAN" onclick="simpan()">
		<input type="submit" name="b2" id="b2" value="UPDATE" >
		<input type="BUTTON" name="b3" id="b3" value="SHOW" onclick="showall()">
		<div id="showall" style="background-color:red;">kosong</div>
	</form>
</body>
</html>
