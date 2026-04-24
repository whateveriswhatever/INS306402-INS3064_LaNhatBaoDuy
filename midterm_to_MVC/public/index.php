<?php
    define("ROOT_DIR", dirname(__DIR__));
    define("BASE_PATH", "/INS306402-INS3064_LaNhatBaoDuy/midterm_to_MVC/public");
    $x = ROOT_DIR;
    // echo "<div>{$x}</div>";
    require_once ROOT_DIR . "/core/route.php";

    $router = new Router();

    $request_uri = urldecode($_SERVER["REQUEST_URI"]);
    $base_path = "/INS306402-INS3064_LaNhatBaoDuy/midterm_to_MVC/public";
    $url = str_replace($base_path, "", $request_uri);
    $url = str_replace("/index.php", "", $url);
    $url = rtrim($url, '/');



//     echo "<div style='background: #f4f4f4; padding: 20px; border: 1px solid #ccc;'>";
//     echo "<h3>Bảng Chẩn Đoán Router:</h3>";
  
//     echo "<b>1. REQUEST URI (Server nhận được):</b><br>";
//     var_dump($request_uri);
//     echo "<br><br>";

//     echo "<b>2. BASE PATH (Cấu hình của bạn):</b><br>";
//     var_dump($base_path);
//     echo "<br><br>";

//     echo "<b>3. Kết quả \$url (Chuỗi sẽ đưa vào Router):</b><br>";
//     var_dump($url);
//     echo "</div>";

// //   // Dừng chương trình tại đây, không cho chạy tiếp xuống Controller
// //   die();

    if ($url === "") {
        $url = "/";
    }

    $router->get("/", "BookController@index");
    $router->get("/books", "BookController@index");
    $router->get("/book/create", "BookController@create");
    $router->post("/book/create", "BookController@store");
    $router->get("/book/edit", "BookController@edit");
    $router->post("/book/update", "BookController@update");
    $router->get("/book/delete", "BookController@deleteViaID");
    
    
    // Start processing
    $router->dispatch(
        $url,
        $_SERVER["REQUEST_METHOD"]
    );
?>