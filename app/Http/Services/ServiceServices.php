<?php

namespace App\Http\Services;

use App\Repositories\ServiceRepository;

class ServiceService
{
    protected ServiceRepository $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getAll()
    {
        return $this->serviceRepository->getAll();
    }

    public function getById($id)
    {
        return $this->serviceRepository->getById($id);
    }

    public function create(array $data)
    {
        return $this->serviceRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->serviceRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->serviceRepository->delete($id);
    }
}
