<?php

namespace App\Traits;

trait Trans {
    public function setNameAttribute()
    {
        $name = [
            'en' => request()->en_name,
            'ar' => request()->ar_name
        ];

        $name = json_encode($name, JSON_UNESCAPED_UNICODE);

        $this->attributes['name'] = $name;
    }

    public function getTransNameAttribute()
    {
        if($this->name) {
            return json_decode( $this->name, true )[app()->getLocale()];
        }

        return $this->name;

    }

    public function getEnNameAttribute()
    {
        if($this->name) {
            return json_decode( $this->name, true )['en'];
        }

        return $this->name;

    }

    public function getArNameAttribute()
    {
        if($this->name) {
            return json_decode( $this->name, true )['ar'];
        }

        return $this->name;
    }
}
