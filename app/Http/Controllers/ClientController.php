<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Services\ClientService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ClientController extends Controller
{
    public function __construct(
        protected ClientService $clientService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $clients = $this->clientService->all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request): RedirectResponse
    {
        $client = $this->clientService->create($request->validated());

        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $client = $this->clientService->find($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $client = $this->clientService->find($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, $id): RedirectResponse
    {
        $client = $this->clientService->update($request->validated(), $id);

        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        //todo cascade
        $this->clientService->delete($id);

        return redirect()->route('clients.index');
    }
}
