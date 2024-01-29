<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text; // モデルを使用

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::all(); // すべてのテキストを取得
        return view('text.index', compact('texts'));
    }

    public function store(Request $request)
    {
        $text = new Text();
        $text->content = $request->input('content');
        $text->save();

        return redirect('/text');
    }

    public function destroy($id)
    {
        $text = Text::findOrFail($id);
        $text->delete();
        
        return redirect('/text');
    }

}
