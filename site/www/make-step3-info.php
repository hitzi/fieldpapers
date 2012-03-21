<?php

    require_once '../lib/lib.everything.php';
    
    enforce_master_on_off_switch($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    
    $context = default_context();
    
    /**** ... ****/
    
    $forms = get_forms($context->db, $context->user['id'], get_pagination(8));
    
    $context->sm->assign('forms', $forms);
    
    $atlas_data = array(
        'page_zoom' => sprintf('%d', $_POST['page_zoom']),
        'paper_size' => $_POST['paper_size'],
        'orientation' => $_POST['orientation'],
        'provider' => $_POST['provider'],
        'pages' => (is_array($_POST['pages']) ? $_POST['pages'] : array())
        );

    $context->sm->assign('atlas_data', $atlas_data);
    
    if($context->type == 'text/html') {
        header("Content-Type: text/html; charset=UTF-8");
        print $context->sm->fetch("make-step3-info.html.tpl");
    
    } else {
        header('HTTP/1.1 400');
        die("Unknown type.\n");
    }

?>