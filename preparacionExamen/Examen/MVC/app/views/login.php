<?php include 'header.php'; ?>
<form method="post" action="/login">
    <h2>Login</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Login</button>
    <p><a href="/register">Register</a></p>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</form>