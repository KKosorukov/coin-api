<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection as BannersCollection;
use Mockery\Exception;

use App\Models\User;
use App\Models\Backoffice\ContainerType;

use Illuminate\Http\Request;

/**
 * Base model of Container
 *
 * Class Container
 * @package App\Models\Backoffice
 */

class Container extends Model
{
    protected $connection = 'mysql-backoffice';

    protected $bannersCollection = null;
    protected $width = 200;
    protected $height = 200;
    protected $currentView = null;
    protected $currentViewParams = [];

    protected $fillable = ['type_id', 'user_id', 'width', 'height', 'num_banners', 'displayed'];

    public function __construct(array $attributes = [])
    {
        $this->bannersCollection = new BannersCollection();
        parent::__construct($attributes);
    }

    /**
     * Append banner instance to container
     *
     * @param Banner $banner
     * @return Model|void
     */
    public function add(Banner $banner) {
        $this->bannersCollection::push($banner);
    }

    /**
     * Show banner collection with container
     *
     * @return mixed
     */
    public function show() {
        if(!$this->currentView) {
            throw new Exception('No view setted. Please, set a view in your container.');
        }
        return view($this->currentView, $this->currentViewParams);
    }

    /**
     * Set sizes of container
     *
     * @param int $width
     * @param int $height
     *
     * @return Container
     */
    public function setSizes($width, $height) {
        $this->width = $width;
        $this->height = $height;
        return $this;
    }

    /**
     * Set view path for container. It can be custom, as you wish
     *
     * @param $viewPath
     */
    public function setView($viewPath) {
        if(view()->exists('container/'.$viewPath)) {
            $this->currentView = 'container/' . $viewPath;
        } else {
            throw new Exception('You try to set viewPath that not available in fileSystem.');
        }
    }

    /**
     * Has only one type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function type() {
        return $this->hasOne(ContainerType::class, 'id', 'container_type_id');
    }


    /**
     * Has only one owner (webmaster)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    /**
     * Has only one form
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function form() {
        return $this->hasOne(ContainerForm::class, 'id', 'container_form_id');
    }

}