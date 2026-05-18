<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class WelcomePageController extends Controller
{
    public function index()
    {
        $basePath = public_path('uploads/images/art_images');

        $latestImages = [];

        if (File::exists($basePath)) {

            /*
        |------------------------------------------------------------------
        | Get All Folders
        |------------------------------------------------------------------
        */

            $folders = File::directories($basePath);

            /*
        |------------------------------------------------------------------
        | Convert Folder Name To Carbon Date
        | Example:
        | 2 November 2021
        |------------------------------------------------------------------
        */

            $folderCollection = collect($folders)->map(function ($folder) {

                $folderName = basename($folder);

                try {

                    $carbonDate = \Carbon\Carbon::createFromFormat(
                        'j F Y',
                        $folderName
                    );
                } catch (\Exception $e) {

                    return null;
                }

                return [

                    'path' => $folder,

                    'name' => $folderName,

                    'date' => $carbonDate,
                ];
            })->filter();

            /*
        |------------------------------------------------------------------
        | Sort Latest Folder By Date
        |------------------------------------------------------------------
        */

            $folderCollection = $folderCollection
                ->sortByDesc('date')
                ->values();

            /*
        |------------------------------------------------------------------
        | Get Images From Latest Folders
        |------------------------------------------------------------------
        */

            foreach ($folderCollection as $folderData) {

                $folder = $folderData['path'];

                $folderName = $folderData['name'];

                $images = collect(File::files($folder))

                    ->filter(function ($file) {

                        return in_array(
                            strtolower($file->getExtension()),
                            ['jpg', 'jpeg', 'png', 'webp']
                        );
                    })

                    ->map(function ($file) use ($folderName) {

                        return asset(
                            'uploads/images/art_images/' .
                                $folderName . '/' .
                                $file->getFilename()
                        );
                    })

                    ->values();

                /*
            |------------------------------------------------------------------
            | Push Images
            |------------------------------------------------------------------
            */

                foreach ($images as $image) {

                    $latestImages[] = $image;

                    /*
                |--------------------------------------------------------------
                | Only 3 Images
                |--------------------------------------------------------------
                */

                    if (count($latestImages) >= 3) {
                        break 2;
                    }
                }
            }
        }

        return view(
            'frontend.welcome',
            compact('latestImages')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GALLERY PAGE
    |--------------------------------------------------------------------------
    */

    public function gallery()
    {
        $basePath = public_path('uploads/images/art_images');

        $galleryFolders = [];

        if (File::exists($basePath)) {

            $folders = File::directories($basePath);

            $folderCollection = collect($folders)->map(function ($folder) {

                $folderName = basename($folder);

                try {

                    /*
                    |--------------------------------------------------------------------------
                    | Example Folder Name:
                    | 2 November 2021
                    |--------------------------------------------------------------------------
                    */

                    $carbonDate = Carbon::createFromFormat(
                        'j F Y',
                        $folderName
                    );
                } catch (\Exception $e) {

                    return null;
                }

                return [
                    'path' => $folder,
                    'name' => $folderName,
                    'date' => $carbonDate,
                ];
            })->filter();

            /*
            |--------------------------------------------------------------------------
            | Sort Latest To Oldest
            |--------------------------------------------------------------------------
            */

            $folderCollection = $folderCollection
                ->sortByDesc('date')
                ->values();

            foreach ($folderCollection as $folderData) {

                $folder = $folderData['path'];

                $folderName = $folderData['name'];

                $formattedDate = $folderData['date']
                    ->format('d F Y');

                $monthYear = $folderData['date']
                    ->format('F Y');

                /*
                |--------------------------------------------------------------------------
                | GET IMAGES
                |--------------------------------------------------------------------------
                */

                $images = collect(File::files($folder))

                    ->filter(function ($file) {

                        return in_array(
                            strtolower($file->getExtension()),
                            ['jpg', 'jpeg', 'png', 'webp']
                        );
                    })

                    ->map(function ($file) use ($folderName) {

                        return asset(
                            'uploads/images/art_images/' .
                                $folderName . '/' .
                                $file->getFilename()
                        );
                    })

                    ->values()
                    ->toArray();

                /*
                |--------------------------------------------------------------------------
                | PUSH TO ARRAY
                |--------------------------------------------------------------------------
                */

                if (!empty($images)) {

                    $galleryFolders[] = [

                        'date'        => $formattedDate,

                        'month_year'  => $monthYear,

                        'slug'        => Str::slug($folderName),

                        'images'      => $images,
                    ];
                }
            }
        }

        return view(
            'frontend.gallery_page.gallery',
            compact('galleryFolders')
        );
    }
}
