<?php

namespace App\View\Components\Capperu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\Onlineshop\Entities\OnliItem;

class ProgramasPopularesArea extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $programs = OnliItem::join('aca_courses', 'onli_items.item_id', '=', 'aca_courses.id')
                ->join('aca_teachers', 'aca_teachers.id', '=', 'aca_courses.teacher_id')
                ->join('people', 'people.id', '=', 'aca_teachers.person_id')
                ->join('users', 'users.person_id', '=', 'people.id')
                ->select('onli_items.id as id', 'onli_items.name as name', 'onli_items.image as image', 'onli_items.price as price', 'onli_items.additional as additional',
                        'people.names as teacher', 'aca_teachers.id as teacher_id', 'users.avatar as avatar', 'onli_items.description as description')
                ->where('onli_items.status', true)->inRandomOrder()->get();

        return view('components.capperu.programas-populares-area')
        ->with('programs', $programs);
    }
}
