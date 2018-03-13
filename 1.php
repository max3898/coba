
<script src="jquery.js" language="javascript"></script>
<script language="javascript">

function simpanmhs() {
	var a = $("#t1").val(); 
	var b = $("#t2").val(); 
	var c = $("#t3").val(); 
	
	$.post("response.php",
		{jenis: "insert", p1: a, p2: b, p3: c},
		function(data) {
			alert(data); 
			if(data == "double") {
				alert("hei nrp sudah terdaftar"); 
			}
			else if(data == "sukses") { 
				alert("berhasil"); 
				$("#t1").val(""); 
				$("#t2").val(""); 
				$("#t3").val(""); 
			}
		}
	);
}

function updatemhs() {
	var a = $("#t1").val(); 
	var b = $("#t2").val(); 
	var c = $("#t3").val(); 
	
	$.post("response.php",
		{jenis : "update",p1 : a, p2 : b, p3 : c},
		function(data) {
			if(data == "nothing") {
				alert("nrp tsb blm terdaftar"); 
			}
			else if(data == "sukses") { 
				alert("berhasil update data"); 
				$("#t1").val(""); 
				$("#t2").val(""); 
				$("#t3").val(""); 
			}
		}
	); 
}

function deletemhs() {
	var a = $("#t1").val(); 
	
	$.post("response.php",
		{jenis : "delete",p1 : a},
		function(data) {
			if(data == "nothing") {
				alert("nrp tsb blm terdaftar"); 
			}
			else if(data == "sukses") { 
				alert("berhasil delete data"); 
				$("#t1").val(""); 
				$("#t2").val(""); 
				$("#t3").val(""); 
			}
		}
	); 
}

function showmhs()
{
	$.post("response.php",
		{ jenis: "showmhs" },
		function(data) {
			$("#kotakku").html(data); 
			/*
			$("#kotakku").fadeOut('slow',function() {
				$("#kotakku").html(data); 
				$("#kotakku").fadeIn('slow'); 
			});
			*/
		}
	);
}

function searchmhs()
{
	var a = $("#ts").val(); 
	$.post("response.php",
		{ jenis: "searchmhs", p1: a },
		function(data) {
			$("#kotakku").html(data); 
		}
	); 
}

</script>
<form action="1.php">
<input type="checkbox" id="chk1">
Nrp :   <input type="text" name="t1" id="t1"><br>
Nama :  <input type="text" name="t2" id="t2"><br>
Nilai : <input type="text" name="t3" id="t3"><br>
<input type="submit">
<input type="button" name="b1" id="b1" value="Simpan" onclick="simpanmhs()">
<input type="BUTTON" name="b2" id="b2" value="Update" onclick="updatemhs()">
<input type="BUTTON" name="b3" id="b3" value="Delete" onclick="deletemhs()"><br>
<input type="BUTTON" name="b4" id="b4" value="Show Mahasiswa" onclick="showmhs()"><br>
<input type="text" id="ts" onkeyup="searchmhs()">
<input type="button" value="Search" onclick="searchmhs()">
<br><br>
<div id="kotakku">-----</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</form>