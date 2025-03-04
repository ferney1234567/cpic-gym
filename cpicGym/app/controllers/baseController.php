<?php

namespace App\Controller;

class BaseController
{
    protected string $layout = "main_layout";
    public function render($view, $data = null)
    {

        if ($data != null && is_array($data)) {
            foreach ($data as $key => $value) {
                $$key = $value;
            }
        }
        $content = MAIN_APP_ROUTE . "../views/".$view;
        $layout = MAIN_APP_ROUTE . "../views/layouts/{$this->layout}.php";

        include_once $layout;
        //require_once MAIN_APP_ROUTE."../views/".$view;
    }
    public function formatCurrency($amount)
    {
        return '$' . number_format($amount, 2);
    }
    public function redirectTo($url)
    {
        header('Location:' . $url);
        exit;
    }
}
