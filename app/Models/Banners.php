<?php

namespace App\Models;

use App\Http\Requests\web\BannersRequest;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Banners
 * @package App\Models
 *
  * @property integer  $id
 * @property string  $image
 * @property string  $title
 * @property string  $disc

 *
 *

 *
 * @method static where(string $string, mixed $input)
 * @method static paginate(int $APP_PAGINATE)
 */
class Banners extends Model
{
    use HasFactory;
    protected $dateFormat = 'Y:m:d H:i:s';
    protected $table = "banners";
    protected $fillable = [
        'id',
		'image',
		'title',
		'disc',

    ];

    /**
     * @throws Exception
     */
    public static function createBanners(BannersRequest $request): Banners
    {
        $Banners = new self();

		$Banners->title     = $request->input('title');
		$Banners->disc      = $request->input('disc');

        if($request->file('image'))
        {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path(BANNERS_IMAGES_FOLDER), $fileName);
            $Banners->image = BANNERS_IMAGES_FOLDER.DS.$fileName;
        }


        if (!$Banners->save())
        {
            throw new Exception('create_error',APP_ERROR);
        }
        return $Banners;
    }


}

