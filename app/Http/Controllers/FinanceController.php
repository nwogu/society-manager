<?php

namespace App\Http\Controllers;

use App\Collection;
use Illuminate\Http\Request;
use App\Http\Services\FinanceService;
use App\Http\Requests\CollectionRequest;

class FinanceController extends Controller
{
    /**
     * Hold Society Instance
     */
    protected $society;

    /**
     * Hold Finance Service
     */
    protected $financeService;

    public function __construct(Request $request, FinanceService $financeService)
    {
        //Resolve Society
        $this->society = Society::find($request->session->get('society'));
        //Resolve Finance Service
        $this->FinanceService = $financeService;
    }

    /**
     * Get Collected Dues
     * @return Response
     */
    public function getCollectedDues()
    {
        //Get Collected Dues
        $collectedDues = $this->financeService->getCollectedDues($this->society);
    }

    /**
     * Get Collected Levies
     * @return Response
     */
    public function getCollectedLevies()
    {
        //Get Collected Levies
        $collectedLevies = $this->financeService->getCollectedLevies($this->society);
    }

    /**
     * Get Collected Donations
     * @return Response
     */
    public function getCollectedDonations()
    {
        //Get Collected Donations
        $collectedDonations = $this->financeService->getCollectedDonations($this->society);
    }

    /**
     * Get Collected Expenses
     * @return Response
     */
    public function getCollectedExpenses()
    {
        //Get Collected Expenses
        $collectedExpenses = $this->financeService->getCollectedExpenses($this->society);
    }

    /**
     * Record Collection
     * @return Response
     */
    public function recordCollection(CollectionRequest $request)
    {
        //Collection
        $collection = $this->financeService->recordCollection($this->society, $request->validated());
    }

    /**
     * Edit Collection
     * @return Response
     */
    public function editCollection(Collection $collection, CollectionRequest $request)
    {
        //edited collection
        $editedCollection = $this->financeService->editCollection($this->society, $collection, $request->validated());
    }

    /**
     * Remove Collection
     * @return Response
     */
    public function deleteCollection(Collection $collection)
    {
        //delete collection
        $this->financeService->deleteCollection($this->society, $collection);
    }
}
