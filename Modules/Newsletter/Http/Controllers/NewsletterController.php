<?php

namespace Modules\Newsletter\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Newsletter\Services\NewsletterService;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('newsletter::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newsletter::create');
    }

    public function showNewsletter(NewsletterService $newsletterService, $id)
    {
        $data['content'] = $newsletterService->showNewsletter($id);
        $data['data'] = $newsletterService->newsletterUser();
        return view('newsletter::show', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsletterService $newsletterService) {
        $data = $newsletterService->store();
        if ($data) {
            return redirect()->route('newsletter.index')->with('message', 'Newsletter bol úspešne vytvorený.');
        } else {
            return back()->with('warning', 'Nepodarilo sa vytvoriť newsletter.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function allowSendNewsletter(NewsletterService $newsletterService, $id) {
        $data = $newsletterService->allowSendNewsletter($id);
        if ($data) {
            return redirect()->route('newsletter.index')->with('message', 'Newsletter bol úspešne pripravený na odoslanie.');
        } else {
            return back()->with('warning', 'Nepodarilo sa pripraviť newsletter.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(NewsletterService $newsletterService, $id) {
        $data = $newsletterService->destroy($id);
        if($data){
            return redirect(route('newsletter.index'))->with('message','Newsletter bol vymazaný.');
        }else{
            return redirect(route('newsletter.index'))->with('warning','Newsletter nebol vymazaný.');
        }
    }
}
