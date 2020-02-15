<?php
	//修改2020-02-15
    error_reporting(E_ALL);
    set_time_limit(0);

    $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

    socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);//1表示接受所有的数据包

    if(socket_bind($socket, '127.0.0.1', 11511) == false){
        echo 'server bind fail:'.socket_strerror(socket_last_error());
    }
    if(socket_listen($socket, 4) == false){
        echo 'server listen fail:'.socket_strerror(socket_last_error());
    }

    while(true){
        $accept_resource = socket_accept($socket);
        if($accept_resource !== false){
            $string = socket_read($accept_resource, 1024);

            $return_client = date('Y-m-d H:i:s')."=>".$string.PHP_EOL;
            // echo $return_client;
            if($string != false){
                socket_write($accept_resource, $return_client, strlen($return_client));
            }else{
                echo 'socket_read is fail';
            }
            socket_close($accept_resource);
        }
    }
    socket_close($socket);