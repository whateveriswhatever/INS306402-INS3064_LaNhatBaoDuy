    <?php
        class BaseController {
            protected function view(string $view, array $data = []): void {
                extract($data);
                $content = ROOT_DIR . "/app/views/{$view}.php";
                require ROOT_DIR . "/app/views/layouts/main.php";
            }

            protected function redirect(string $url): void {
                header("Location: {$url}");
                exit;
            }
        }
    ?>