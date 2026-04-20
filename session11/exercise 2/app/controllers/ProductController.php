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
            if ($_SERVER["REQUEST_METHOD"] === "GET") {
                $this->view("products/create");
            }
        }

        public function store(): void {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $data = [
                    "name" => $_POST["productName"] ?? "",
                    "category" => $_POST["productCategory"] ?? "",
                    "quantity" => $_POST["productQuantity"] ?? 0,
                    "origin" => $_POST["productOrigin"] ?? ""
                ];

                $errors = ($this->productModel)->validate($data);
                if (!empty($errors)) {
                    $this->view("products/create", [
                        "errors" => $errors,
                        "old" => $data
                    ]);
                }

                // Save data to the DB
                ($this->productModel)->add($data);
            } else {
                // GET: show blank form
                $this->view("products/create");
            }
        }

        

       
    }
?>