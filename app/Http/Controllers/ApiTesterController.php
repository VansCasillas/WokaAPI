<?php

namespace App\Http\Controllers;

use App\Models\ApiHistory;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiTesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = ApiHistory::latest()->take(20)->get();
        return view('wokaapi', compact('histories'));
    }

    public function send(Request $request)
    {
        $client = new Client();

        $method  = strtoupper($request->input('method'));
        $url     = $request->input('url');
        $headers = $request->input('headers_data', []);
        $body    = $request->input('body');

        try {
            $options = [];

            /* ================= HEADERS ================= */
            if (!empty($headers) && is_array($headers)) {
                $options['headers'] = $headers;
            }

            /* ================= BODY HANDLING ================= */
            if (!empty($body)) {

                $contentType = $headers['Content-Type'] ?? '';

                // JSON
                if (str_contains($contentType, 'application/json')) {
                    $options['json'] = json_decode($body, true);

                    // Form URL Encoded
                } elseif (str_contains($contentType, 'application/x-www-form-urlencoded')) {
                    parse_str($body, $form);
                    $options['form_params'] = $form;

                    // Multipart
                } elseif (str_contains($contentType, 'multipart/form-data')) {
                    $multipart = [];
                    parse_str($body, $form);
                    foreach ($form as $key => $value) {
                        $multipart[] = [
                            'name' => $key,
                            'contents' => $value
                        ];
                    }
                    $options['multipart'] = $multipart;

                    // Raw
                } else {
                    $options['body'] = $body;
                }
            }

            $response = $client->request($method, $url, $options);

            $status = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            ApiHistory::create([
                'method' => $method,
                'url' => $url,
                'headers' => $headers,
                'body' => $body,
                'response_status' => $status,
                'response_body' => $responseBody,
            ]);

            return response()->json([
                'status' => $status,
                'body' => $responseBody,
            ]);
        } catch (\Throwable $e) {

            ApiHistory::create([
                'method' => $method,
                'url' => $url,
                'headers' => $headers,
                'body' => $body,
                'response_status' => 0,
                'response_body' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 0,
                'body' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
