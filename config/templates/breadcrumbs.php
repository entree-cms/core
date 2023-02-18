<?php
$homeIcon = '<li class="text-secondary me-2"><i class="fa-solid fa-house"></i></li>';
return [
    'wrapper' => '<nav aria-label="breadcrumb"{{attrs}}>'
        . '<ol class="breadcrumb small m-0 py-1">'
        . $homeIcon
        . '{{content}}'
        . '</ol>'
        . '</nav>',
    'item' => '<li class="breadcrumb-item"{{attrs}}><a href="{{url}}"{{innerAttrs}}>{{title}}</a></li>',
    'itemWithoutLink' => '<li class="breadcrumb-item active"{{attrs}}>{{title}}</li>',
    'separator' => '',
];
