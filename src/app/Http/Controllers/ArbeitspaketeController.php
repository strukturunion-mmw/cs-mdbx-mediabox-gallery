<?php

namespace App\Http\Controllers;

use App\Models\Arbeitspaket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Redirect;


class ArbeitspaketeController extends Controller
{
    /**
     * Zeigt die Karten aller gespeicherten Arbeitspakete an
     * Paginierung auf 9 Elemente
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        if(!isset($request->groupfilter)) $groupfilter="all";
        else $groupfilter=$request->groupfilter;

        $pakete=Arbeitspaket::where("id", ">", 0);

        // Filtering by groupfilter
        if($groupfilter=="ds") $pakete->where("ds_aufwand", "<>", 0)->orWhere("ds_aufwand_min", ">", 0)->orWhere("ds_aufwand_max", ">", 0);
        if($groupfilter=="bi") $pakete->where("bi_aufwand", "<>", 0)->orWhere("ri_aufwand_min", ">", 0)->orWhere("bi_aufwand_max", ">", 0);
        if($groupfilter=="ri") $pakete->where("ri_aufwand", "<>", 0)->orWhere("bi_aufwand_min", ">", 0)->orWhere("ri_aufwand_max", ">", 0);
        if($groupfilter=="ripa") $pakete->where("ripa_aufwand", "<>", 0)->orWhere("ripa_aufwand_min", ">", 0)->orWhere("ripa_aufwand_max", ">", 0);

        $pakete = $pakete->paginate(200);

        return Inertia::render('Arbeitspakete', [
            'pakete' => $pakete,
            'groupfilter' => $groupfilter,
        ]);
    }

    /**
     * Ajax Verarbeitung von Befehlen zur Erstellung und Löschung
     * von Arbeitspaketen
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function handlePaket(Request $request)
    {
        if($request->action=="new") {
            $paket=new Arbeitspaket;
            $paket->initialize();
        }
        if($request->action=="copy") Arbeitspaket::find($request->id)->duplicate();
        if($request->action=="delete") Arbeitspaket::find($request->id)->delete();

        return $this->index($request);
        //return redirect()->route('arbeitspakete.index');
    }

    /**
     * Ajax Verarbeitung von Befehlen zur Erstellung und Löschung
     * von Arbeitspaketen
     *
     * @return Illuminate\Http\RedirectResponse
     */

    public function handleField(Request $request)
    {
        $paket=Arbeitspaket::find($request->id);

        if($request->field == "import_id") $paket->edit_import_id($request->value);
        if($request->field == "name") $paket->edit_name($request->value);
        if($request->field == "termin") $paket->edit_termin($request->value);
        if($request->field == "kategorie") $paket->edit_kategorie($request->value);
        if($request->field == "budget") $paket->edit_budget($request->value, "pt");
        if($request->field == "budget_teur") $paket->edit_budget($request->value, "teur");
        if($request->field == "beschreibung") $paket->edit_beschreibung($request->value);
        if($request->field == "kommentar") $paket->edit_kommentar($request->value);
        if($request->field == "ds_aufwand_min") $paket->edit_aufwand($request->value, "ds", "min");
        if($request->field == "ds_aufwand_max") $paket->edit_aufwand($request->value, "ds", "max");
        if($request->field == "ds_aufwand") $paket->edit_aufwand($request->value, "ds", "absolute");
        if($request->field == "bi_aufwand_min") $paket->edit_aufwand($request->value, "bi", "min");
        if($request->field == "bi_aufwand_max") $paket->edit_aufwand($request->value, "bi", "max");
        if($request->field == "bi_aufwand") $paket->edit_aufwand($request->value, "bi", "absolute");
        if($request->field == "ri_aufwand_min") $paket->edit_aufwand($request->value, "ri", "min");
        if($request->field == "ri_aufwand_max") $paket->edit_aufwand($request->value, "ri", "max");
        if($request->field == "ri_aufwand") $paket->edit_aufwand($request->value, "ri", "absolute");
        if($request->field == "ripa_aufwand_min") $paket->edit_aufwand($request->value, "ripa", "min");
        if($request->field == "ripa_aufwand_max") $paket->edit_aufwand($request->value, "ripa", "max");
        if($request->field == "ripa_aufwand") $paket->edit_aufwand($request->value, "ripa", "absolute");

        return $this->index($request);
        // return redirect()->route('arbeitspakete.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arbeitspaket  $arbeitspaket
     * @return \Illuminate\Http\Response
     */
    public function show(Arbeitspaket $arbeitspaket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Arbeitspaket  $arbeitspaket
     * @return \Illuminate\Http\Response
     */
    public function edit(Arbeitspaket $arbeitspaket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arbeitspaket  $arbeitspaket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arbeitspaket $arbeitspaket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arbeitspaket  $arbeitspaket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arbeitspaket $arbeitspaket)
    {
        //
    }
}
