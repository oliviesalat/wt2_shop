<?php

?>

<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Main</a>
            <a class="navbar-brand" href="/products">Products</a>
        </div>
    </div>
    <div class="text-light">
        <a class="navbar-brand" href="/cart">Cart</a>
        <?php

        if ($_SESSION['is_logged'] === true) {
            echo "<a class='navbar-brand' href='/profile'> Hello, " . htmlspecialchars($_SESSION['email']) . "</a>";
        } else {
            echo "<a class='navbar-brand' href='/auth_page'>Auth</a>";
        }
        ?>

    </div>

</nav>
<?php
//var_dump($_SESSION);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

