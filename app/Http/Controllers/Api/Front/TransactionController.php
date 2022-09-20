<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends BaseController
{
    /**
     * List
     * @group Transaction
     */
    public function index()
    {
        $transactions = Transaction::pimp()->paginate();
        $message = "All records";
        TransactionResource::collection($transactions);
        return $this->sendResponse(compact('transactions'), $message);
    }

    /**
     * Add
     * @group Transaction
     */
    public function store(Request $request)
    {
        $transaction = Transaction::createUpdate(new Transaction, $request);
        $message = "Transaction added successfully";
        $transaction = new TransactionResource($transaction);
        return $this->sendResponse(compact('transaction'), $message);
    }

    /**
     * show
     * @group Transaction
     */
    public function show(Transaction $transaction)
    {
        $message = "Transaction listed successfully"; 
        $transaction = new TransactionResource($transaction);
        return $this->sendResponse(compact('transaction'), $message);
    }

    /**
     * Update
     * @group Transaction
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction = Transaction::createUpdate($transaction, $request);
        $message = "Transaction updated successfully";
        $transaction = new TransactionResource($transaction);
        return $this->sendResponse(compact('transaction'), $message);
    }

}
