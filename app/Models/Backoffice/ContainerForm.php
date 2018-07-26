<?php

namespace App\Models\Backoffice;

use Illuminate\Database\Eloquent\Model;

/**
 * Base model of ContainerForm
 *
 * Class ContainerForm
 * @package App\Models\Backoffice
 */


class ContainerForm extends Model
{
    public $timestamps = false;

    protected $connection = 'mysql-backoffice';

    protected $fillable = ['name', 'classname'];

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
        return $this->hasMany(Container::class, 'container_form_id', 'id');
    }

    /**
     * Return a view of form
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
