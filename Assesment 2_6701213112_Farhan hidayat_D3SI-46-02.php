SELECT * FROM kependudukan WHERE kabupaten = 'Barito Selatan'

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM kependudukan WHERE kabupaten = 'Barito Selatan'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}
$conn->close();
?>

$(document).ready(function(){
    $.ajax({
        url: "get_data.php",
        type: "GET",
        dataType: "json",
        success: function(data){
            // Proses data yang diterima dari server
            // Tampilkan data ke dalam tabel
            var table = "<table><tr><th>Nama</th><th>Usia</th><th>Aksi</th></tr>";
            $.each(data, function(index, item){
                table += "<tr>";
                table += "<td>" + item.nama + "</td>";
                table += "<td>" + item.usia + "</td>";
                table += "<td><button class='delete' data-id='" + item.id + "'>Hapus</button></td>";
                table += "</tr>";
            });
            table += "</table>";
            $("#data-container").html(table);
        }
    });
});

$(document).on("click", ".delete", function(){
    var id = $(this).data("id");
    $.ajax({
        url: "delete_data.php?id=" + id,
        type: "GET",
        success: function(response){
            // Refresh data setelah penghapusan
            // Panggil AJAX lagi
        }
    });
});

<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM kependudukan WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
