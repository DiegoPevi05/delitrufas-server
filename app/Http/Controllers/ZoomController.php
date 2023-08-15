<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Models\TokenZoom;
use Illuminate\Support\Facades\Log;

class ZoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function callBackZoomUri(){
        try {
            $client = new GuzzleHttpClient(['base_uri' => 'https://zoom.us']);
          
            $response = $client->request('POST', '/oauth/token', [
                "headers" => [
                    "Authorization" => "Basic ". base64_encode(env('CLIENT_ID_ZOOM').':'.env('CLIENT_SECRET_ZOOM'))
                ],
                'form_params' => [
                    "grant_type" => "authorization_code",
                    "code" => $_GET['code'],
                    "redirect_uri" => env('REDIRECT_URI_ZOOM')
                ],
            ]);
          
            $token = json_decode($response->getBody()->getContents(), true);
            $tokenZoom = TokenZoom::create([
                'access_token' => json_encode($token),
            ]);

            return redirect()->route('zooms.index')->with('logSuccess', 'Token creado exitosamente.');

        } catch(Exception $e) {

            return redirect()->route('zooms.index')->with('logError', $e->getMessage());
        }
    }

    public function index()
    {
        return view('zooms.index');
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
        $validatedData = $request->validate([
            'CLIENT_ID' => 'required|string',
            'CLIENT_SECRET' => 'required|string',
        ], [
            'CLIENT_ID.required' => 'El CLIENT ID  es obligatorio si quieres actualizarlo.',
            'CLIETN_SECRET.required' => 'El CLIENT SECRET  es obligatorio si quieres actualizarlo.',
            'CLIENT_ID.string' => 'El CLIENT ID debe ser un texto.',
            'CLIENT_SECRET.string' => 'El CLIENT_SECRET debe ser un texto.',
        ]);

        return redirect()->route('zooms.index')->with('logSuccess', 'Claves actualizadas exitosamente.');
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
