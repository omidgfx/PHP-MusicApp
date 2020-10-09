<?php
namespace Controllers;

use Core\Controller;

class router extends Controller
{
    public static function index($par=[])
    {
        echo '<h1 style="color:red">Masih\'s Controller</h1>';
    }
}