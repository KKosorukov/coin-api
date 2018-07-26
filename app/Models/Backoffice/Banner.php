<?php

namespace App\Models\Backoffice;

use App\Http\Resources\AdvResource;
use Illuminate\Database\Eloquent\Model;

use App\Models\Backoffice\Adv;
use App\Models\User;

use App\Components\RandomGenerator;

class Banner extends Model
{
    protected $connection = 'mysql-backoffice';

    const DUMMY_PATH = '/banners/dummy/';

    protected $fillable = ['adv_id', 'title', 'description', 'path', 'user_id'];
    protected $hidden = ['id'];
    protected $typeId; // It's a banner typeId
    protected $randomGenerator; // This is random generator
    protected $bannerFileName; // Filename for random banner
    protected $config; // Config of banner
    protected $behavior; // Behavior of banner

    public function __construct(array $attributes = [])
    {
        $this->typeId = static::who();
        $this->randomGenerator = new RandomGenerator();
        $this->config = $attributes;
        parent::__construct($attributes);
    }

    /**
     * Get className
     */
    public static function who() {
        return __CLASS__;
    }

    /**
     * Get banners by adv id
     *
     * @return void
     */
    public function get() {
        $this->setBannerFileName();
    }


    // @TODO Get banners by advId from base
    protected function setBannerFileName($fileName = null) {
        if(!$fileName) {
            $this->bannerFileName = $this->randomGenerator->getRandomNumber();
        } else {
            $this->bannerFileName = $fileName;
        }
    }


    /**
     * All banners have only one advertising
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function adv() {
        return $this->hasOne(Adv::class, 'id', 'adv_id');
    }

    /**
     * All banners have only one user
     * return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
