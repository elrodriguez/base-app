<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Modules\Academic\Entities\AcaCapRegistration;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaStudent;
use Modules\Blog\Entities\BlogArticle;
use Modules\Blog\Entities\BlogCategory;
use Modules\Onlineshop\Entities\OnliItem;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Alumno')) {
            return Inertia::render('Academic::Dashboard/knowledge-base', [
                'interests' => $this->getDataStudent()
            ]);
        } else {
            $person = Person::where('id', Auth::user()->person_id)->with('district')->first();
            return Inertia::render('Dashboard', [
                'authPerson' => $person
            ]);
        }
    }

    private function getDataStudent()
    {
        $categoriesArticles = BlogCategory::limit(4)->get();
        $student = AcaStudent::where('person_id', Auth::user()->person_id)->first();
        $student_id = $student->id;

        $popularCourses = AcaCapRegistration::join('aca_courses', function ($query) use ($student_id) {
            $query->on('aca_courses.id', 'aca_cap_registrations.course_id')
                ->where('aca_cap_registrations.student_id', '<>', $student_id);
        })
            ->join('aca_teachers', 'aca_courses.teacher_id', 'aca_teachers.id')
            ->join('people', 'aca_teachers.person_id', 'people.id')
            ->join('onli_items', function ($query) {
                $query->on('onli_items.item_id', 'aca_courses.id')
                    ->where('onli_items.entitie', 'Modules-Academic-Entities-AcaCourse');
            })
            ->select(
                'onli_items.id AS onitem_id',
                'aca_courses.*',
                'people.names AS person_names',
                'people.father_lastname',
                'people.image AS person_image',
            )
            ->selectRaw('count(aca_cap_registrations.id) as registrations_count')
            ->groupBy([
                'onitem_id',
                'people.names',
                'aca_courses.id',
                'people.father_lastname',
                'people.image',
                'aca_courses.status',
                'aca_courses.description',
                'aca_courses.course_day',
                'aca_courses.course_month',
                'aca_courses.course_year',
                'aca_courses.category_id',
                'aca_courses.image',
                'aca_courses.created_at',
                'aca_courses.updated_at',
                'aca_courses.modality_id',
                'aca_courses.type_description',
                'aca_courses.teacher_id',
                'aca_courses.sector_description',
                'aca_courses.price',
            ])
            ->orderByDesc('registrations_count')
            ->take('4')
            ->get();

        $articles = BlogArticle::orderByDesc('views')->take('4')->get();

        return [
            'categoriesArticles' => $categoriesArticles,
            'popularCourses' => $popularCourses,
            'student' => $student,
            'popularArticles' => $articles
        ];
    }
}
