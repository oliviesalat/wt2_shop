<?php
include_once(__DIR__ . "/../templates/index_header.php");
?>

    <form method="post" action="../actions/register.php" class="container mt-4" style="max-width: 500px;">
        <h2 class="mb-4">Register</h2>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" name="email" type="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input id="name" name="name" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="surname" class="form-label">Surname</label>
            <input id="surname" name="surname" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Telephone</label>
            <input id="telephone" name="telephone" type="tel" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>

<?php
include_once(__DIR__ . "/../templates/index_footer.php");