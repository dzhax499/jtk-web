<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StudyProgramResource;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramApiController extends Controller
{
    public function index(Request $request)
    {
        $studyPrograms = StudyProgram::query()
            ->when($request->boolean('with_lecturers'), fn ($query) => $query->with('lecturers'))
            ->where('is_active', true)
            ->orderBy('degree')
            ->orderBy('name')
            ->get();

        return StudyProgramResource::collection($studyPrograms);
    }

    public function show(string $slug)
    {
        $studyProgram = StudyProgram::query()
            ->with(['lecturers' => fn ($query) => $query->where('is_active', true)->orderBy('name')])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return new StudyProgramResource($studyProgram);
    }
}
