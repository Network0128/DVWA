<?php

// 로그인 버튼이 눌렸는지 확인
if( isset( $_GET[ 'Login' ] ) ) {

    // 사용자 이름 입력값 보안 처리
    $user = $_GET[ 'username' ];  // 사용자 이름 입력값 가져오기
    $user = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $user);  // SQL 인젝션 공격 방지를 위해 특수문자 처리

    // 비밀번호 입력값 보안 처리
    $pass = $_GET[ 'password' ];  // 비밀번호 입력값 가져오기
    $pass = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $pass);  // SQL 인젝션 공격 방지를 위해 특수문자 처리
    $pass = md5( $pass );  // 비밀번호 암호화 (MD5 사용)

    // 데이터베이스 조회
    $query  = "SELECT * FROM `users` WHERE user = '$user' AND password = '$pass';";  // 사용자 정보 조회 SQL 쿼리
    $result = mysqli_query($GLOBALS["___mysqli_ston"], $query) or die(mysqli_error($GLOBALS["___mysqli_ston"]));  // 쿼리 실행 및 오류 발생 시 메시지 출력

    // 로그인 성공 시
    if( $result && mysqli_num_rows( $result ) == 1 ) {
        $row    = mysqli_fetch_assoc( $result );  // 사용자 정보 가져오기
        $avatar = $row["avatar"];  // 사용자 아바타 경로 가져오기

        // 환영 메시지와 아바타 출력
        echo "<p>Welcome to the password protected area {$user}</p>";
        echo "<img src=\"{$avatar}\" />";
    }
    // 로그인 실패 시
    else {
        sleep( 2 );  // 2초 대기
        echo "<pre><br />Username and/or password incorrect.</pre>";  // 오류 메시지 출력
    }

    // 데이터베이스 연결 종료
    mysqli_close($GLOBALS["___mysqli_ston"]);
}

?>

