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
        
        <div>
            <label>Name</label>
            <input type="text" name="productName" 
                value="<?= $old_data['name'] ?? '' ?>">

        </div>
        
        <div>
            <label>Category</label>
            <input type="text" name="productCategory"
                value="<?= $old_data['category'] ?? '' ?>">
        </div>
        
        <div>
            <label>Price</label>
            <input type="number" id="priceInput" name="productPrice"
                value="<?= $old_data['price'] ?? 1 ?>"/>
            <div id="priceTracker" style="color: red;"></div>
        </div>
        
        <div>
            <label>Quantity</label>
            <input type="number" name="productQuantity"
                value="<?= $old_data['quantity'] ?? '' ?>">
        </div>
        
        <div>
            <label>Origin</label>
            <input type="text" name="productOrigin"
                value="<?= $old_data['origin'] ?? '' ?>">
        </div>
        
        <div>
            <label>Distributor</label>
            <input type="text" name="productDistributor"
                value="<?= $old_data["distributor"] ?? "" ?>" />
        </div>
        
        <div>
            <label>Company</label>
            <input type="text" name="productCompany"
                value="<?= $old_data["from_company"] ?? "" ?>" />
        </div>
        
        <div>
            <label>Manufactured date</label>
            <input type="date" name="productManufacturedDate"
                value="<?= $old_data["manufactured_date"] ?>" />
        </div>
        
        <div>
            <label>Expired date</label>
            <input type="date" name="productExpiredDate"
                value="<?= $old_data["expired_date"] ?>" />

        </div>
        
        <div>
            <button type="submit">Save Product</button>
        </div>
        
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


<script>
    const priceInput = document.getElementById("priceInput");
    const tracker = document.getElementById("priceTracker");

    priceInput.addEventListener("input", () => {
    const value = parseFloat(priceInput.value);

    if (value <= 0 || isNaN(value)) {
        tracker.textContent = "Price must be greater than 0";
    } else {
        tracker.textContent = "";
    }
});

</script>
</body>
</html>