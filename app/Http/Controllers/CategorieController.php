<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Categorie;

class CategorieController extends Controller
{


    public function index()
    {
        return view('categorie');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdata()
    {
        $categorie = DB::table('categories')
            ->orderBy('id', 'desc')->get();
        return response()->json($categorie);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorie = Categorie::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);
        $categorie->save();
        return response()->json(['message' => 'Categoria creada'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json(["message" => "Categoria no encontrada"], 404);
        }
        $categorie->fill([
            'name' => request('name'),
            'description' => request('description'),
        ])->save();
        return response()->json(compact('categorie'), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json(["message" => "Categoria no encontrada"], 404);
        }
        $categorie->delete();
        return response()->json(["message" => "Ha sido eliminada"]);
    }
    public function available($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->status = '1';
        $categorie->save();
        return response()->json(["message" => "La Categoria ha sido activada"]);
    }
    public function locked($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->status = '0';
        $categorie->save();
        return response()->json(["message" => "La Categoria ha sido Bloqueada"]);
    }
}