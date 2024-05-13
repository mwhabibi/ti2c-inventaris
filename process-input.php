<?php
include("db.php");

// Check if the table exists
$table_check = "SHOW TABLES LIKE 'barang'";
$result = $conn->query($table_check);

if ($result->num_rows == 0) {
    // Create table
    $sql = "CREATE TABLE IF NOT EXISTS barang (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        kode_barang VARCHAR(30) NOT NULL,
        nama_barang VARCHAR(30) NOT NULL,
        qty INT(6) NOT NULL,
        satuan ENUM('Pcs','Box','Kg') NOT NULL,
        harga_beli DECIMAL(10, 2) NOT NULL,
        harga_jual DECIMAL(10, 2) NOT NULL,
        tanggal_masuk DATE NOT NULL,
        tanggal_kadaluarsa DATE NOT NULL,
        supplier VARCHAR(50) NOT NULL,
        ENGINE=InnoDB DEFAULT CHARSET=utf8
    )";

    if ($conn->query($sql) === FALSE) {
        echo "Error creating table: " . $conn->error;
    }
}

// Sanitize form data
$kode_barang = $conn->real_escape_string($_POST['kode_barang']);
$nama_barang = $conn->real_escape_string($_POST['nama_barang']);
$qty = $conn->real_escape_string($_POST['qty']);
$satuan = $conn->real_escape_string($_POST['satuan']);
$harga_beli = $conn->real_escape_string($_POST['harga_beli']);
$harga_jual = $conn->real_escape_string($_POST['harga_jual']);
$tanggal_masuk = $conn->real_escape_string($_POST['tanggal_masuk']);
$tanggal_kadaluarsa = $conn->real_escape_string($_POST['tanggal_kadaluarsa']);
$supplier = $conn->real_escape_string($_POST['supplier']);

// Insert form data into database
$sql = "INSERT INTO barang (kode_barang, nama_barang, qty, satuan, harga_beli, harga_jual, tanggal_masuk, tanggal_kadaluarsa, supplier) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissssss", $kode_barang, $nama_barang, $qty, $satuan, $harga_beli, $harga_jual, $tanggal_masuk, $tanggal_kadaluarsa, $supplier);

if ($stmt->execute() === TRUE) {
    echo "<script>alert('Data berhasil disimpan!!'); window.location.href = 'stok-barang.php'</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>