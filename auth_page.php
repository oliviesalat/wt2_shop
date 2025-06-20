<?php
include_once("index_header.php");

if ($_SESSION['is_logged'] === false) {
    echo "You are not logged in!";
} else {
    header("Location: profile.php");
}
?>

    <form method="post" action="auth.php" class="container mt-4" style="max-width: 500px;">
        <h2 class="mb-4">Auth</h2>
        <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
    <div class="d-flex justify-content-center my-4">
        <a href="registration_page.php" class="btn btn-outline-primary">
            Haven`t registered yet?
        </a>
    </div>


<?php
include_once("index_footer.php");