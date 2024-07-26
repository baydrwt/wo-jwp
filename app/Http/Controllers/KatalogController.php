<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard',[
            'katalogs' => Katalog::all()
        ]);
    }

    public function create()
    {
        return view('dashboard.katalogs.create', [
           'katalogs' => Katalog::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'image' => 'image|required|max:1024',
            'price' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('public/katalog-images');
        }

        $validatedData['description'] = strip_tags($request->description);

        Katalog::create($validatedData);

        return redirect('/dashboard/katalogs')->with('success', 'New product has been added!');
    }

    public function edit(Katalog $katalog, $id)
    {

        $data = $katalog->find($id);

        return view('dashboard.katalogs.edit', [
            'katalog' => $data,
         ]);
    }

    public function update(Request $request, Katalog $katalog, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|min:10',
            'image' => 'image|required|max:1024',
            'price' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('public/katalog-images');
        }

        $validatedData['description'] = strip_tags($request->description);
        Katalog::where('id', $id)
        ->update($validatedData);

        return redirect('/dashboard/katalogs')->with('success', 'Katalog has been updated!');
    }

    public function destroy(Katalog $katalog, Order $order)
    {
        $namePackage = Katalog::find($katalog->id)->name;
        Order::where('name_package', $namePackage)->delete();

        Katalog::destroy($katalog->id);

        return redirect('/dashboard/katalogs')->with('success', 'Katalog has been deleted!');
    }
}
