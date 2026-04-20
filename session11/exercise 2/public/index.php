<?php
  /*
    Defines routes -> hand over control -> router takes over
    The index.php should only boostrap app, defining routes, starting routes. Nothing else (no HTML, no echo, no logic)
    Views should be rendered inside controllers, not here
  */
  define("ROOT_DIR", dirname(__DIR__));
  echo ROOT_DIR;
  require_once ROOT_DIR . "/core/router.php";

  $router = new Router();

  $request_uri = urldecode($_SERVER["REQUEST_URI"]);
  $base_path = "/INS306402-INS3064_LaNhatBaoDuy/session11/exercise 2/public";
  $url = str_replace($base_path, "", $request_uri);
  $url = str_replace("/index.php", "", $url);
  $url = rtrim($url, '/');

  if ($url === "") {
    $url = "/";
  }

  // echo "<div style='background: #f4f4f4; padding: 20px; border: 1px solid #ccc;'>";
  // echo "<h3>Bảng Chẩn Đoán Router:</h3>";
  
  // echo "<b>1. REQUEST URI (Server nhận được):</b><br>";
  // var_dump($request_uri);
  // echo "<br><br>";

  // echo "<b>2. BASE PATH (Cấu hình của bạn):</b><br>";
  // var_dump($base_path);
  // echo "<br><br>";

  // echo "<b>3. Kết quả \$url (Chuỗi sẽ đưa vào Router):</b><br>";
  // var_dump($url);
  // echo "</div>";

  // // Dừng chương trình tại đây, không cho chạy tiếp xuống Controller
  // die();

  // Assign routes
  $router->get("/", "ProductController@index");
  $router->get("/products", "ProductController@index");
  $router->get("/products/create", "ProductController@create");
  $router->post("/products/create", "ProductController@store");

  // Start processing
  $router->dispatch(
    $url,
    $_SERVER["REQUEST_METHOD"]
  );
?>

