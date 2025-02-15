<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => []]);
    // }

    public function getMenu()
    {
        $menu = Menu::getTree();

        return response()->json(['success' => true, 'menu' => $menu], 200);
    }
}
