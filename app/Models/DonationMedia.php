<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class DonationMedia extends Model
{
    use HasFactory;

    protected $table = 'donations_media';

    protected $fillable = [
        'donation_id',
        'media',
        'last_modified_by',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public static function imageWatermark($imagePath, $text)
    {
        $image = Image::make($imagePath);
        $watermark = Image::make(public_path('images/branding/roshni-foundation-watermark.png'));
        $image->insert($watermark, 'bottom-right', 10, 10);
        $image->text($text, 10, $image->height()-10, function ($font) {
            $font->file(public_path('fonts/Roboto-Bold.ttf'));
            $font->size(7);
            $font->color('#ffffff');
        });
        $image->save($imagePath);
    }

    public static function videoWatermark($videoPath)
    {
        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($videoPath);
        $video->addWatermark(function (WatermarkFactory $watermark) {
            $watermark->open(public_path('images/branding/roshni-foundation-watermark.png'))
                ->horizontalAlignment(WatermarkFactory::RIGHT, 10)
                ->verticalAlignment(WatermarkFactory::BOTTOM, 10);
        });
        $video->save($videoPath);
    }
    
}
