<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class PhotoImportServices
{

    public function importLogoCompany($company, $request)
    {

        if (!$request->hasfile('logo_company')) {
            return false;
        }

        $file = $request->file('logo_company');
        $ext = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));
        $nameDocument = $company->id.'-'.$company->company_slug . '.' . $ext;

        $fileNew = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'company' . DIRECTORY_SEPARATOR . $nameDocument);

        $image = Image::make($file->getRealPath());


        $image->resize(config('image.logo_company_x'), config('image.logo_company_y'), null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save($fileNew);

        $company->company_logo=$nameDocument;
        $company->save();

        return $nameDocument;
    }


    public function importPhotoProfileUser($profile, $request)
    {

        if (!$request->hasfile('photo')) {
            return false;
        }

        $file = $request->file('photo');
        $ext = strtolower(pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION));
        $nameDocument = $profile->id.'-'.$profile->profile_slug . '.' . $ext;

        $fileNew = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'photo_users' . DIRECTORY_SEPARATOR . $nameDocument);

        $image = Image::make($file->getRealPath());


        $image->resize(config('image.logo_profile_x'), config('image.logo_profile_y'), null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save($fileNew);

        $profile->photo=$nameDocument;
        $profile->save();

        return $nameDocument;
    }
}