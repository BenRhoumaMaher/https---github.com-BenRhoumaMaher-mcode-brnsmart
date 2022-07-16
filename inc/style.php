<?php

/**
 * Rishi Dynamic Styles
 * 
 * @package Rishi
 */

function RT_Dynamic_CSS(){


    echo "<style type='text/css' media='all'>"; ?>

    <!-- Dynamic Arrow of the Whole Theme -->

    <?php
    echo "</style>";
}
add_action('wp_head', 'RT_Dynamic_CSS', 101);