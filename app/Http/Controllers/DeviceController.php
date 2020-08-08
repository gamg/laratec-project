<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\Device\CreateRequest;
use App\Http\Requests\Device\UpdateRequest;

class DeviceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $devices = Device::devicesFilter($request->status, $request->entry_date_from, $request->entry_date_to);
        return view('devices.index')->with('devices', $devices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create_or_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = [
            'customer_id' => $request->customer_id,
            'user_id' =>  (auth()->user()->isAdmin()) ? $request->user_id : auth()->user()->id,
            'description' => $request->description,
            'status' => 'Recibido',
            'entry_date' => Carbon::now(),
        ];

        $device = Device::create($data);

        $device->maintenances()->attach($request->maintenances);

        $request->session()->flash('message', 'Dispositivo almacenado correctamente.');

        return redirect()->route('dispositivos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $device = Device::find($id);

            if (is_null($device)) {
                return redirect()->route('dispositivos.index');
            }
        } catch (Exception $exception) {
            report($exception);
        }

        return view('devices.info')->with('device', $device);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::find($id);

        if (is_null($device)) {
            return redirect()->route('dispositivos.index');
        }

        $this->authorize('update', $device);

        return view('devices.create_or_edit')->with('device', $device);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $device = Device::find($id);

        if (is_null($device)) {
            return redirect()->route('dispositivos.index');
        }

        $this->authorize('update', $device);

        $device->fill($request->all());

        if ($request->status == 'Entregado') {
            $device->departure_date = Carbon::now();
        }

        $device->save();

        $device->maintenances()->sync($request->maintenances);

        $request->session()->flash('message', 'Dispositivo actualizado correctamente.');

        return redirect()->route('dispositivos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $device = Device::find($id);

            if (is_null($device)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Ha ocurrido un error, intente de nuevo mas tarde.'
                ]);
            }

            $device->delete();
            return response()->json([
                'error' => false,
                'message' => 'Dispositivo eliminado correctamente.'
            ], 200);
        }
    }
}
