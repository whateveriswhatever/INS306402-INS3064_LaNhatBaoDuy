<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="container">
    <h1>Create Product</h1>

    <form method="POST" action="<?= BASE_PATH ?>/products/create" id="productForm">
        
        <label>Name</label>
        <input type="text" name="productName" 
            value="<?= $old_data['name'] ?? '' ?>">

        <label>Category</label>
        <input type="text" name="productCategory"
            value="<?= $old_data['category'] ?? '' ?>">

        <label>Quantity</label>
        <input type="number" name="productQuantity"
            value="<?= $old_data['quantity'] ?? '' ?>">

        <label>Origin</label>
        <input type="text" name="productOrigin"
            value="<?= $old_data['origin'] ?? '' ?>">
        
        <label>Distributor</label>
        <input type="text" name="productDistributor"
            value="<?= $old_data["distributor"] ?? "" ?>" />

        <label>Company</label>
        <input type="text" name="productCompany"
            value="<?= $old_data["from_company"] ?? "" ?>" />

        <label>Manufactured date</label>
        <input type="date" name="productManufacturedDate"
            value="<?= $old_data["manufactured_date"] ?>" />

        <label>Expired date</label>
        <input type="date" name="productExpiredDate"
            value="<?= $old_data["expired_date"] ?>" />

        <button type="submit">Save Product</button>
    </form>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <a href="<?= BASE_PATH ?>/">Back to list</a>
</div>

<script src="/assets/js/app.js"></script>
</body>
</html>