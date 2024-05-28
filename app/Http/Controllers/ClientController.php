<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Address;

class ClientController extends Controller
{
    public function create()
    {
        return view('clients.create');
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_first_name' => 'required|string|max:255',
            'contact_last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'contact_number' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
        ]);

        // Create a new client record
        $client = new Client();
        $client->company_name = $request->company_name;
        $client->contact_first_name = $request->contact_first_name;
        $client->contact_last_name = $request->contact_last_name;
        $client->email = $request->email;
        $client->contact_number = $request->contact_number;
        $client->save();

        // Create a new address record
        $address = new Address();
        $address->city = $request->city;
        $address->country = $request->country;
        $address->district = $request->district;
        $address->postal_code = $request->postal_code;

        // Associate the address with the client
        $client->address()->save($address);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Client created successfully.');
    }


    public function index(Request $request)
    {
       

        $clients = Client::all();

        return view('clients.index', compact('clients'));
    }



    public function showDetails($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.details', compact('client'));
    }
}
