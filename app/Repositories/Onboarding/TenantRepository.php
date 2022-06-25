<?php

namespace App\Repositories\Onboarding;

use App\Repositories\BaseRepository;
use App\Models\Tenant;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class TenantRepository
 * @package App\Repositories\Onboarding
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.2
 */
class TenantRepository extends BaseRepository
{
    private $tenantModel;
    
    /**
     * Function to instantiate Tenant model
     */
    public function __construct(Tenant $tenantModel)
    {
        $this->tenantModel = $tenantModel;
    }

    /**
     * Function to fetch tenant by id
     * @param $id
     * @return Collection
     */
    public function getTenantById($id)
    {
        return $this->tenantModel->findOrFail($id);
    }
}
