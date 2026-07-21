<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Homepage section designs
    |--------------------------------------------------------------------------
    |
    | Each key is a homepage section; the value is which design variant to
    | render, matching a file in resources/views/frontend/sections/{section}/
    | e.g. 'slider-v1' -> frontend.sections.slider.slider-v1. Add a new
    | variant by dropping in a new {section}-vN.blade.php file and pointing
    | this at it — no other template changes needed.
    |
    */

    'sections' => [
        'slider' => 'slider-v1',
        'institute_info' => 'institute-info-v1',
        'counter' => 'counter-v1',
        'partner' => 'partner-v1',
        'video' => 'video-v1',
        'offer' => 'offer-v1',
        'choose' => 'choose-v1',
        'skill' => 'skill-v1',
        'about' => 'about-v1',
        'course' => 'course-v1',
        'teacher' => 'teacher-v1',
        'gallery' => 'gallery-v1',
        'event' => 'event-v1',
        'department' => 'department-v1',
    ],

];
