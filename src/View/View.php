<?php

namespace ProjectInitiator\View;

class View
{
    public static function make($view, $params = [])
    {
        $baseContent = self::getBaseContent();
        $viewContent = self::getviewContent($view, params: $params);

        echo str_replace("{{content}}", $viewContent, $baseContent);
    }

    public static function getBaseContent()
    {
        ob_start();

        include base_path() . '/views/layouts/main.php';

        return ob_get_clean();
    }

    public static function getviewContent($view, $isError = false, $params = [])
    {
        $path = $isError ? view_path("errors") : view_path();

        if (str_contains($view, ".")) {
            $pathes = explode(".", $view);
            foreach ($pathes as $view_path) {
                if (is_dir($path . $view_path)) {
                    $path .= $view_path;
                }else{
                    self::getviewContent('404', true);
                }
            }

            $view = $path . end($pathes) . ".php";
        } else {
            $view = $path . $view . ".php";
        }

        foreach ($params as $param => $value) {
            $$param = $value;
        }

        if ($isError) {
            include $view;
        } else {
            ob_start();
            include $view;
            return ob_get_clean();
        }
    }

    public static function makeError($error)
    {
        self::getviewContent($error, true);
    }
}
