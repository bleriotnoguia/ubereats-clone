<?php

namespace App\Repositories;

use App\Models\Item;
use App\Contracts\ItemRepositoryInterface;
use Auth;

class ItemRepository implements ItemRepositoryInterface
{
    protected $model;

    public function __construct(Item $item){
        $this->model = $item;
    }

    /**
     * Get's a item by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get's all items.
     *
     * @return mixed
     */
    public function all()
    {
        if(Auth::user()->isSuperAdmin()){
            return $this->model->with(['cuisine', 'category', 'media', 'supplements', 'menu'])->latest()->get();
        }else{
            if(!Auth::user()->restaurant){
                return collect([]);
            }
            return $this->model->with(['cuisine', 'category', 'media', 'supplements', 'menu'])
                            ->where('restaurant_id', Auth::user()->restaurant->id)
                            ->latest()
                            ->get();
            }
    }

    /**
     * Deletes a item.
     *
     * @param int
     */
    public function delete($id)
    {
        $this->model->destroy($id);
    }

    /**
     * Create a item.
     *
     * @param int
     * @param array
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Updates a item.
     *
     * @param int
     * @param array
     */
    public function update(array $data, $id)
    {
        $this->model->findOrFail($id)->update($data);
    }
}