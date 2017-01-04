<?php

namespace App\Repositories;

/**
 * Class ContentRepository
 *
 * @author Sahbaj Uddin
 */
use App\Http\Models\ViewCategory;
use Config,
    Event;

class ViewCategoryRepository
{

    /**
     * Sentry instance
     * @var
     */
    public function __construct()
    {

    }

    public function create(array $input)
    {

        try {
            $d = new ViewCategory();
            $d->create($input);
        } catch (CartaUserExists $e) {
            throw new NotFoundException;
        }
        return $d;
    }


    public function update($id, array $data)
    {
        $obj = $this->find($id);
        //  Event::fire('repository.updating', [$obj]);
        $obj->update($data);
        return $obj;
    }

    public function all(array $search_filters = [])
    {

        $q = new ViewCategory();
        $per_page = Config::get('acl_base.list_per_page');
        // $q = $this->applySearchFilters($search_filters, $q);
        return $q->paginate($per_page);
    }

    protected function applySearchFilters(array $search_filters, $q)
    {
        if (isset($search_filters['name']) && $search_filters['name'] !== '')
            $q = $q->where('name', 'LIKE', "%{$search_filters['name']}%");
        return $q;
    }


    public function delete($id)
    {
        $obj = $this->find($id);
        //   Event::fire('repository.deleting', [$obj]);
        return $obj->delete();
    }

    public function find($id)
    {
        try {
            $d = ViewCategory::find($id);
        } catch (GroupNotFoundException $e) {
            throw new NotFoundException;
        }

        return $d;
    }


    public function allWhere(array $search_filters = [], $request)
    {

        $q = new ViewCategory();
        $per_page = Config::get('acl_base.list_per_page');
        //   $q = $this->applySearchFilters($search_filters, $q);
        $fcategory_id = '';
        if ($request->deviceType == 'android') {
            $fcategory_id = 1;
        } elseif ($request->deviceType == 'normal') {
            $fcategory_id = 2;
        } elseif ($request->driverType == 'driver') {
            $fcategory_id = 3;
        }

        return $q->where('fcategory_id', $fcategory_id)
            ->orderBy('created_at', 'desc')
            ->paginate($per_page);
    }


}
