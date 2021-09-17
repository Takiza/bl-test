<?php


namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AutoRiaApiController extends Controller
{
    public function getTypes() // состоянием на 17.09.21 AutoRia имеет проблемы с данным API
    {
        $client = new Client();
        $uri = 'https://developers.ria.com/auto/categories/?api_key=' . config('api.autoria');
        $response = $client->request('GET', $uri);
        return json_decode($response->getBody());
    }

    public function getBrands($type = 'id')
    {
        $client = new Client();
        $uri = 'https://developers.ria.com/auto/new/marks?category_id='. $type .'&api_key=' . config('api.autoria');
        $response = $client->request('GET', $uri);
        return json_decode($response->getBody());
    }

    public function getModels(Request $request, $type = 'id')
    {
        $client = new Client();
        $uri = 'https://developers.ria.com/auto/new/models?marka_id='. $request->brand .'category_id='. $type .'&api_key=' . config('api.autoria');
        $response = $client->request('GET', $uri);
        return json_decode($response->getBody());
    }
}
