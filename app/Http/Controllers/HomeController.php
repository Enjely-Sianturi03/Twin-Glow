<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeautyArticle;

class HomeController extends Controller
{
    public function index()
    {
        $beautyArticles = BeautyArticle::all();
        return view('index', compact('beautyArticles'));
    }
} 