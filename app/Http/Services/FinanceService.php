<?php

namespace App\Http\Services;

use App\Society;
use App\Constants;
use App\Collection;
use Illuminate\Support\Facades\Auth;

class FinanceService
{
    /**
     * Hold Limit
     */
    protected $limit = Constants::DEFAULT_LIMIT;

    /**
     * Get Collected Dues
     * @param Society $society
     * 
     * @return Collection
     */
    public function getCollectedDues(Society $society)
    {
        return $society->collections()
        ->where('type', Constants::COLLECTION_DUE_TYPE)
        ->orderBy('created_at', 'desc')
        ->paginate($this->limit);
    }

    /**
     * Get Collected Levies
     * @param Society $society
     * 
     * @return Collection
     */
    public function getCollectedLevies(Society $society)
    {
        return $society->collections()
        ->where('type', Constants::COLLECTION_LEVY_TYPE)
        ->orderBy('created_at', 'desc')
        ->paginate($this->limit);
    }

    /**
     * Get Collected Donations
     * @param Society $society
     * 
     * @return Collection
     */
    public function getCollectedDonations(Society $society)
    {
        return $society->collections()
        ->where('type', Constants::COLLECTION_DONATION_TYPE)
        ->orderBy('created_at', 'desc')
        ->paginate($this->limit);
    }

    /**
     * Get Collected Expenses
     * @param Society $society
     * 
     * @return Collection
     */
    public function getCollectedExpenses(Society $society)
    {
        return $society->collections()
        ->where('type', Constants::COLLECTION_EXPENSE_TYPE)
        ->orderBy('created_at', 'desc')
        ->paginate($this->limit);
    }

    /**
     * Record Collection
     * @param Society $society
     * @param array $data
     * 
     * @return Collection
     */
    public function recordCollection(Society $society, $data)
    {
        //Add Society
        $data['society_id'] =$society->id;
        //Check recorder
        $data['recorder'] = empty($data['recorder']) ?? Auth::user();
        return Collection::create($data);
    }

    /**
     * Edit Collection
     * @param Society $society
     * @param Collection $collection
     * @param array $data
     * 
     * @return Collection
     */
    public function editCollection(Society $society, $collection, $data)
    {
        //Get Collection
        $collection = $society->collections()->where('id', $collection->id)->first();
        //check collection
        if($collection == null) throw new \Exception("Collection not found for this society");
        //update collection
        return $collection::update($data);
    }

    /**
     * Delete Collection
     * @param Society $society
     * @param Collection $collection
     * 
     * @return bool
     */
    public function deleteCollection(Society $society, $collection)
    {
        //Get Collection
        $collection = $society->collections()->where('id', $collection->id)->first();
        //check collection
        if($collection == null) throw new \Exception("Collection not found for this society");
        //delete collection
        return $collection->delete();
    }

    
}