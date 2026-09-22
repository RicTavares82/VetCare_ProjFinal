<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Species;
use App\Models\User;


class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pets = Pet::with(['user', 'species'])
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->species_id, function ($query, $speciesId) {
                $query->where('species_id', $speciesId);
            })
            ->paginate(10);

        $species = Species::orderBy('name')->get();

        return view('pets.index', compact('pets', 'species'));
    }

    public function create()
    {
        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        $species = Species::orderBy('name')->get();

        return view('pets.create', compact('users', 'species'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'species_id' => 'required|exists:species,id',
            'birth_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'sex' => 'nullable|in:Macho,Fêmea',
            'description' => 'nullable|string',
        ]);

        $validated['active'] = $request->boolean('active');

        Pet::create($validated);

        return redirect()
            ->route('pets.index')
            ->with('success', 'Animal registado com sucesso.');
    }

    public function show(Pet $pet)
    {
        $pet->load([
            'user',
            'species',
            'appointments.veterinarian',
            'appointments.services',
            'notes.user',
        ]);

        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        $species = Species::orderBy('name')->get();

        return view('pets.edit', compact('pet', 'users', 'species'));
    }

    public function update(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'species_id' => 'required|exists:species,id',
            'birth_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'sex' => 'nullable|in:Macho,Fêmea',
            'description' => 'nullable|string',
        ]);

        $validated['active'] = $request->boolean('active');

        $pet->update($validated);

        return redirect()
            ->route('pets.show', $pet)
            ->with('success', 'Animal atualizado com sucesso.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()
            ->route('pets.index')
            ->with('success', 'Animal eliminado com sucesso.');
    }
}
