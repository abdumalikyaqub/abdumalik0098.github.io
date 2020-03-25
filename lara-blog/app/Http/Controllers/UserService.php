<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserService extends Controller
{
    public function updateUser($request, $user)
    {
        $clearAvatar = $this->getReqClearAvatar($request);
        $avatarNew = $this->getReqAvatar($request);
        $showPhone = $this->getReqShowPhone($request);

        $data = $request->except(['_token','clear_avatar','show_phone']);

        $data['show_phone'] = $showPhone;

        if ($clearAvatar) {
            $this->clearAvatarSrv($user);
            $data['avatar'] = null;
        } else {
            if ($avatarNew) {
                $data['avatar'] = $this->addAvatarSrv($avatarNew);
            }
        }

        $user->fill($data);

        if ($user->update()) {
            return true;
        }

        return false;
    }

    public function getExperienceUser($request)
    {
        if (empty($request)) {
            return false;
        }
        return User::find($request->user_id)->experience;
    }

    public function setExperienceUser($request)
    {
        if (empty($request)) {
            return false;
        }

        $user = User::find($request->user_id);
        $user->experience = random_int(1, 50);

        if ($user->update()) {
            return true;
        }

        return false;
    }
}
