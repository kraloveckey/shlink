<?php
    // Get link expiry date
    function get_expiry() {
        global $config;
        return $config['expiry'];
    }
    // Get website title
    function get_title() {
        global $config;
        return $config['title'];
    }
    // Get website description
    function get_description() {
        global $config;
        return $config['description'];
    }
    // Get website hoster data
    function get_hoster() {
        global $config;
        return $config['hoster'];
    }
    // Get user IP
    function get_ip() {
        $ip = '0.0.0.0';
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if(!empty($_SERVER['HTTP_X_FORWARDED'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        } else if(!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } else if(!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if(!empty($_SERVER['HTTP_FORWARDED'])) {
            $ip = $_SERVER['HTTP_FORWARDED'];
        } else if(!empty($_SERVER['REMOTE_ADDR'])) {
            $ip= $_SERVER['REMOTE_ADDR'];
        } else if(!empty($_SERVER['HTTP_VIA'])) {
            $ip = $_SERVER['HTTP_VIA'];
        }
        return $ip;
    }
    // Get user agent
    function get_ua() {
        $ua = 'N/A';
        if(!empty($_SERVER['HTTP_USER_AGENT'])) $ua = $_SERVER['HTTP_USER_AGENT'];
        return $ua;
    }
    // Get uri data
    function get_uri() {
        global $config;
        //  Get transport protocol
        $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        // Get domain name
        $url .= $_SERVER['HTTP_HOST'];
        // Get the route (path) of program installation
        $url .= $config['path'];
        if(substr($url, strlen($url) - 1) != '/') $url .= '/';
        // return value
        return $url;
    }
?>