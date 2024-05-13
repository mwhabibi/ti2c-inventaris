<!DOCTYPE html>
<html>
<head>
	<title>Stok Barang</title>
    <link rel="stylesheet" type="text/css" href="style-stok.css">
</head>
<body>
	<h1>Daftar Stok Barang</h1>

	<table border="1">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Qty</th>
				<th>Satuan</th>
				<th>Harga Beli (Rp.)</th>
				<th>Harga Jual (Rp.)</th>
				<th>Tanggal Masuk</th>
				<th>Tanggal Kadaluarsa</th>
				<th>Supplier</th>
			</tr>
		</thead>
		<tbody>
			<?php
			include("db.php");

			// Retrieve data from barang table
			$sql = "SELECT * FROM barang";
			$result = $conn->query($sql);

			// Display data in table
			if ($result->num_rows > 0) {
				$no = 1;
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $no . "</td>";
					echo "<td>" . $row["kode_barang"] . "</td>";
					echo "<td>" . $row["nama_barang"] . "</td>";
					echo "<td>" . $row["qty"] . "</td>";
					echo "<td>" . $row["satuan"] . "</td>";
					echo "<td>" . number_format($row["harga_beli"], 0, ',', '.') . "</td>"; // Display harga beli with Rupiah format
					echo "<td>" . number_format($row["harga_jual"], 0, ',', '.') . "</td>"; // Display harga jual with Rupiah format
					echo "<td>" . $row["tanggal_masuk"] . "</td>";
					echo "<td>" . $row["tanggal_kadaluarsa"] . "</td>";
					echo "<td>" . $row["supplier"] . "</td>";
					echo "</tr>";
					$no++;
				}
			} else {
				echo "<tr><td colspan='10'>Tidak ada data.</td></tr>";
			}

			// Close the database connection
			$conn->close();
			?>
		</tbody>
	</table>
    <br><br>
    <div class="tambah-barang">
	<a href="input-barang.html">Tambah Barang</a>
    </div>
    <div class="logout">
    <a href="logout.php">Logout</a>
    </div>
</body>
</html>