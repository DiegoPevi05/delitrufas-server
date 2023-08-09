<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Retrieve only verified users with pagination
        $servicesQuery = Service::query();

        // Check if the name search parameter is provided
        $name = $request->query('name');
        if ($name) {
            // Apply the name filter to the query
            $servicesQuery->where('name', 'like', '%' . $name . '%');
        }

        // Paginate the categories
        $services = $servicesQuery->paginate(10);

        // Decode the 'options' field for each service
        foreach ($services as $service) {
            $service->options = json_decode($service->options);
        }

        // Get the requested page from the query string
        $page = $request->query('page');

        // Redirect to the first page if the requested page is not valid
        if ($page && ($page < 1 || $page > $services->lastPage())) {
            return redirect()->route('services.index');
        }

        $searchParam = $name ? $name : '';

        // Return a view or JSON response as desired
        return view('services.index', compact('services', 'searchParam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25',
            'options' => 'required|array|min:1',
            'options.*.price' => 'required|numeric',
            'options.*.duration' => 'required|numeric',
            'is_active' => 'nullable',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 25 caracteres.',
            'options.required' => 'Debe proporcionar al menos una opción.',
            'options.array' => 'Las opciones deben ser un conjunto de objetos.',
            'options.min' => 'El nombre no debe ser minimo a 1.',
            'options.*.price.required' => 'El precio de la opción es obligatorio.',
            'options.*.price.numeric' => 'El precio de la opción debe ser numérico.',
            'options.*.duration.required' => 'La duración de la opción es obligatoria.',
            'options.*.duration.numeric' => 'La duración de la opción debe ser numérica.',
        ]);

        $is_active = isset($validatedData['is_active']) && $validatedData['is_active'] ? true : false;

        // Convert the options array to JSON
        $optionsJson = json_encode($validatedData['options']);

        $service = Service::create([
            'name' => $validatedData['name'],
            'options' => $optionsJson, // Store the options as JSON
            'is_active' => $is_active,
        ]);

        return redirect()->route('services.index')->with('logSuccess', 'Servicio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service )
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        // Show the form for editing the specified Category
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:25',
            'options' => 'required|array|min:1',
            'options.*.price' => 'required|numeric',
            'options.*.duration' => 'required|numeric',
            'is_active' => 'nullable',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 25 caracteres.',
            'options.required' => 'Debe proporcionar al menos una opción.',
            'options.array' => 'Las opciones deben ser un conjunto de objetos.',
            'options.min' => 'El nombre no debe ser minimo a 1.',
            'options.*.price.required' => 'El precio de la opción es obligatorio.',
            'options.*.price.numeric' => 'El precio de la opción debe ser numérico.',
            'options.*.duration.required' => 'La duración de la opción es obligatoria.',
            'options.*.duration.numeric' => 'La duración de la opción debe ser numérica.',
        ]);

        $is_active = isset($validatedData['is_active']) && $validatedData['is_active'] ? true : false;

        // Convert the options array to JSON
        $optionsJson = json_encode($validatedData['options']);

        $service->update([
            'name' => $validatedData['name'],
            'options' => $optionsJson, // Store the options as JSON
            'is_active' => $is_active,
        ]);

        return redirect()->route('services.index')->with('logSuccess', 'Servicio actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // Delete the specified Category
        $service->delete();
        // Return a success response or redirect as desired
        return redirect()->route('services.index')->with('logSuccess', 'Servicio borrado exitosamente.');
    }
}
