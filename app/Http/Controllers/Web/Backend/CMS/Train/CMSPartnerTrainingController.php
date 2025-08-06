<?php

namespace App\Http\Controllers\Web\Backend\CMS\Train;

use App\Models\CMS;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CMSPartnerTrainingController extends Controller
{
    public function index(): View
    {
        $cms = CMS::findOrFail(7);
        return view("backend.layouts.cms.train.partner_training_edit", compact('cms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'picture' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
        ]);

        $cms = CMS::find(7);
        $cms->title = $request->title;
        $cms->description = $request->description;

        if ($request->hasFile('picture')) {
            if ($cms->picture) {
                Helper::fileDelete($cms->picture);
            }
            $imagePath = Helper::fileUpload($request->file('picture'), 'cms', time() . '_' . $request->file('picture')->getClientOriginalName());
            $cms->picture = $imagePath;
        }
        $cms->update();
        return redirect()->route('cms.train.partner-training.banner' , compact('cms'))->with('t-success','Partner Training Updated successfully.');
        //return view('backend.layouts.cms.train.partner_training_edit', compact('cms'));
    }
}
