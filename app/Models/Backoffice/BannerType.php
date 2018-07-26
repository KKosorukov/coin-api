<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

/**
 * Base model of BannerType
 *
 * Class BannerType
 * @package App\Models\Backoffice
 */


class BannerType extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql-backoffice';

    protected $fillable = ['width', 'height'];

    protected $hidden = ['id'];

    protected $view = 'insert-your-view-here';

    protected $container = null;

    protected $banner = null;

    protected $viewParams = [];

    public function __construct($container = null, $banner = null, array $attributes = [])
    {
        if($container) {
            $this->container = $container;
            $this->viewParams += [
                'container' => $this->container
            ];
        }

        if($banner) {
            $this->banner = $banner;
            $this->viewParams += [
                'banner' => $this->banner
            ];
        }

        parent::__construct($attributes);
    }

    /**
     * Has many containers
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function containers() {
        return $this->belongsToMany('App\Models\Backoffice\Container', 'containers-banner_types', 'banner_type_id', 'container_id');
    }

    /**
     * Return a view of type
     *
     * @return mixed
     */
    public function getView() {
        return $this->view;
    }

    /**
     * Get rendered view
     *
     * @param $additionalParams
     * @return string
     * @throws \Throwable
     */
    public function getRenderedView($additionalParams = []) {
        return view($this->view, $this->viewParams + $additionalParams)->render();
    }
}
