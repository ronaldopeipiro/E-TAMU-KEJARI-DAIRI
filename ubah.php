include "function.php";

$data = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE no_hp LIKE '8%' ");

while ($row = mysqli_fetch_assoc($data)) {
$id_tamu = $row['id_tamu'];

$no_hp = $row['no_hp'];
$no_baru = "0" . $no_hp;

mysqli_query($conn, "UPDATE tb_tamu SET no_hp='$no_baru' WHERE id_tamu='$id_tamu' ");
}