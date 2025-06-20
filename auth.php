<?php
include_once("index_header.php");
?>

<form method="post">
    <label for="email">Email</label>
    <input id="email" type="email" name="email" required>
    <br>
    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
</form>

<?php
include_once("index_footer.php");