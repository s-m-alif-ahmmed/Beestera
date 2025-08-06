<?php

namespace App\Http\Controllers\Web\Backend\CMS\Learn;

use App\Models\CMS;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CMSMindsetController extends Controller
{
    public function index(): View
    {
        $cms = CMS::findOrFail(9);
        return view("backend.layouts.cms.learn.mindset_edit" , compact('cms'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'picture' =>'nullable|file|mimes:jpeg,jpg,png|max:5120',
        ]);

        $cms = CMS::find(9);
        $cms->title = $request->title ;
        $cms->description = $request->description;

        if ($request->hasFile('picture')) {
            if ($cms->picture) {
                Helper::fileDelete($cms->picture);
            }
            $imagePath = Helper::fileUpload($request->file('picture'), 'cms', time() . '_' . $request->file('picture')->getClientOriginalName());
            $cms->picture = $imagePath;
        }
        $cms->save();
        return redirect()->route('cms.learn.mindset.banner' , compact('cms'))->with('t-success','Mindset Updated successfully.');
        //return view('backend.layouts.cms.learn.general_edit' , compact('cms'));
    }
}
