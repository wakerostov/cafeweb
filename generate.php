#!/usr/bin/env php
<?php
require_once __DIR__.'/config.php';

$cards = get(TRELLO_API_URL_CARDS);

$list_available_id = TRELLO_LIST_AVAILABLE;
$list_unavailable_id = TRELLO_LIST_UNAVAILABLE;
// Avoid breakage if someone decide to remove and create list anew
// One extra API call if list of available items is empty
if(!validateLists($cards))
{
    $lists = get(TRELLO_API_URL_LISTS);
    foreach($lists as $list)
    {
        if(false !== strpos($list['name'], TRELLO_LIST_AVAILABLE_NAME))
        {
            $list_available_id = $list['id'];
        }
        else if(false !== strpos($list['name'], TRELLO_LIST_UNAVAILABLE_NAME))
        {
            $list_unavailable_id = $list['id'];
        }
    }
}

$itemsleft = $itemsright = array();
foreach($cards as $card)
{
    $available = $card['idList'] === $list_available_id;
    if(false === $available)
    {
        continue;
    }
    $badge = $available ? 'badge-success' : 'badge-danger';
    $status = $available ? TRELLO_LIST_AVAILABLE_NAME : TRELLO_LIST_UNAVAILABLE_NAME;
    if(sizeof($itemsleft) < GENERATOR_ITEMS_PER_LIST)
    {
        $itemsleft[] = sprintf(GENERATOR_ITEM_FORMAT, $card['name']);//, $badge, $status);
    }
    elseif(sizeof($itemsright) < GENERATOR_ITEMS_PER_LIST)
    {
        $itemsright[] = sprintf(GENERATOR_ITEM_FORMAT, $card['name']);//, $badge, $status);
    }
}
$html = file_get_contents(GENERATOR_TEMPLATE);
$output = str_replace(GENERATOR_PLACEHOLDER_ONE, implode('', $itemsleft), $html);
$output = str_replace(GENERATOR_PLACEHOLDER_TWO, implode('', $itemsright), $output);
$data_hash = hash('sha256', implode(array_merge($itemsleft, $itemsright)));
$output = str_replace(GENERATOR_PLACEHOLDER_HASH, $data_hash, $output);
file_put_contents(GENERATOR_PATH_TO_HTML, $output);
file_put_contents(GENERATOR_PATH_TO_JSON, json_encode(array(
    'menuDataHash' => $data_hash,
    'itemsleft' => $itemsleft,
    'itemsright' => $itemsright,
)));


function get($url)
{
    $content = file_get_contents(sprintf($url, TRELLO_BOARD_ID, TRELLO_API_KEY, TRELLO_API_TOKEN));
    if($content === false)
    {
        return false;
    }
    else
    {
        return json_decode($content, true);
    }
}

function validateLists($cards)
{
    foreach($cards as $card)
    {
        if($card['idList'] === TRELLO_LIST_AVAILABLE)
        {
            return true;
        }
    }
    return false;
}