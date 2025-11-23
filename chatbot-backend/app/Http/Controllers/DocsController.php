<?php
namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocsController extends Controller
{
    public function store(Request $req)
    {
        Document::updateOrCreate(
            ['id' => $req->chunk_id],
            [
                'text' => $req->text,
                'embedding' => $req->embedding,
                'source_url' => $req->source_url
            ]
        );

        return response()->json(['status' => 'stored']);
    }

    public function index()
    {
        return Document::select('id','text','embedding','source_url')->get();
    }
}
