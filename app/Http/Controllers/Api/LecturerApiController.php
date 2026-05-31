<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LecturerApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Lecturer::with(['studyProgram', 'expertiseAreas'])
            ->where('is_active', true)
            ->orderBy('name');

        if ($request->filled('study_program')) {
            $query->whereHas('studyProgram', function ($q) use ($request) {
                $q->where('slug', $request->query('study_program'))
                  ->orWhere('name', 'ilike', '%' . $request->query('study_program') . '%');
            });
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', '%' . $search . '%')
                  ->orWhere('nidn', 'ilike', '%' . $search . '%')
                  ->orWhere('academic_position', 'ilike', '%' . $search . '%');
            });
        }

        $lecturers = $query->get()->map(fn (Lecturer $lecturer) => $this->summary($lecturer));

        return response()->json([
            'data' => $lecturers,
        ]);
    }

    public function show(string $slug): JsonResponse
    {
        $lecturer = Lecturer::with([
                'studyProgram',
                'expertiseAreas',
                'educations',
                'teachingHistories.studyProgram',
                'portfolioItems',
                'publications',
                'links',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'data' => $this->detail($lecturer),
        ]);
    }

    public function portfolio(string $slug): JsonResponse
    {
        $lecturer = Lecturer::with(['portfolioItems', 'publications'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'data' => [
                'portfolio_items' => $lecturer->portfolioItems,
                'publications' => $lecturer->publications,
            ],
        ]);
    }

    private function summary(Lecturer $lecturer): array
    {
        return [
            'id' => $lecturer->id,
            'name' => $lecturer->name,
            'slug' => $lecturer->slug,
            'nidn' => $lecturer->nidn,
            'academic_position' => $lecturer->academic_position,
            'highest_education' => $lecturer->highest_education,
            'photo_url' => $lecturer->photo_url,
            'study_program' => $lecturer->studyProgram ? [
                'id' => $lecturer->studyProgram->id,
                'name' => $lecturer->studyProgram->name,
                'slug' => $lecturer->studyProgram->slug,
                'degree' => $lecturer->studyProgram->degree,
            ] : null,
            'expertise_areas' => $lecturer->expertiseAreas->map(fn ($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
            ])->values(),
        ];
    }

    private function detail(Lecturer $lecturer): array
    {
        return array_merge($this->summary($lecturer), [
            'nip' => $lecturer->nip,
            'email' => $lecturer->email,
            'gender' => $lecturer->gender,
            'employment_status' => $lecturer->employment_status,
            'activity_status' => $lecturer->activity_status,
            'bio' => $lecturer->bio,
            'educations' => $lecturer->educations->map(fn ($item) => [
                'id' => $item->id,
                'degree_level' => $item->degree_level,
                'institution_name' => $item->institution_name,
                'study_program' => $item->study_program,
                'start_year' => $item->start_year,
                'graduation_year' => $item->graduation_year,
                'academic_degree' => $item->academic_degree,
                'degree_abbreviation' => $item->degree_abbreviation,
            ])->values(),
            'teaching_histories' => $lecturer->teachingHistories->map(fn ($item) => [
                'id' => $item->id,
                'semester_name' => $item->semester_name,
                'course_code' => $item->course_code,
                'course_name' => $item->course_name,
                'class_name' => $item->class_name,
                'academic_year' => $item->academic_year,
                'is_active' => $item->is_active,
                'study_program' => $item->studyProgram ? [
                    'id' => $item->studyProgram->id,
                    'name' => $item->studyProgram->name,
                    'slug' => $item->studyProgram->slug,
                ] : null,
            ])->values(),
            'portfolio_items' => $lecturer->portfolioItems->map(fn ($item) => [
                'id' => $item->id,
                'type' => $item->type,
                'category' => $item->category ?? null,
                'title' => $item->title,
                'description' => $item->description,
                'year' => $item->year,
                'source' => $item->source,
                'external_url' => $item->external_url,
            ])->values(),
            'publications' => $lecturer->publications->map(fn ($item) => [
                'id' => $item->id,
                'source' => $item->source,
                'category' => $item->category,
                'title' => $item->title,
                'matched_title' => $item->matched_title,
                'year' => $item->year,
                'citation_count' => $item->citation_count,
                'venue' => $item->venue,
                'authors' => $item->authors,
                'publisher' => $item->publisher,
                'publication_url' => $item->publication_url,
                'eprint_url' => $item->eprint_url,
                'doi' => $item->doi,
                'eid' => $item->eid,
                'status' => $item->status,
            ])->values(),
            'links' => $lecturer->links->map(fn ($item) => [
                'id' => $item->id,
                'platform' => $item->platform,
                'url' => $item->url,
            ])->values(),
        ]);
    }
}
