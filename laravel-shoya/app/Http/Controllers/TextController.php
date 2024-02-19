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
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // ファイルを保存し、ストレージ内の相対パスを取得
            $path = Storage::putFileAs('public/files', $file, $filename);
            
            $text = new Text();
            $text->content = $request->input('content');
            // データベースにはストレージ内の相対パスを保存
            $text->file_path = $path; // 例: 'public/files/filename.jpg'
            $text->save();
    
            return redirect('/text')->with('success', 'ファイルが正常にアップロードされました。');
        }
    
        return back()->withErrors(['file' => 'ファイルがアップロードされていないか、不正です。']);
    }


    public function postRandomText(Request $request)
    {
        $randomWords = ['エモい', '了解', 'ASMRやん', '何してる？', '好きや', 'まてと！', '🐈', '☻', 'どういう計算方法でそうなんねん！', 'もうね・・・もうたまらんねん！'];
        $randomWord = $randomWords[array_rand($randomWords)];
    
        $text = new Text();
        $text->content = $randomWord;
        $text->save();
    
        return back()->with('success', 'Random word posted successfully!');
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
