<?php

namespace Modules\CRM\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;
use Inertia\Inertia;

class CrmContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return Inertia::render('CRM::Contacts/List');
    }

    public function getData()
    {
        $model = Person::query();

        return DataTables::of($model)->toJson();
    }
}
