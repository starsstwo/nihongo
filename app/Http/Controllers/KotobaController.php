<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\KotobaModel;
use App\ImiModel;

class KotobaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kotobas = KotobaModel::lists(1)->get();
        return view('kotobas/index')
                ->with('kotobas', $kotobas);
    }

    public function create()
    {
        return view('kotobas/create');
    }

    public function store(Request $request)
    {
        //save kotoba
        $kotobas = new KotobaModel;
        $kotobas->name = $request->input('kotoba');
        $kotobas->phonetic = $request->input('phonetic');
        $kotobas->user_id = 1;
        $save_kotobas = $kotobas->save();

        if (!$save_kotobas) {
            \Session::flash('flash_message', 'Error!!!');
            \Session::flash('alert-class', 'alert-warning');
            return Redirect::back()->withInput();
        }

        //save imi
        $means = $request->input('mean_kotoba');
        foreach($means as $mean) {
            $imi = new ImiModel;
            $imi->kotoba_id = $kotobas->id;
            $imi->mean = $mean;
            $imi->save();
        }

        return redirect()->route('kotobas.index');
    }

    public function edit($id)
    {
        $kotoba = KotobaModel::findOrFail($id);
        $kotoba_imis = ImiModel::where('kotoba_id', $id)->get();
        return view('kotobas.edit')
                ->with('kotoba', $kotoba)
                ->with('kotoba_imis', $kotoba_imis);
    }

    public function update(Request $request, $id)
    {
        $kotoba = KotobaModel::findOrFail($id);
        $means = ImiModel::where('kotoba_id', $id)->get();

        // update kotoba
        if ($request->input('kotoba') != $kotoba->name) {
          $kotoba->name = $request->input('kotoba');
          $kotoba->phonetic = $request->input('phonetic');
          $kotoba->save();
        }

        // delete record
        ImiModel::where('kotoba_id', $id)->delete();
        //save imi
        $means = $request->input('mean_kotoba');
        foreach($means as $mean) {
            $imi = new ImiModel;
            $imi->kotoba_id = $id;
            $imi->mean = $mean;
            $imi->save();
        }

        return redirect()->route('kotobas.index');
    }

    public function destroy($id)
    {
        $kotoba = KotobaModel::findOrFail($id);
        $kotoba->delete();
        $kotoba_imis = ImiModel::where('kotoba_id', $id)->get();
        foreach ($kotoba_imis as $imi)
        {
            $imi->delete();
        }

        return redirect()->route('kotobas.index');

    }
}
