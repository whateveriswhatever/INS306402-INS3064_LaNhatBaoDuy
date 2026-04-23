<?php
    require_once "BaseController.php";
    require_once ROOT_DIR . "/models/ProductModel.php";
    class ProductController extends BaseController {
        /*
            Hiển thị danh sách sản phẩm (index) và trang tạo sản phẩm (create)
        */
        protected ProductModel $productModel;
        
        public function __construct() {
            $this->productModel = new ProductModel("products");
        }

        public function index(): void {
            $products = ($this->productModel)->all();
            $this->view("products/all", ["products" => $products]);
        }

        public function create(): void {
            $this->view("products/create");
        }

        public function store(): void {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = [
                    "name" => $_POST["productName"] ?? "",
                    "category" => $_POST["productCategory"] ?? "",
                    "price" => $_POST["productPrice"] ?? 1,
                    "quantity" => $_POST["productQuantity"] ?? 0,
                    "origin" => $_POST["productOrigin"] ?? "",
                    "distributor" => $_POST["productDistributor"] ?? "",
                    "from_company" => $_POST["productCompany"] ?? "",
                    "manufactured_date" => $_POST["productManufacturedDate"] ?? null,
                    "expired_date" => $_POST["productExpiredDate"] ?? null
                ];

                // $errors = ($this->productModel)->validate($data);
                // if (!empty($errors)) {
                //     $this->view("products/create", [
                //         "errors" => $errors,
                //         "old" => $data
                //     ]);
                // }

                // Save data to the DB
                $isSuccess = ($this->productModel)->add($data);
                if ($isSuccess) {
                    echo "<div>Added successfully!</div>";
                    $this->index();
                } else {
                    echo "<div>Failed to add</div>";
                    $this->view("products/create", [
                        "old_data" => $data
                    ]);
                    
                }
            } else {
                // GET: show blank form
                $this->create();
            }
        }

        public function edit(): void {
            /* opening the editor to input new information on the current
            selected product via its ID */
            if (!isset($_GET["id"])) {
                die("Product ID is required");
            }
            echo "<div>Found product ID {$_GET['id']} via URL</div>";
            $id = (int)$_GET["id"];
            $condition = ["id" => $id];
            $product = ($this->productModel)->find($condition);
            if (!empty($product)) {
                $product = $product[0];
            } else {
                $product = null;
            }
            if (!$product) {
                die("Product not found!");
            }
            $product["id"] = (int)$_GET["id"];
            $product["origin"] = ($this->productModel)->searchCountryViaISOCode($product["origin"]);
            $this->view("products/edit", ["product" => $product]);
        }

       public function update(): bool {
        /* sending a post request to the server to update data on the current
            product  */
            $new_data = [
                "id" => $_POST["ID"],
                "name" => $_POST["productName"] ?? "",
                "category" => $_POST["productCategory"] ?? "",
                "price" => $_POST["productPrice"] ?? 1,
                "quantity" => $_POST["productQuantity"] ?? 0,
                "origin" => $_POST["productOrigin"] ?? "",
                "distributor" => $_POST["productDistributor"] ?? "",
                "from_company" => $_POST["productCompany"] ?? "",
                "manufactured_date" => $_POST["productManufacturedDate"] ?? null,
                "expired_date" => $_POST["productExpiredDate"] ?? null
            ];

            $isSuccess = ($this->productModel)->update($new_data);
            if (!$isSuccess) {
                echo "<div>Failed to update product!</div>";
                $this->edit();
                return false;
            }
            
            echo "<div>Updated product!</div>";
            $this->index();
            return true;
       }
    }
?>