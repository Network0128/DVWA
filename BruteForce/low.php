<?php

if( isset( $_GET[ 'Login' ] ) ) { // 'Login' GET 요청이 있는지 확인
    $user = $_GET[ 'username' ]; // 사용자로부터 입력받은 아이디를 가져옴

    $pass = $_GET[ 'password' ]; // 사용자로부터 입력받은 비밀번호를 가져옴
    $pass = md5( $pass ); // 비밀번호를 md5로 해시화

    // 데이터베이스에 쿼리를 보내 사용자의 아이디와 비밀번호가 일치하는지 확인
    $query  = "SELECT * FROM `users` WHERE user = '$user' AND password = '$pass';";
    $result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );

    if( $result && mysqli_num_rows( $result ) == 1 ) { // 쿼리의 결과가 있고, 그 결과의 행 수가 1이라면 로그인에 성공
        $row    = mysqli_fetch_assoc( $result ); // 사용자의 정보를 가져옴
        $avatar = $row["avatar"]; // 사용자의 아바타 이미지를 가져옴

        echo "<p>Welcome to the password protected area {$user}</p>"; // 환영 메시지 출력
        echo "<img src=\"{$avatar}\" />"; // 사용자의 아바타 이미지 출력
    }
    else { // 쿼리의 결과가 없거나, 결과의 행 수가 1이 아니라면 로그인에 실패
        echo "<pre><br />Username and/or password incorrect.</pre>"; // 실패 메시지 출력
    }

    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res); // 데이터베이스 연결 종료
}

?>
