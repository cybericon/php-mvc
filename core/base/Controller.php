<?php

namespace Core\Base;

class Controller
{
    public function view($name, $data = [])
    {
        extract($data);
        require APP_DIR . "/views/{$name}.view.php";
        return $this;
    }

    public function redirect($link)
    {
        return header("Location: $link");
    }

    public function escape_html(&$values)
    {
        array_walk($values, ["self", "escape"]);
    }
    public static function escape(&$val, $key)
    {
        $val = htmlspecialchars($val);
        return $val;
    }
}
