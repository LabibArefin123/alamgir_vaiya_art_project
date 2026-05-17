<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;

class WelcomePageController extends Controller
{
    public function index()
    {
        $basePath = public_path('uploads/images');

        $latestImages = [];

        if (File::exists($basePath)) {

            // Get all folders
            $folders = File::directories($basePath);

            // Sort folders by latest modified date
            usort($folders, function ($a, $b) {
                return filemtime($b) - filemtime($a);
            });

            foreach ($folders as $folder) {

                $images = File::files($folder);

                foreach ($images as $image) {

                    $extension = strtolower($image->getExtension());

                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {

                        $latestImages[] = asset(
                            'uploads/images/' .
                                basename($folder) . '/' .
                                $image->getFilename()
                        );
                    }

                    // Only take 2 images
                    if (count($latestImages) >= 3) {
                        break 2;
                    }
                }
            }
        }

        return view('frontend.welcome', compact('latestImages'));
    }
    public function gallery()
    {
        $basePath = public_path('uploads/images');

        $galleryFolders = [];

        if (File::exists($basePath)) {

            $folders = File::directories($basePath);

            $folderCollection = collect($folders)->map(function ($folder) {

                $folderName = basename($folder);

                try {

                    /*
                |--------------------------------------------------------------------------
                | Convert Folder Name To Real Date
                |--------------------------------------------------------------------------
                | Example:
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
        | Sort Latest To Oldest Properly
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

                $images = collect(File::files($folder))
                    ->filter(function ($file) {

                        return in_array(
                            strtolower($file->getExtension()),
                            ['jpg', 'jpeg', 'png', 'webp']
                        );
                    })
                    ->map(function ($file) use ($folderName) {

                        return asset(
                            'uploads/images/' .
                                $folderName . '/' .
                                $file->getFilename()
                        );
                    })
                    ->values()
                    ->toArray();

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
            'frontend.gallery',
            compact('galleryFolders')
        );
    }
}
