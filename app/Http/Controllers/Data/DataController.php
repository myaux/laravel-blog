<?php
/**
 * Created by PhpStorm.
 * User: XY
 * Date: 2017/9/13
 * Time: 21:44
 */

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public function data()
    {
        return 'this is data';
    }

    public function show()
    {
        return 'show data';
    }
}