<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Requests\Maintenance\EditRequest;
use App\Http\Requests\Maintenance\CreateRequest;

class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('getIndex');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(Request $request)
    {
        $maintenances = Maintenance::maintenancesFilter($request->maintenance_name);
        return view('maintenances.index')->with('maintenances', $maintenances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('maintenances.create_or_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(CreateRequest $request)
    {
        Maintenance::create($request->all());

        $request->session()->flash('message', 'Tipo de Mantenimiento ha sido creado correctamente.');

        return redirect()->route('mantenimientos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $maintenance = Maintenance::find($id);

        if (is_null($maintenance)) {
            return redirect()->route('mantenimientos.index');
        }

        return view('maintenances.create_or_edit')->with('maintenance', $maintenance);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putUpdate(EditRequest $request, $id)
    {
        $maintenance = Maintenance::find($id);

        if (is_null($maintenance)) {
            return redirect()->route('mantenimientos.index');
        }

        $maintenance->update($request->all());

        $request->session()->flash('message', 'Tipo de mantenimiento actualizado correctamente.');

        return redirect()->route('mantenimientos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDestroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $maintenance = Maintenance::find($id);

            if (is_null($maintenance)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Ha ocurrido un error, intente de nuevo mas tarde.'
                ]);
            }

            $maintenance->delete();

            return response()->json([
                'error' => false,
                'message' => 'Tipo de mantenimiento eliminado correctamente.'
            ], 200);
        }
    }
}
