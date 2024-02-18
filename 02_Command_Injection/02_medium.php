이 스크립트는 웹 양식을 통해 사용자 입력을 받아 해당 IP 주소로 ping 테스트를 수행하고 결과를 웹 페이지에 출력합니다. 
보안상의 이유로, 입력된 값에서 특정 문자(&&, ;)를 제거하는 단계를 포함하고 있습니다. 
이는 주입 공격(injection attacks)을 방지하기 위한 조치입니다.

<?php

if( isset( $_POST[ 'Submit' ]  ) ) { // 'Submit' 버튼이 눌렸는지 확인
    // 입력 받기
    $target = $_REQUEST[ 'ip' ]; // 사용자로부터 입력 받은 'ip' 값을 변수에 저장

    // 블랙리스트 설정
    $substitutions = array(
        '&&' => '', // '&&' 문자 제거
        ';'  => '', // ';' 문자 제거
    );

    // 배열(블랙리스트)에 있는 문자들을 제거
    $target = str_replace( array_keys( $substitutions ), $substitutions, $target );

    // 운영 체제 확인 후 ping 명령 실행
    if( stristr( php_uname( 's' ), 'Windows NT' ) ) { // 현재 서버의 운영 체제가 Windows NT인지 확인
        // Windows 용 명령
        $cmd = shell_exec( 'ping  ' . $target ); // Windows에서의 ping 명령 실행
    }
    else {
        // *nix (Linux나 Unix 같은) 용 명령
        $cmd = shell_exec( 'ping  -c 4 ' . $target ); // *nix에서의 ping 명령 실행, '-c 4'는 4번 핑을 의미
    }

    // 최종 사용자에게 결과 피드백
    echo "<pre>{$cmd}</pre>"; // 명령의 실행 결과를 보기 좋게 표시
}

?>
