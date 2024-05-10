<?php include 'header.php'; ?>
<form method="post" action="/register">
    <h2>Register</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Register</button>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</form>
