<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $this->title = __('site.title_profile');

        $title = $this->title;
        $auth_user = Auth::user();

        $this->content = view('auth.profile', compact('title', 'auth_user'))->render();

        return $this->renderOutput();
    }

    public function edit()
    {
        $this->title = __('site.title_edit_profile');

        $title = $this->title;
        $auth_user = Auth::user();

        $this->content = view('auth.edit_user', compact('title', 'auth_user'))->render();

        return $this->renderOutput();
    }

    public function update(UserRequest $request)
    {
        if ($this->userService->updateUser($request, Auth::user())) {
            return redirect()->route('users.profile')->with('status', __('site.inf_update'));
        }

        return back()->withInput()->with('status', __('site.warning'));
    }
    public function getExperience(Request $request)
    {
        $getExprnc = $this->userService->getExperienceUser($request);

        if ($getExprnc) {
            return response()->json([
                'success'=>__('site.get_experience'),
                'user_experience' => $getExprnc
            ]);
        }

        return response()->json([
            'status' => __('site.warning')
        ]);
    }

    public function setExperience(Request $request)
    {
        if ($this->userService->setExperienceUser($request)) {
            return response()->json([
                'success'=>__('site.set_experience')
            ]);
        }

        return response()->json([
            'status' => __('site.warning')
        ]);
    }
}
