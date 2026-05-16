<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
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
                    if (count($latestImages) >= 2) {
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

            // Latest folders first
            usort($folders, function ($a, $b) {
                return filemtime($b) - filemtime($a);
            });

            foreach ($folders as $folder) {

                $folderName = basename($folder);

                $images = [];

                foreach (File::files($folder) as $file) {

                    $extension = strtolower($file->getExtension());

                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {

                        $images[] = asset(
                            'uploads/images/' .
                                $folderName . '/' .
                                $file->getFilename()
                        );
                    }
                }

                if (!empty($images)) {

                    $galleryFolders[] = [
                        'date' => $folderName,
                        'slug' => \Illuminate\Support\Str::slug($folderName),
                        'images' => $images
                    ];
                }
            }
        }

        return view('frontend.gallery', compact('galleryFolders'));
    }
}
