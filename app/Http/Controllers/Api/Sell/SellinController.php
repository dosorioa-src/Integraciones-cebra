<?php

namespace App\Http\Controllers\Api\Sell;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class SellinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $hapiKey = 'pat-na1-6def417c-2dbc-476b-bde6-82be18e0a04f';

        $entityEndpoint = \App\Models\Endpoint::firstWhere('url', 'http://integraciones-cebra.test/api/sellin/store');

        $array = $request->all();
        $properties = [];

        array_push(
            $properties,
            [
                'name' => 'dealstage',
                'value' => '28218151'
            ]
        );

        foreach ($array as $name => $value) {
            if ($name != 'dealstage') {
                array_push(
                    $properties,
                    [
                        'name' => $name,
                        'value' => $value
                    ]
                );
            }
        }

        $arrayHS = ['properties' => $properties];
        #FALTA CAMBIAR LOS ENDPOINTS, SALE 404 CON LOS QUE ENCONTRE EN LA DOCUMENTACIÓN
        $response = Http::post('https://api.hubapi.com/deals/v1/deal?hapikey=' . $hapiKey, $arrayHS);
        #Guarda log si la peticion falla
        if ($response->status() !== 200) {
            $entityLog = new \App\Models\Log;
            $entityLog->request_body = json_encode($request->all());
            $entityLog->endpoint_id = $entityEndpoint["id"];
            $entityLog->request_result = $response;
            $entityLog->result_code = $response->status();
            $entityLog->save();
        }
        #Se registra una fila por cada petición
        $entityRequest = new \App\Models\Request;
        $entityRequest->result = $response->status();
        $entityRequest->endpoint_id = $entityEndpoint["id"];
        $entityRequest->save();
        #fin

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
