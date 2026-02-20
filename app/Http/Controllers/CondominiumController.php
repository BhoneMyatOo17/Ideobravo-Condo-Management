<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CondominiumController extends Controller
{
    /**
     * Display a listing of condominiums
     */
    public function index()
    {
        $condominiums = Condominium::withCount(['residents', 'staff'])
            ->orderBy('name')
            ->paginate(20);

        return view('condominiums.index', compact('condominiums'));
    }

    /**
     * Show the form for creating a new condominium
     */
    public function create()
    {
        return view('condominiums.create');
    }

    /**
     * Store a newly created condominium
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'line_id' => 'nullable|string|max:255',
            'total_floors' => 'nullable|integer|min:1',
            'total_units' => 'nullable|integer|min:1',
            'built_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        // Generate unique code
        $validated['code'] = $this->generateUniqueCode($validated['name']);

        $condominium = Condominium::create($validated);

        return redirect()->route('condominiums.index')
            ->with('success', 'Condominium created successfully. Invitation code: ' . $condominium->code);
    }

    /**
     * Display the specified condominium
     */
    public function show(Condominium $condominium)
    {
        $condominium->loadCount(['residents', 'staff']);

        // Get statistics
        $stats = [
            'total_residents' => $condominium->residents()->count(),
            'active_residents' => $condominium->residents()->where('is_active', true)->count(),
            'total_staff' => $condominium->staff()->count(),
            'active_staff' => $condominium->staff()->where('is_active', true)->count(),
            'pending_parcels' => \App\Models\Parcel::where('condominium_id', $condominium->id)
                ->whereIn('status', ['pending', 'notified'])->count(),
            'pending_bills' => \App\Models\Bill::where('condominium_id', $condominium->id)
                ->where('status', 'pending')->count(),
        ];

        return view('condominiums.show', compact('condominium', 'stats'));
    }

    /**
     * Show the form for editing the condominium
     */
    public function edit(Condominium $condominium)
    {
        return view('condominiums.edit', compact('condominium'));
    }

    /**
     * Update the specified condominium
     */
    public function update(Request $request, Condominium $condominium)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'line_id' => 'nullable|string|max:255',
            'total_floors' => 'nullable|integer|min:1',
            'total_units' => 'nullable|integer|min:1',
            'built_year' => 'nullable|integer|min:1900|max:' . (date('Y') + 5),
        ]);

        $condominium->update($validated);

        return redirect()->route('condominiums.index')
            ->with('success', 'Condominium updated successfully.');
    }

    /**
     * Regenerate invitation code
     */
    public function regenerateCode(Condominium $condominium)
    {
        $newCode = $this->generateUniqueCode($condominium->name);
        $condominium->update(['code' => $newCode]);

        return back()->with('success', 'New invitation code generated: ' . $newCode);
    }

    /**
     * Remove the specified condominium
     */
    public function destroy(Condominium $condominium)
    {
        // Check if condominium has residents or staff
        if ($condominium->residents()->exists() || $condominium->staff()->exists()) {
            return back()->with('error', 'Cannot delete condominium with existing residents or staff.');
        }

        $condominium->delete();

        return redirect()->route('condominiums.index')
            ->with('success', 'Condominium deleted successfully.');
    }

    /**
 * Generate unique invitation code (6 characters)
    */
    private function generateUniqueCode(string $name): string
    {
        do {
            $code = strtoupper(Str::random(6));
        } while (Condominium::where('code', $code)->exists());

        return $code;
    }
}