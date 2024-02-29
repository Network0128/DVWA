<< 아래 코드 요약 >> 
기능:
사용자가 입력한 IP 주소에 대한 ping 명령어를 실행하고 결과를 출력합니다.
Windows와 *nix 운영 체제를 모두 지원합니다.

주요 특징:
$_REQUEST['ip'] 변수를 사용하여 사용자 입력 IP 주소를 받아옵니다.
stristr() 함수를 사용하여 운영 체제를 구분합니다.
shell_exec() 함수를 사용하여 ping 명령어를 실행합니다.
pre 태그를 사용하여 ping 명령어 실행 결과를 출력합니다.

주의 사항:
shell_exec() 함수는 임의의 명령어를 실행할 수 있기 때문에 위험할 수 있습니다.
사용자 입력값을 제대로 검증하지 않으면 공격자가 임의의 명령어를 실행하도록 유도할 수 있습니다.
이 코드는 교육 목적으로만 사용해야 합니다.

개선점:
사용자 입력값을 검증하여 유효한 IP 주소인지 확인해야 합니다.
shell_exec() 함수 대신에 exec() 함수를 사용하는 것이 더 안전합니다.

<?php

// "Submit" 버튼이 눌렸는지 확인
if( isset( $_POST[ 'Submit' ] ) ) {

  // 입력값 가져오기
  $target = $_REQUEST[ 'ip' ];  // 사용자로부터 입력받은 IP 주소를 저장함

  // 운영 체제에 따라 ping 명령어 실행
  if( stristr( php_uname( 's' ), 'Windows NT' ) ) {
    // Windows 운영 체제인 경우
    $cmd = shell_exec( 'ping ' . $target );  // Windows 환경에서 ping 명령어 실행
  }
  else {
    // *nix (Linux, macOS 등) 운영 체제인 경우
    $cmd = shell_exec( 'ping -c 4 ' . $target );  // *nix 환경에서 ping 명령어 실행 (4번 제한)
  }

  // 결과 출력
  echo "<pre>{$cmd}</pre>";  // ping 명령어 실행 결과를 pre 태그로 감싸서 그대로 출력
}

?>
