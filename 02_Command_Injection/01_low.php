<?php

// 코드 설명

/**
 * ping 명령어를 실행하고 결과를 출력합니다.
 *
 * @param string $target 대상 IP 주소
 *
 * @return string ping 명령어 실행 결과
 */
function ping( $target ) {

  // 사용자 입력값을 검증합니다.
  if( !filter_var( $target, FILTER_VALIDATE_IP ) ) {
    throw new InvalidArgumentException( '유효한 IP 주소를 입력하세요.' );
  }

  // 운영 체제 정보를 가져옵니다.
  $os = php_uname( 's' );

  // 운영 체제에 따라 ping 명령어를 구성합니다.
  $cmd = '';
  if( stristr( $os, 'Windows NT' ) ) {
    // Windows
    $cmd = 'ping ' . $target;
  }
  else {
    // *nix (Linux, macOS 등)
    $cmd = 'ping -c 4 ' . $target;
  }

  // ping 명령어를 실행하고 결과를 저장합니다.
  $output = shell_exec( $cmd );

  // ping 명령어 실행 결과를 반환합니다.
  return $output;
}

// 주의 사항

* 이 코드는 교육 목적으로만 사용해야 합니다.
* 실제 환경에서 사용하기 전에 보안 취약점을 확인하고 필요한 조치를 취해야 합니다.
* `shell_exec()` 함수는 임의의 명령어를 실행할 수 있기 때문에 위험할 수 있습니다.
* 사용자 입력값을 제대로 검증하지 않으면 공격자가 임의의 명령어를 실행하도록 유도할 수 있습니다.
* 코드를 사용하기 전에 보안 전문가의 도움을 받는 것이 좋습니다.

// 코드 예시

$target = '127.0.0.1';
$output = ping( $target );

echo "<pre>{$output}</pre>";

?>
