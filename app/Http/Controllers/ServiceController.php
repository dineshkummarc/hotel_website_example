<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ServiceService;

class ServiceController extends Controller
{
    protected ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    // Show all services
    public function index()
    {
        $services = $this->serviceService->getAll();
        return view('services.index', compact('services'));
    }

    // Show form to create service
    public function createForm()
    {
        return view('services.create');
    }

    // Create new service
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:services,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $this->serviceService->create($validated);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    // Show form to edit service
    public function editForm($id)
    {
        $service = $this->serviceService->getById($id);
        return view('services.edit', compact('service'));
    }

    // Update service
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:services,name,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $this->serviceService->update($id, $validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    // Delete service
    public function destroy($id)
    {
        $this->serviceService->delete($id);
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
