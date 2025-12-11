<?php

namespace Modules\Bar\Http\Controllers;

use App\Db\Bars;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Bar\Models\Bar;

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->session()->forget('bar');
        $request->session()->forget('bar-name');
        $data['bars'] = Bar::where('user_id',Auth::id())->get();
        $data['bars_count'] = $data['bars']->count();
        $data['license_active'] = !((now() >= Auth::user()->licence_expire));
        $data['license_bar_active'] = !(($data['bars_count'] >= Auth::user()->licence_bar_count));
        $data['license_bar_count'] = Auth::user()->licence_bar_count;
        return view('bar::index', $data);
    }

    public function select(Request $request)
    {
        $bar = Bar::find(request('id'));
        $request->session()->put('bar', $bar->id);
        $request->session()->put('bar-name', $bar->name);
        return redirect()->route('dashboard.index')->with('message','Bar "'.$bar->name.'" bol vybraný.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bar::create');
    }

    public function list()
    {
        return view('bar::list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Bar::insert([
            "name" => $request->input('name'),
            "user_id" => Auth::id(),
            "address" => $request->input('address'),
            "number" => $request->input('number'),
            "city" => $request->input('city'),
            "psc" => $request->input('psc'),
            "country" => $request->input('country'),
            "chef" => $request->input('chef'),
            "phone" => $request->input('phone'),
        ])){
            return back()->with('message','Bar bol vytvorený.');
        }
        return back()->with('warning','Bar sa nepodarilo vytvoriť. ');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('bar::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('bar::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!$id) {
            return back()->with('warning', 'Bar sa nepodarilo aktualizovať.');
        }

        $bar = Bar::findOrFail($id);
        $updates = [];
        $fields = [
            'name', 'address', 'number', 'city',
            'psc', 'country', 'chef', 'phone'
        ];

        foreach ($fields as $field) {
            if ($request->filled($field)) {
                $updates[$field] = $request->input($field);
            }
        }

        if (!empty($updates)) {
            $bar->update($updates);
            return back()->with('message', 'Bar bol aktualizovaný.');
        }

        return back()->with('warning', 'Neboli zadané žiadne údaje na aktualizáciu.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        if(Bar::where('id',$id)->delete()){
            return back()->with('message','Bar bol vymazaný.');
        }else{
            return back()->with('warning','Bar sa nepodarilo vymazať. ');
        }
    }
}
