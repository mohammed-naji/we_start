<?php

namespace App\Traits;

trait Trans {
    public function setNameAttribute($value)
    {
        // dd($value);
        if(request()->en_name && request()->ar_name) {
            $name = [
                'en' => request()->en_name,
                'ar' => request()->ar_name
            ];
        }else {
            $value = json_decode($value, true);
            $name = [
                'en' => $value['en'],
                'ar' => $value['ar']
            ];
        }


        $name = json_encode($name, JSON_UNESCAPED_UNICODE);

        $this->attributes['name'] = $name;
    }

    public function setSmalldescAttribute()
    {
        $smalldesc = [
            'en' => request()->en_smalldesc,
            'ar' => request()->ar_smalldesc
        ];

        $smalldesc = json_encode($smalldesc, JSON_UNESCAPED_UNICODE);

        $this->attributes['smalldesc'] = $smalldesc;
    }

    public function setDescAttribute()
    {
        $desc = [
            'en' => request()->en_desc,
            'ar' => request()->ar_desc
        ];

        $desc = json_encode($desc, JSON_UNESCAPED_UNICODE);

        $this->attributes['desc'] = $desc;
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

    // Small Desc
    public function getTransSmallAttribute()
    {
        if($this->smalldesc) {
            return json_decode( $this->smalldesc, true )[app()->getLocale()];
        }

        return $this->smalldesc;

    }

    public function getEnSmallAttribute()
    {
        if($this->smalldesc) {
            return json_decode( $this->smalldesc, true )['en'];
        }

        return $this->smalldesc;

    }

    public function getArSmallAttribute()
    {
        if($this->smalldesc) {
            return json_decode( $this->smalldesc, true )['ar'];
        }

        return $this->smalldesc;
    }

    // Description
    public function getTransDescAttribute()
    {
        if($this->desc) {
            return json_decode( $this->desc, true )[app()->getLocale()];
        }

        return $this->desc;

    }

    public function getEnDescAttribute()
    {
        if($this->desc) {
            return json_decode( $this->desc, true )['en'];
        }

        return $this->desc;

    }

    public function getArDescAttribute()
    {
        if($this->desc) {
            return json_decode( $this->desc, true )['ar'];
        }

        return $this->desc;
    }
}
