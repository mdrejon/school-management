<?php

namespace App\Helpers;

class HtmlHelper
{
    /**
     * Parse HTML content and inject loading="lazy" for all images, 
     * except the first one which gets fetchpriority="high" and loading="eager".
     */
    public static function optimizeImages(?string $html): ?string
    {
        if (empty($html)) {
            return $html;
        }

        $count = 0;
        return preg_replace_callback('/<img\s+[^>]*>/i', function ($matches) use (&$count) {
            $img = $matches[0];
            $count++;

            // Remove any existing loading or fetchpriority attributes
            $img = preg_replace('/\s+loading=[\'"][^\'"]*[\'"]/i', '', $img);
            $img = preg_replace('/\s+fetchpriority=[\'"][^\'"]*[\'"]/i', '', $img);

            // Avoid duplicating spaces before the closing > or />
            $img = preg_replace('/\s*\/?>$/', '', $img);

            if ($count === 1) {
                // First image is eager
                return $img . ' fetchpriority="high" loading="eager" />';
            } else {
                // Subsequent images are lazy
                return $img . ' loading="lazy" />';
            }
        }, $html);
    }
}
