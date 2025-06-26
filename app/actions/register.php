<?php
include_once(__DIR__ . "/../templates/index_header.php");

$db = Database::db_connect();

$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$name = $_POST["name"];
$surname = $_POST["surname"];
$telephone = !empty($_POST["telephone"]) ? $_POST["telephone"] : null;


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $stmt = $db->prepare("INSERT INTO users (email, password, name, surname, telephone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $password, $name, $surname, $telephone);
    $stmt->execute();
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
<h2>You have successfully registered</h2>
    <div class="d-flex justify-content-center my-4">
        <a href="/auth_page" class="btn btn-outline-primary">
            Return to auth
        </a>
    </div>
<?php
include_once(__DIR__ . "/../templates/index_footer.php");