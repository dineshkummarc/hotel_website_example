<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    // Get all services
    public function getAll()
    {
        return Service::all();
    }

    // Get a service by ID
    public function getById($id)
    {
        return Service::findOrFail($id);
    }

    // Create a service
    public function create(array $data)
    {
        return Service::create($data);
    }

    // Update a service
    public function update($id, array $data)
    {
        $service = Service::find($id);
        if (!$service) return null;

        $service->update($data);
        return $service;
    }

    // Delete a service
    public function delete($id)
    {
        return Service::destroy($id);
    }
}
