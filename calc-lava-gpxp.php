<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 18/05/2016
 * Time: 1:01 PM
 */
$binding_neck_price = getItemPrice('5521');
$amt_of_ess_per_invent = 43;
$astral_rune_price = getItemPrice('9075');
$earth_rune_price = getItemPrice('557');
$pure_ess_price = getItemPrice('7936');
$duel_ring_price = getItemPrice('2552');
$xp_per_inventory;
$cost_per_inventory;
$xp_per_craft = 10.5;
$gp_per_xp;
set_time_limit(120);

function calcGpXp() {
    $GLOBALS['cost_per_inventory'] = (($GLOBALS['binding_neck_price'] / 7) * 2) +
                                        ($GLOBALS['amt_of_ess_per_invent'] * $GLOBALS['earth_rune_price']) +
                                        ($GLOBALS['amt_of_ess_per_invent'] * $GLOBALS['pure_ess_price']) +
                                        ($GLOBALS['astral_rune_price'] * 2) +
                                        (($GLOBALS['duel_ring_price'] / 8) * 2);
    $GLOBALS['xp_per_inventory'] = ($GLOBALS['amt_of_ess_per_invent'] * $GLOBALS['xp_per_craft']);
    $GLOBALS['gp_per_xp'] = ($GLOBALS['cost_per_inventory'] / $GLOBALS['xp_per_inventory']);
}

function getItemPrice($itemID) {

    // Curl retrieves JSON string of the item ID using the public API
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, 'http://services.runescape.com/m=itemdb_oldschool/api/catalogue/detail.json?item='.$itemID);
    $result = curl_exec($ch);
    curl_close($ch);

    $obj = json_decode($result, true);

    return $obj['item']['current']['price'];
}
?>