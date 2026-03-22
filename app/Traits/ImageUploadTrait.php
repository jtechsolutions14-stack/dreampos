<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait ImageUploadTrait
{
    /**
     * Upload image as WebP
     */
    public function uploadImageAsWebp(
        UploadedFile $file,
        string $directory = 'users/photos',
        int $quality = 80
    ): string {
        try {
            // Generate file name
            $fileName = Str::random(16) . '_' . time() . '.webp';

            // Init Intervention
            $manager = new ImageManager(new Driver());

            // Read image
            $image = $manager->read($file);

            // Convert to WebP
            $encoded = $image->toWebp($quality);

            // Path
            $path = trim($directory, '/') . '/' . $fileName;

            // Store directly
            Storage::disk('public')->put($path, (string) $encoded);

            return $path;

        } catch (\Throwable $e) {
            throw new \Exception('Image upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Upload with resize
     */
    public function uploadImageWithResize(
        UploadedFile $file,
        string $directory = 'users/photos',
        int $width = 800,
        int $quality = 80
    ): string {
        try {
            $fileName = Str::random(16) . '_' . time() . '.webp';

            $manager = new ImageManager(new Driver());

            $image = $manager->read($file)
                ->scale(width: $width);

            $encoded = $image->toWebp($quality);

            $path = trim($directory, '/') . '/' . $fileName;

            Storage::disk('public')->put($path, (string) $encoded);

            return $path;

        } catch (\Throwable $e) {
            throw new \Exception('Image resize upload failed: ' . $e->getMessage());
        }
    }

    /**
     * Delete image
     */
    public function deleteImage(?string $path): bool
    {
        if (!$path) return false;

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}