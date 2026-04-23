<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
    <div id="header">
        <div id="id">
            <h1>Product ID: <?= $product["id"] ?></h1>
        </div>
    </div>

    <div id="body">
        <form id="editor" method="POST" action="<?= BASE_PATH ?>/products/update">
            <div>
                <input type="number" value="<?= $product['id'] ?>" name="ID" style="display: none;"/>
            </div>
            <div>
                <p>Name: </p>
                <div>
                    <input type="text" name="productName" placeholder="Enter new product name"
                    value="<?= $product['name'] ?>" />
                </div>
            </div>

            <div>
                <p>Origin: </p>
                <div>
                    <input type="text" name="productOrigin" placeholder="Enter new product origin"
                    value="<?= $product['origin'] ?>" />
                </div>
            </div>

            <div>
                <p>Distributor: </p>
                <div>
                    <input type="text" name="productDistributor" placeholder="Enter new product distributor"
                    value="<?= $product["distributor"] ?>" />
                </div>
            </div>

            <div>
                <p>Company: </p>
                <div>
                    <input type="text" name="productCompany" placeholder="Enter new product company"
                    value="<?= $product['from_company'] ?>" />
                </div>
            </div>

            <div>
                <p>Quantity: </p>
                <div>
                    <input type="number" name="productQuantity" placeholder="Enter new product amount"
                    value="<?= $product['quantity'] ?>" />
                </div>
            </div>

            <div>
                <p>Manufactured date: </p>
                <div>
                    <input type="date" name="productManufacturedDate" value="<?= $product['manufactured_date'] ?>" />
                </div>
            </div>

            <div>
                <p>Expired date: </p>
                <div>
                    <input type="date" name="productExpiredDate" value="<?= $product['expired_date'] ?>" />
                </div>
            </div>

            <div>
                <button type="submit">Update</button>
            </div>
        </form>
    </div>
</body>
</html>