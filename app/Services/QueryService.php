<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class QueryService extends BaseService
{
    const ASC = 'asc';
    const DESC = 'desc';
    /**
     * Eloquent model
     * @var Model $_model
     */
    protected Model $_model;

    /**
     * Select column owner
     * @var array
     */
    public array $select = [];

    public array $filter = [];

    public string $searchRelationship = '';

    public string $itemRelationship = '';

    public string $relationship = '';

    public string $with = '';

    /**
     * Column to search using whereLike
     * @var array
     */
    public array $columnSearch = [];
    /**
     * Relationship with other tables
     * @var array
     */
    public array $withRelationship = [];
    /**
     * Paragraph search in column
     * @var ?string
     */
    public ?string $search;
    /**
     * Start date - End date
     * @var array
     */
    public ?array $getListBy = [];
    /**
     * Start date - End date
     * @var array
     */
    public array $betweenDate = [];

    /**
     * ascending, descending
     * @var string
     */
    public string $ascending = self::ASC;
    /**
     * Column to order
     * @var string
     */
    public string $orderBy = 'created_at';
    /**
     * Always order this column
     * @var string
     */
    public string $defaultOrderBy = 'created_at';
    /**
     * Always order this column
     * @var string
     */
    public string $defaultUpdatedAt = 'updated_at';
    /**
     * Always order
     * @var string
     */
    public string $defaultDescending = 'desc';

    /**
     * QueryService constructor.
     * @param $model
     * @author tanmnt
     */
    public function __construct($model)
    {
        $this->_model = $model;
    }

    /**
     * Query table
     * @return mixed
     * @author tanmnt
     */
    public function queryTable()
    {
        $query = $this->_model::query();
        $this->ascending = $this->ascending === 'ascending' ? self::ASC : self::DESC;
        $query->when($this->select, fn($q) => $q->select($this->select));
        $query->when($this->filter, fn($q) => $q->where($this->filter));
        // $query->when($this->search, fn($q) => $q->whereLike($this->columnSearch, $this->search));
        // $query->when($this->search, fn($q) => $q->where($this->columnSearch,'LIKE','%'.$this->search.'%'));    
        $query->when($this->search, function ($q) {
            $q->where(function ($subQuery) {
                foreach ((array) $this->columnSearch as $column) {
                    $subQuery->orWhere($column, 'LIKE', '%' . $this->search . '%');
                }
            });
        });  
        $query->when($this->getListBy, fn($q) => $q->where($this->getListBy));
        foreach (Arr::wrap($this->withRelationship) as $relationship) {            
            //search phone number in member
            // if($relationship=='member'){
            //     $query = $query->with($relationship)->whereHas('member', function ($query){
            //         $query->where('phone_number', 'like', '%'.$this->searchRelationship.'%');
            //     });
            // } 
            // else if($relationship=='hoSoDuyet'){
            //     $query = $query->with($relationship)->whereHas('hoSoDuyet', function ($query){
            //         $query->where('soChungChi', 'like', '%'.$this->searchRelationship.'%');
            //     });
            // }else{
            //     $query = $query->with($relationship);
            // }
            if($this->itemRelationship && $this->with){   
                 $query = $query->with($this->with)->whereHas($this->with, function ($query){
                    $query->where($this->itemRelationship, 'like', '%'.$this->searchRelationship.'%');
                });
            }else{
                $query = $query->with($relationship);
            }
           
        }
        $query->when(isset($this->betweenDate[0]) && isset($this->betweenDate[1]), function ($q) {
            $startDate = Carbon::parse($this->betweenDate[0])->startOfDay();
            $endDate = Carbon::parse($this->betweenDate[1])->endOfDay();
            $q->whereBetween($this->defaultUpdatedAt, [$startDate, $endDate]);
        });
        
        $query->when($this->orderBy, fn($q) => $q->orderBy($this->orderBy, $this->ascending));
        $query->when($this->defaultOrderBy, fn($q) => $q->orderBy($this->defaultOrderBy, $this->defaultDescending));     
        return $query;
    }
}
