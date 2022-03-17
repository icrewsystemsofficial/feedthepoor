<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqEntries;
use App\Helpers\FaqHelper;
use App\Models\FaqCategories;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = FaqCategories::all();
        $entries = FaqEntries::all();
        foreach ($entries as $entry) {
            $entry->category = FaqHelper::getCategoryName($entry->category_id);
        }
        return view('admin.faq.questions.index', compact('categories', 'entries'));
    }

    public function manage(Request $request, FaqEntries $entry)
    {
        $entry = FaqEntries::find($request->id);
        $categories = FaqCategories::all();
        $category_names = array();
        foreach ($categories as $cat) {
            $category_names[$cat->id] = [$cat->category_name, $cat->category_status];   
        }
        $entry->category_list = $category_names;
        return view('admin.faq.questions.manage', compact('entry'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'entry_question' => 'required|string',
            'entry_answer' => 'required|string',
            'author_name' => 'required|string',
        ]);
        $entry = FaqEntries::find($request->id);
        $entry->update($request->all());
        alert()->success('Yay','Entry "'.$request->entry_question.'" was successfully updated');
        return redirect(route('admin.faq.questions.questions.index'));
    }

    public function destroy(Request $request)
    {
        $entry = FaqEntries::find($request->id);        
        $entry->delete();
        alert()->success('Yay','Entry "'.$entry->entry_question.'" was successfully deleted');
        return redirect(route('admin.faq.questions.index'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric',
            'entry_question' => 'required|string',
            'entry_answer' => 'required|string',
            'author_name' => 'required|string',
        ]);
        FaqEntries::create($request->all());
        alert()->success('Yay','Entry "'.$request->entry_question.'" was successfully added');
        return redirect(route('admin.faq.questions.index'));
    }

    public function categories()
    {
        $categories = FaqCategories::all();
        return view('admin.faq.categories.index', compact('categories'));
    }

    public function category_manage(Request $request, FaqCategories $category)
    {           
        $category = FaqCategories::find($request->id);
        return view('admin.faq.categories.manage', compact('category'));
    }

    public function category_store(Request $request)
    {
        if (!isset($request->category_status)) {
            $request->merge(['category_status' => 'off']);
        }
        $request->validate([
            'category_name' => 'required|string',
            'category_description' => 'required|string',
            'category_status' => 'required|string|in:off,on',
        ]);
        $request->merge(['category_status' => $request->category_status == 'on' ? 1 : 0]);
        FaqCategories::create($request->all());
        alert()->success('Yay','Category "'.$request->category_name.'" was successfully added');
        return redirect(route('admin.faq.categories.index'));
    }

    public function category_update(Request $request)
    {   
        if (!isset($request->category_status)) {
            $request->merge(['category_status' => 'off']);
        }
        $request->validate([
            'category_name' => 'required|string',
            'category_description' => 'required|string',
            'category_status' => 'required|string|in:off,on',
        ]);
        $request->merge(['category_status' => $request->category_status == 'on' ? 1 : 0]);
        $category = FaqCategories::find($request->id);
        $category->update($request->all());
        alert()->success('Yay','Category "'.$request->category_name.'" was successfully updated');
        return redirect(route('admin.faq.categories.index'));
    }

    public function category_destroy(Request $request)
    {   
        $category = FaqCategories::find($request->id);
        $category->delete();
        $i = 0;
        $entries = FaqEntries::where('category_id', $request->id)->get();
        foreach ($entries as $entry) {
            $entry->delete();
            $i++;
        }
        alert()->success('Yay','Category "'.$category->category_name.'" and '.$i.' questions were successfully deleted');
        return redirect(route('admin.faq.categories.index'));
    }
}
