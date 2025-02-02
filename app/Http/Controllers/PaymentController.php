<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Services\Payment\PaymentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct(
        protected PaymentService $paymentService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $payments = $this->paymentService->paginated();

        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request): RedirectResponse
    {
        $payment = $this->paymentService->create($request->validated());

        return redirect()->route('payments.show', $payment->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $payment = $this->paymentService->find($id);
        return view('payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $payment = $this->paymentService->find($id);
        return view('payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, $id): RedirectResponse
    {
        $payment = $this->paymentService->update($request->validated(), $id);

        return redirect()->route('payments.show', $payment->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $this->paymentService->delete($id);

        return redirect()->route('payments.index');
    }
}
