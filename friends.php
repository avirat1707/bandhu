<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
    $friend_list=array(
        0=>array(
            'name'=>'Tirth Bodawala',
            'src'=>NULL,
            'id'=>'0'
        ),
        1=>array(
            'name'=>'Kirtan Bodawala',
            'src'=>NULL,
            'id'=>'1'
        ),
        2=>array(
            'name'=>'Aashka Bodawala',
            'src'=>NULL,
            'id'=>'2'
        ),
        3=>array(
            'name'=>'Darshan Bodawala',
            'src'=>NULL,
            'id'=>'3'
        ),
        4=>array(
            'name'=>'Jay Shah',
            'src'=>NULL,
            'id'=>'4'
        ),
        5=>array(
            'name'=>'Kinnari Shah',
            'src'=>NULL,
            'id'=>'5'
        ),
        6=>array(
            'name'=>'Maitri Shah',
            'src'=>NULL,
            'id'=>'6'
        ),
        7=>array(
            'name'=>'Helli Badami',
            'src'=>NULL,
            'id'=>'7'
        ),
        8=>array(
            'name'=>'Purvi Shah',
            'src'=>NULL,
            'id'=>'8'
        ),
        9=>array(
            'name'=>'Shaishav Shah',
            'src'=>NULL,
            'id'=>'9'
        ),
        10=>array(
            'name'=>'Grishma Shah',
            'src'=>NULL,
            'id'=>'10'
        )
    );
    header("Pragma: no-cache");
    header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");
    header('Content-Type: text/x-json');
    header("X-JSON: ".json_encode($friend_list));
    echo json_encode($friend_list);
    die;
?>
