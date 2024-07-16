<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $apiKey = 'AIzaSyAlk3dw_iP1XElNhhOPVXAzD1Mw3N1kCWs';
        $query = $request->input('query', 'Bang sue');
        $client = new Client();
        $response = $client->get("https://maps.googleapis.com/maps/api/place/textsearch/json", [
            'query' => [
                'query' => $query . ' restaurants',
               'key' => $apiKey,
            ]
        ]);
        
        $data = json_decode($response->getBody()->getContents(), true);

        // ตรวจสอบสถานะการเรียก API
        if (isset($data['status']) && $data['status'] === 'OK') {
            // ตรวจสอบว่ามีผลลัพธ์ในส่วน results หรือไม่
            if (isset($data['results']) && !empty($data['results'])) {
                return response()->json($data['results']);
            } else {
                return response()->json(['error' => 'No results found'], 404);
            }
        } else {
            return response()->json(['error' => 'API request failed'], 500);
        }
    }
}
