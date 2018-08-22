<?php
define('TRELLO_API_KEY', '<https://trello.com/app-key>');
define('TRELLO_API_TOKEN', '<https://trello.com/app-key>');
define('TRELLO_BOARD_ID', 'Rtrx3AdE');
define('TRELLO_LIST_AVAILABLE', '5b7b14c04c7b173ee53ff396');
define('TRELLO_LIST_AVAILABLE_NAME', 'В наличии');
define('TRELLO_LIST_UNAVAILABLE', '5b7b14c02a4ded5e6506da12');
define('TRELLO_LIST_UNAVAILABLE_NAME', 'Нет в наличии');

define('TRELLO_API_URL_CARDS', 'https://api.trello.com/1/boards/%s/cards?key=%s&token=%s');
define('TRELLO_API_URL_LISTS', 'https://api.trello.com/1/boards/%s/lists?key=%s&token=%s');

define('GENERATOR_ITEMS_PER_LIST', 8);
define('GENERATOR_PLACEHOLDER_ONE', '###REPLACEME1###');
define('GENERATOR_PLACEHOLDER_TWO', '###REPLACEME2###');
define('GENERATOR_PLACEHOLDER_HASH', '###REPLACEMEHASH###');
define('GENERATOR_ITEM_FORMAT', '<li class="list-group-item align-middle"><h2>%s</h2></li>');
//define('GENERATOR_ITEM_FORMAT', '<li class="list-group-item align-middle"><h2>%s <span class="badge %s float-right">%s</span></h2></li>');
define('GENERATOR_TEMPLATE', __DIR__.'/template.html');
//define('GENERATOR_PATH_TO_HTML', __DIR__.'/index.html');
//define('GENERATOR_PATH_TO_JSON', __DIR__.'/menu.json');
define('GENERATOR_PATH_TO_HTML', '/var/www/cafe/index.html');
define('GENERATOR_PATH_TO_JSON', '/var/www/cafe/menu.json');