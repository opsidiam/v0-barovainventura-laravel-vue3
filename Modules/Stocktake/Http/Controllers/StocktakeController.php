<?php

namespace Modules\Stocktake\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Stocktake\Services\StocktakeService;
use function GuzzleHttp\json_encode;

class StocktakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->index();
        return view('stocktake::index', $data);
    }

    public function getCloseStocktakes(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->getCloseStocktakes();
        return response()->json([
            'html' => view('stocktake::partials.closed_stocktakes', $data)->render(),
            'reload' => $data['reload'],
        ]);
    }

    public function usersSearch(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->usersSearch();
        return json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->getOpenpenStocktake();
        return view('stocktake::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StocktakeService $stocktakeService) {
        $data = $stocktakeService->store();
        if($data){
            return redirect()->route('stocktake.process', $data)->with('message','Inventúra bol vytvorená.');
        }else{
            return back()->with('warning','Inventúra nebol vytvorená.');
        }
    }

    public function process(StocktakeService $stocktakeService, $id)
    {
        $data = $stocktakeService->getProcess($id);
        $data['blockPreloader'] = true;
        return view('stocktake::process', $data);
    }

    public function getLiveData(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->getLiveData();
        return response()->json($data);
    }

    public function getLiveDataCheck(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->getLiveDataCheck();
        return response()->json($data);
    }

    public function getLiveDataCheckState(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->getLiveDataCheckState();
        return response()->json($data);
    }

    public function updateFullPack(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->updateFullPack();
        return response()->json($data);
    }

    public function updateWeight(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->updateWeight();
        return response()->json($data);
    }

    public function deleteScan(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->deleteScan();
        return response()->json($data);
    }

    public function destroy(StocktakeService $stocktakeService, $id) {
        $data = $stocktakeService->destroy($id);
        if($data){
            return redirect(route('stocktake.create'))->with('message','Inventúra bola vymazaná.');
        }
        return redirect(route('stocktake.create'))->with('warning','Inventúra nebola vymazaná.');
    }

    public function closeStocktake(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->closeStocktake();
        if($data){
            return redirect(route('stocktake.index'))->with('message','Inventúra bola uzavretá.');
        }
        return back()->with('warning','Inventúra nebol uzavretá.');
    }

    public function deleteUser(StocktakeService $stocktakeService)
    {
        $data = $stocktakeService->deleteUser();
        if($data = 1){
            return back()->with('warning','Zamestnanca sa nepodarilo vymazať, pravdepodobne ostal ako posledný.');
        }
        if($data = 0){
            return back()->with('message','Zamestnanec bol vymazaný z tejto inventúry.');
        }
        return back()->with('warning','Zamestnanca sa nepodarilo vymazať, pravdepodobne ostal ako posledný.');
    }
}
