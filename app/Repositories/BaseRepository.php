<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Http;

/**
 * Class BaseRepository
 * @package App\Repositories
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.06.7
 */
class BaseRepository
{
    /**
     * Variable for request header
     */
    private $headers;

    /**
     * variable for sub domain value
     */
    private $subDomainValue;

    /**
     * Function to set request header
     * @param $data
     */
    protected function setHeader(array $data)
    {
        $this->headers = $data;
    }

    /**
     * Function to get request header
     * @return array
     */
    protected function getHeader()
    {
        return $this->headers;
    }

    /**
     * Function to set sub domain value
     * @param $data
     */
    protected function setSubDomainValue(string $data)
    {
        $this->subDomainValue = 'SubDomain ' . $data;
    }

    /**
     * Function to get sub domain value
     * @return string
     */
    protected function getSubDomainValue()
    {
        return $this->subDomainValue;
    }

    /**
     * Function to send API GET request
     * @param $url
     * @param $endpoint
     * @return HttpResponse
     */
    protected function get($url, $endpoint, $request = [])
    {
        return Http::acceptJson()->withHeaders($this->getHeader())->get($url . $endpoint, $request);
    }

    /**
     * Function to send API POST request
     * @param $url
     * @param $endpoint
     * @return HttpResponse
     */
    protected function post($url, $endpoint, $RequestBody = null)
    {
        return Http::acceptJson()->withHeaders($this->getHeader())->post($url . $endpoint, $RequestBody);
    }

    /*
     * Function to send API PUT request
     * @param $url
     * @param $endpoint
     * @return HttpResponse
     */
    protected function put($url, $endpoint, $RequestBody = null)
    {
        return Http::acceptJson()->withHeaders($this->getHeader())->put($url . $endpoint, $RequestBody);
    } 

    /*
     * Function to send API DELETE request
     * @param $url
     * @param $endpoint
     * @return HttpResponse
     */
    protected function delete($url, $endpoint)
    {
        return Http::acceptJson()->withHeaders($this->getHeader())->delete($url . $endpoint);
    }



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
}
