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
        $categoriesArticles = BlogCategory::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->limit(3)
            ->get();

        $student = AcaStudent::where('person_id', Auth::user()->person_id)->first();
        $student_id = $student->id;

        $popularCourses = AcaCourse::join('aca_teachers', 'aca_courses.teacher_id', 'aca_teachers.id')
            ->join('people', 'aca_teachers.person_id', 'people.id')
            ->join('onli_items', function ($query) {
                $query->on('onli_items.item_id', 'aca_courses.id')
                    ->where('entitie', 'Modules-Academic-Entities-AcaCourse');
            })
            ->select(
                'onli_items.id AS onitem_id',
                'onli_items.price AS onitem_price',
                'aca_courses.*',
                'people.names AS person_names',
                'people.father_lastname',
                'people.image AS person_image',
            )
            ->selectRaw('(SELECT COUNT(aca_cap_registrations.id) FROM aca_cap_registrations WHERE aca_cap_registrations.course_id = aca_courses.id) AS registrations')
            ->whereNotIn('aca_courses.id', function ($query) use ($student_id) {
                $query->select('i.course_id')
                    ->from('aca_cap_registrations AS i')
                    ->where('student_id', $student_id);
            })
            ->orderByDesc('registrations')
            ->take(8)
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
