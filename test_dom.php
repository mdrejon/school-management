<?php
$html = '<!DOCTYPE html><html lang="en"><body>
<div class="simple-translate-system"></div>
<div class="wexnix_page-builder py-120">
    <div class="container" data-page-content-root="1">
        <p>Inside container</p>
    </div>
</div>
<p>Outside container</p>
</body></html>';

$dom = new \DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML('<?xml encoding="utf-8" ?>'.$html, LIBXML_NOERROR | LIBXML_NOWARNING);
libxml_clear_errors();

$body = $dom->getElementsByTagName('body')->item(0);
if ($body) {
    $xpath = new \DOMXPath($dom);
    $wrappers = $xpath->query('//div[contains(@class, "wexnix_page-builder")]');
    foreach ($wrappers as $wrapper) {
        $containers = $xpath->query('.//div[@data-page-content-root]', $wrapper);
        if ($containers->length > 0) {
            $container = $containers->item(0);
            while ($container->firstChild) {
                $wrapper->parentNode->insertBefore($container->firstChild, $wrapper);
            }
        }
        $wrapper->parentNode->removeChild($wrapper);
    }

    $rootHtml = '';
    foreach ($body->childNodes as $child) {
        if ($child instanceof \DOMElement && strpos($child->getAttribute('class'), 'simple-translate') !== false) {
            continue;
        }
        $rootHtml .= $dom->saveHTML($child);
    }
}
echo trim($rootHtml);
