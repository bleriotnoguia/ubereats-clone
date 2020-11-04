<?php

namespace App\Contracts;

interface ItemRepositoryInterface
{
    /**
     * Get's a item by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get's all items.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a item.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a item.
     *
     * @param int
     * @param array
     */
    public function update(array $data, $id);

    /**
     * Updates a item.
     *
     * @param int
     * @param array
     */
    public function create(array $data);
}