<?php

namespace App\Http\Controllers\Web\Backend\CMS\Learn;

use App\Models\CMS;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CMSPositionSpecificController extends Controller
{
    public function index(): View
    {
        $cms = CMS::findOrFail(10);
        return view("backend.layouts.cms.learn.position_specific_edit" , compact('cms'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'picture' =>'nullable|file|mimes:jpeg,jpg,png|max:5120',
        ]);

        $cms = CMS::find(10);
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
        return redirect()->route('cms.learn.position-specific.banner' , compact('cms'))->with('t-success','Position-Specific Updated successfully.');
        //return view('backend.layouts.cms.learn.general_edit' , compact('cms'));
    }
}
