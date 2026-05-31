<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LecturerPortfolioItemResource;
use App\Http\Resources\Api\LecturerResource;
use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerApiController extends Controller
{
    public function index(Request $request)
    {
        $lecturers = Lecturer::query()
            ->with(['studyProgram', 'expertiseAreas'])
            ->where('is_active', true)
            ->when($request->filled('study_program'), function ($query) use ($request) {
                $slug = (string) $request->string('study_program');
                $query->whereHas('studyProgram', fn ($subQuery) => $subQuery->where('slug', $slug));
            })
            ->when($request->filled('expertise'), function ($query) use ($request) {
                $slug = (string) $request->string('expertise');
                $query->whereHas('expertiseAreas', fn ($subQuery) => $subQuery->where('slug', $slug));
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = (string) $request->string('search');
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('nip', 'like', "%{$search}%")
                        ->orWhere('nidn', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate($request->integer('per_page', 10));

        return LecturerResource::collection($lecturers);
    }

    public function show(string $slug)
    {
        $lecturer = Lecturer::query()
            ->with([
                'studyProgram',
                'expertiseAreas',
                'portfolioItems' => fn ($query) => $query->orderByDesc('year')->orderBy('type'),
                'links',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return new LecturerResource($lecturer);
    }

    public function portfolio(Request $request, string $slug)
    {
        $lecturer = Lecturer::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $portfolioItems = $lecturer->portfolioItems()
            ->when($request->filled('type'), fn ($query) => $query->where('type', (string) $request->string('type')))
            ->when($request->filled('year'), fn ($query) => $query->where('year', $request->integer('year')))
            ->orderByDesc('year')
            ->orderBy('type')
            ->get();

        return LecturerPortfolioItemResource::collection($portfolioItems);
    }
}
