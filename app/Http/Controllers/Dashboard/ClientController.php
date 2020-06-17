<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Client;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {

            return $q->where('name', 'like','%' . $request->search . '%')
            ->orWhere('phone','like' ,'%' . $request->search . '%')
            ->orWhere('address', 'like','%' . $request->search . '%');
        })->latest()->paginate(5);

        return view('dashboard.clients.index', compact('clients'));
    }


    public function create()
    {
        return view('dashboard.clients.create');
    }


    public function store(ClientRequest $request)
    {
        try {
            $request_data = $request->all();
            $request_data['phone']=array_filter($request->phone);
            Client::create($request_data);
            session()->flash('success' , __('site.added_successfully'));
            return redirect()->route('dashboard.clients.index');
        } catch (\Exception $ex){
            session()->flash('success' , __('site.error_in_data'));
            return redirect()->route('dashboard.clients.index');
        }
    }


    public function edit($id)
    {
        $clients = Client::findOrFail($id);
        if (!$clients) {
            session()->flash('success' , __('site.error_in_data'));
            return redirect()->route('dashboard.clients.index');
        }
        return view('dashboard.clients.edit', compact('clients'));
    }



    public function update(ClientRequest $request , Client $client)
    {


        try {
            //dd(Client::all());
            $request_data =$request->all();
            $request_data['phone']=array_filter($request->phone);
            $client->update($request_data);

            session()->flash('success' , __('site.updated_successfully'));
            return redirect()->route('dashboard.clients.index');

        } catch (\Exception $ex){
            session()->flash('error' , __('site.error_in_data'));
            return redirect()->route('dashboard.clients.index');
        }
    }


    public function destroy($id)
    {
        try {
            $client = Client::find($id);
            if (!$client) {
                return redirect()->route('dashboard.clients.index', $id)->with(['error' => 'هذه اللغة غير موجوده']);
            }
            $client->delete();
            return redirect()->route('dashboard.clients.index')->with(['success' => 'تم حذف اللغة بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('dashboard.clients.index')->with(['error' => 'هناك خطا ما يرجي المحاوله فيما بعد']);
        }
    }
}
