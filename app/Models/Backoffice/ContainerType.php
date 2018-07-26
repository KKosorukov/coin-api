<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;
use Mockery\Exception;

/**
 * Base model of ContainerType
 *
 * Class ContainerType
 * @package App\Models\Backoffice
 */

class ContainerType extends Model
{
    protected $table = 'container_types';

    protected $connection = 'mysql-backoffice';

    protected $fillable = ['name', 'min_width', 'min_height', 'max_width', 'max_height', 'classname'];

    protected $hidden = ['id'];

    protected $view = 'insert-your-view-here';

    protected $container = null;

    protected $viewParams = [];

    public function __construct($container = null, array $attributes = [])
    {
        if($container) {
            $this->container = $container;
            $this->viewParams += [
                'container' => $container
            ];
        }

        parent::__construct($attributes);
    }

    /**
     * Has many containers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function containers() {
        return $this->hasMany(Container::class, 'container_type_id', 'id');
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
    public function getRenderedView($additionalParams) {
        return view($this->view, $this->viewParams + $additionalParams)->render();
    }

}