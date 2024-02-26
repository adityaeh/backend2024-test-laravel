<?php

namespace App\Http\Controllers;

use App\Models\MyClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MyClientController extends Controller
{
    public function store(Request $request)
    {

        $new_clients = new MyClient();
        $new_clients->name = $request->name;
        $new_clients->slug = $request->slug;
        $new_clients->is_project = $request->is_project;
        $new_clients->self_capture = $request->self_capture;
        $new_clients->client_prefix = $request->client_prefix;
        $new_clients->client_logo = $request->client_logo;
        $new_clients->address = $request->address;
        $new_clients->phone_number = $request->phone_number;
        $new_clients->city = $request->city;

        $new_clients->save();

        if (isset($request->client_logo)) {
            $file = $request->client_logo;
            $name = time() . $request->name;
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }

        return back()->with('message', 'Data is saved!');
    }

    public function update($id, Request $request)
    {
        $clients = MyClient::find($id);
        $clients->name = $request->name;
        $clients->slug = $request->slug;
        $clients->is_project = $request->is_project;
        $clients->self_capture = $request->self_capture;
        $clients->client_prefix = $request->client_prefix;
        $clients->client_logo = $request->client_logo;
        $clients->address = $request->address;
        $clients->phone_number = $request->phone_number;
        $clients->city = $request->city;

        $clients->save();

        if (isset($request->client_logo)) {
            $file = $request->client_logo;
            $name = time() . $request->name;
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }

        return back()->with('message', 'Data is saved!');
    }

    public function show($id)
    {
        $clients = MyClient::find($id);
        if ($clients) {
            return response()->json($clients);
        } else {
            return response()->json([
                'message' => 'Clients not found'
            ], 404);
        }
    }

    public function delete($id)
    {
        $clients = MyClient::find($id);
        $clients->delete();
        return back()->with('message', 'Data is saved!');
    }
}
