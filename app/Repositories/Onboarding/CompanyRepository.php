<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;
use App\Models\Company;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class CompanyRepository
 * @package App\Repositories\Onboarding
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.1
 */
class CompanyRepository extends BaseRepository
{
    /**
     * variable for company model
     */
    private $companyModel;

    /**
     * Function to instantiate Company model
     */
    public function __construct(Company $companyModel)
    {
        $this->companyModel = $companyModel;
    }

    /**
     * Function to fetch company by field
     * @param $field
     * @param $data
     * @return mixed
     */
    public function checkCompanyCode($field, $data)
    {
        $result = $this->companyModel->where($field, $data)->first();
        return is_null($result) === false ? $result->id : $result;
    }

    /**
     * Function to fetch company by id
     * @param $id
     * @return object
     */
    public function getCompanyById(int $id)
    {
        return $this->companyModel->findOrFail($id);
    }
}
