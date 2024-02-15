<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Text; // モデルを使用
use Illuminate\Support\Facades\Storage;
use PDF; // ライブラリをインポート

class TextController extends Controller
{
    public function index()
    {
        $texts = Text::all(); // すべてのテキストを取得
        return view('text.index', compact('texts'));
    }
    
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                // `Storage::putFileAs` を使用してみる
                $path = Storage::putFileAs('public/files', $file, $filename);
    
                // ファイルパスを保存する際のパスを修正
                $text = new Text();
                $text->content = $request->input('content');
                // `asset` ヘルパーを使用せず、直接パスを保存
                $text->file_path = $path; // `asset` ヘルパーは表示時に使用
                $text->save();
    
                return redirect('/text');
            }
        }
    
        return back()->withErrors(['file' => 'ファイルがアップロードされていないか、不正です。']);
    }




    public function destroy($id)
    {
        $text = Text::findOrFail($id);
        $text->delete();
        
        return redirect('/text');
    }

    public function exportPdf()
    {
        $texts = Text::all();
        $pdf = PDF::loadView('text.pdf', compact('texts'));
        return $pdf->download('texts.pdf');
    }

}
