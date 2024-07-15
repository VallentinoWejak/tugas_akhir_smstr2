<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'fian_web');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel data_covid
$query = "SELECT SUM(sembuh) AS total_sembuh, SUM(dirawat) AS total_dirawat, SUM(meninggal) AS total_meninggal, SUM(total) AS total_semua FROM data_covid";
$result = $conn->query($query);

if (!$result) {
    die("Query error: " . $conn->error);
}

// Ambil hasil query
$row = $result->fetch_assoc();

// Format data hasil query ke dalam array asosiatif
$total_data = array(
    'sembuh' => $row['total_sembuh'],
    'dirawat' => $row['total_dirawat'],
    'meninggal' => $row['total_meninggal'],
    'total_semua' => $row['total_semua']
);

// Mengembalikan data dalam format JSON
echo json_encode($total_data);

// Menutup koneksi database
$conn->close();
?>
