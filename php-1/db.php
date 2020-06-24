<?php
try {
    $db = new pg_connect("host=ec2-52-20-248-222.compute-1.amazonaws.com
    dbname=d7rkf9790j3egb
    user=cejojxfajmmyap password=a62e673ef0b49b2198fecabd5226a08c40303d834cb8b51c9de1b341580cab13");
    return $db;
}catch (Exception $e){
    echo "Kết nối ko thành công";
}
