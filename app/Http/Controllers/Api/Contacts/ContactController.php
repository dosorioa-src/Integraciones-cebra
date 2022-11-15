<?php

namespace App\Http\Controllers\Api\Contacts;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
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
        $Token = 'pat-na1-6def417c-2dbc-476b-bde6-82be18e0a04f';

        $entityEndpoint = \App\Models\Endpoint::firstWhere('url', 'http://integraciones-cebra.test/api/contact/store');

        $array = $request->all();
        $properties = $array;
       
        $arrayHS = ['properties' => $properties];
 
        $response = Http::withToken($Token)->post('https://api.hubapi.com/crm/v3/objects/contacts', $arrayHS);
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
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
