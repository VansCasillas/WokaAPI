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

        $method = strtoupper($request->input('method'));
        $url    = $request->input('url');
        $headersText = $request->input('headers_data');
        $bodyData    = $request->input('body');

        // Parse headers
        $headers = [];
        if (!empty($headersText)) {
            $lines = preg_split("/\r\n|\n|\r/", $headersText);
            foreach ($lines as $line) {
                if (strpos($line, ':') !== false) {
                    [$key, $value] = explode(':', $line, 2);
                    $headers[trim($key)] = trim($value);
                }
            }
        }

        try {
            $options = [];

            if (!empty($headers)) {
                $options['headers'] = $headers;
            }

            if (!empty($bodyData)) {
                $options['body'] = $bodyData;
            }

            // Send HTTP request
            $response = $client->request($method, $url, $options);

            $status = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // save to database
            ApiHistory::create([
                'method' => $method,
                'url' => $url,
                'headers' => $headers,
                'body' => $bodyData,
                'response_status' => $status,
                'response_body' => $responseBody,
            ]);

            return response()->json([
                'status' => $status,
                'body' => $responseBody,
            ]);
        } catch (\Exception $e) {

            ApiHistory::create([
                'method' => $method,
                'url' => $url,
                'headers' => $headers,
                'body' => $bodyData,
                'response_status' => 0,
                'response_body' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 0,
                'body' => $e->getMessage(),
            ]);
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
