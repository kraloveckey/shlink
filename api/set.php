<?php
    // Initial class
    require_once('../inc/require.php');
    global $config;
    $url_c = new url();

    $opt = [];
    $opt['success'] = 'false';

    $request_arr = json_decode(file_get_contents('php://input'), true);
    if(isset($request_arr['url'])) {
        // Add HTTP protocol prefix
        if(!strstr($request_arr['url'], 'http://') && !strstr($request_arr['url'], 'https:')) $request_arr['url'] = 'http://' . $request_arr['url'];
        // Detecting the correct format of a web address
        $is_link = preg_match('(http(|s)://([\w-]+\.)+[\w-]+(/)?)', $request_arr['url']);
        // Judgment condition
        if($request_arr['url'] != '' && !strstr($request_arr['url'], $_SERVER['HTTP_HOST']) && $is_link) {
            $opt['success'] = 'true';
            $opt['content']['url'] = $url_c->set_url($request_arr['url'], $config['length']);
        } else if(strstr($request_arr['url'], $_SERVER['HTTP_HOST'])) {
            $opt['content'] = 'The link is already a short URL.';
        } else if(!$is_link) {
            $opt['content'] = 'Please, enter the URL in the correct format.';
        }
    } else {
        $opt['content'] = 'The call parameter cannot be empty.';
    }
    // Exports
    echo json_encode($opt);
?>