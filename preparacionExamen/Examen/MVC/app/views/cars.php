<?php include 'header.php'; ?>
<h2>Cars</h2>
<form method="post" action="/cars">
    <label for="model">Model:</label>
    <input type="text" id="model" name="model">
    <label for="brand">Brand:</label>
    <input type="text" id="brand" name="brand">
    <label for="description">Description:</label>
    <input type="text" id="description" name="description">
    <button type="submit">Filter</button>
</form>
<ul>
    <?php foreach ($cars as $car) { ?>
        <li><?php echo htmlspecialchars($car->model); ?> - <?php echo htmlspecialchars($car->brand); ?>: <?php echo htmlspecialchars($car->description); ?></li>
    <?php } ?>
</ul>
<p><a href="/logout">Logout</a></p>
