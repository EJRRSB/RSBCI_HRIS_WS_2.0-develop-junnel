<?php

namespace App\Services;

/**
 * Class BaseService
 * @package App\Service
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.7
 */
class BaseService
{
    protected $repository;

    protected $returnResponse = ['result' => '','message' => ''];
}
