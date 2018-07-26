<?php

namespace App\Interfaces;

interface IBannerable {
    /**
     * Get ad
     *
     * @return mixed
     */
    public function get();

    /**
     * Get dummy preview
     *
     * @return mixed
     */
    public function dummy();
}


?>