<?php

namespace App\Repositories\Employee;

use App\Models\User;

/**
 * Class EmployeeBaseRepository
 * @package App\Repositories
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.22
 */
class EmployeeBaseRepository
{
    /**
     * variable for model
     */
    protected $model;

    /**
     * Function to fetch all data
     * @param $whereData
     * @return Collection
     */
    protected function getAll($whereData)
    {
        return $this->model->where([$whereData])->get();
    }

    /**
     * Function to store data
     * @param $data
     * @return Collection
     */
    protected function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * Function to find information by id
     * @param $id
     * @return Collection
     */
    protected function doFindOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Function to store user in database
     * @param $data
     */
    public function storeUser($data)
    {
        User::where('email', $data['email'])->delete();
        User::create($data);
    }
}
