<?php


namespace App\Traits;

use App\Library\ImageTool;
use Illuminate\Support\Facades\Storage;


trait CroppedImage
{
  /**
   * Get Cropped Image
   * @param $image string
   * @param $dimensions array
   */
  public function getCroppedImage($image, $dimensions)
  {

      list($height, $width) = $dimensions;
      if (!empty($image) && Storage::exists($image)) {
          return ImageTool::mycrop($image, $height, $width);
      }
      return ImageTool::mycrop('default_image/no-image.png', $height, $width);
  }
}
