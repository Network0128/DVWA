아래 PHP 코드는 DVWA(Damn Vulnerable Web Application)의 낮은 보안 수준 설정에서 찾을 수 있는 SQL 인젝션 취약점의 예시입니다. 
이 취약점은 사용자 입력을 적절히 검증하거나 이스케이프 처리하지 않음으로써 발생합니다.

<?php
// PHP 스크립트의 시작입니다.

if( isset( $_REQUEST[ 'Submit' ] ) ) {
    // 사용자가 폼을 제출했는지 확인합니다.
    // 폼 제출 여부는 'Submit' 버튼의 존재로 판단합니다.

    $id = $_REQUEST[ 'id' ];
    // 사용자로부터 받은 'id' 파라미터 값을 $id 변수에 저장합니다.
    // 이 부분은 SQL 인젝션 공격에 취약합니다. 사용자 입력을 그대로 쿼리에 사용하기 때문입니다.

    $query  = "SELECT first_name, last_name FROM users WHERE user_id = '$id';";
    // 사용자의 'id' 값을 포함해 SQL 쿼리를 구성합니다.
    // 이 쿼리는 사용자가 제공한 'id' 값에 해당하는 사용자의 이름을 조회합니다.
    // SQL 인젝션 취약점이 있는 부분입니다. 사용자 입력을 직접 쿼리에 삽입하므로, 악의적인 쿼리 조작이 가능합니다.

    $result = mysqli_query($GLOBALS["___mysqli_ston"],  $query ) or die( '<pre>' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)) . '</pre>' );
    // 위에서 생성한 SQL 쿼리를 데이터베이스에 전송하고 결과를 받습니다.
    // 쿼리 실행에 실패하면 오류 메시지를 출력하고 스크립트를 종료합니다.

    while( $row = mysqli_fetch_assoc( $result ) ) {
        // 쿼리의 결과를 한 줄씩 읽어옵니다.
        // 결과는 연관 배열 형태로 반환됩니다.

        $first = $row["first_name"];
        $last  = $row["last_name"];
        // 결과 배열에서 'first_name'과 'last_name' 값을 추출하여 변수에 저장합니다.

        echo "<pre>ID: {$id}<br />First name: {$first}<br />Surname: {$last}</pre>";
        // 사용자에게 결과를 출력합니다.
        // 출력은 사용자의 ID, 이름, 성을 포함합니다.
    }

    mysqli_close($GLOBALS["___mysqli_ston"]);
    // 데이터베이스 연결을 종료합니다.
}

?>
// PHP 스크립트의 끝입니다.


이 코드는 악의적인 사용자가 예상치 못한 SQL 명령을 데이터베이스에 주입할 수 있게 해서, 데이터베이스의 내용을 읽거나, 수정, 삭제할 수 있는 SQL 인젝션 취약점을 드러냅니다.
예를 들어, 사용자 입력으로 0 OR 1=1와 같은 값을 제공함으로써, 공격자는 모든 사용자의 정보를 조회할 수 있습니다. 
이러한 취약점을 방지하기 위해, 사용자 입력을 적절히 검증하고, 가능한 경우 준비된 문장(Prepared Statements) 및 파라미터화된 쿼리를 사용해야 합니다
