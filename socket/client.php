<?php
    error_reporting(E_ALL);
    set_time_limit(0);
    while(1){
        //创建一个socket套接流
        $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

        //连接服务端的套接流，这一步就是使客户端与服务器端的套接流建立联系
        if(socket_connect($socket,'127.0.0.1', 999) == false){
            echo 'connect fail massege:'.socket_strerror(socket_last_error());
        }else{
            $message = date('Y-m-d H:i:s').'=>l love you 我爱你 socket';
            $message = mb_convert_encoding($message, 'GBK', 'UTF-8');

            if(socket_write($socket, $message, strlen($message)) == false){
                echo 'fail to write'.socket_strerror(socket_last_error());
            }else{
                echo 'client write success'.PHP_EOL;
                while($callback = socket_read($socket, 1024)){
                    echo 'server return message is:'.PHP_EOL.$callback;
                }
            }
            sleep(1);
        }
        socket_close($socket);  //工作完毕，关闭套接流
    }