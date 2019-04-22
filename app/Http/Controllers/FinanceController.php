<?php

namespace App\Http\Controllers;

use App\Society;
use App\Collection;
use Illuminate\Http\Request;
use App\Http\Services\FinanceService;
use App\Http\Requests\CollectionRequest;
use App\Constants;

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

    public function __construct(FinanceService $financeService)
    {
        $this->middleware(function ($request, $next){
            //Resolve Society
            $this->society = Society::find($request->session()->get("society"));
            return $next($request);
        });
        //Resolve Finance Service
        $this->financeService = $financeService;
    }

    /**
     * Get Collected Dues
     * @return Response
     */
    public function getCollectedDues()
    {
        //Get Collected Dues
        $collectedDues = $this->financeService->getCollectedDues($this->society);
        return view('dashboard.finance.all-dues', ['dues' => $collectedDues]);
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
        $this->financeService->recordCollection($this->society, $request->all());
        return redirect()->route($this->financeService->getCollectionRoute($request->collection_type))->with("message", "Collecton added successfully");
    }

    /**
     * Show Record Collection
     * @return Response
     */
    public function showRecordCollection(Request $request)
    {
        //Collection
        return view('dashboard.finance.show-record-collection', 
            [
                "collectionTypes" => Constants::COLLECTION_TYPES, 
                "society" => $this->society,
                "type" => $request->collection_type
            ]
        );
    }

    /**
     * Show Edit Collection
     * @return Response
     */
    public function showEditCollection(Collection $collection)
    {
        //Collection
        return view('dashboard.finance.show-edit-collection', 
            [
                "collectionTypes" => Constants::COLLECTION_TYPES, 
                "society" => $this->society,
                "collection" => $collection
            ]
        );
    }

    /**
     * Edit Collection
     * @return Response
     */
    public function editCollection(Collection $collection, CollectionRequest $request)
    {
        //edited collection
        $this->financeService->editCollection($this->society, $collection, $request->all());
        //collection
        return redirect()->route("show-collection", ['collection' => $collection->id])->with("message", "Updated Successfully");
    }

    /**
     * Show Collection
     * @return Response
     */
    public function showCollection(Collection $collection)
    {
        $collection = $this->financeService->showCollection($this->society, $collection);
        return view("dashboard.finance.show-collection", ["collection" => $collection]);
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
