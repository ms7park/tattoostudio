# PHP 7.4 설치 가이드

현재 시스템에 PHP 8.4.5가 설치되어 있습니다. PHP 7.4로 다운그레이드하려면 다음 단계를 따르세요.

## 방법 1: 자동 설치 스크립트 사용

1. Xcode 라이선스 동의 (필요한 경우):
```bash
sudo xcodebuild -license accept
```

2. 설치 스크립트 실행:
```bash
./install_php74.sh
```

## 방법 2: 수동 설치

1. Xcode 라이선스 동의:
```bash
sudo xcodebuild -license accept
```

2. Homebrew 업데이트:
```bash
brew update
```

3. PHP 7.4 저장소 추가:
```bash
brew tap shivammathur/php
```

4. PHP 7.4 설치:
```bash
brew install shivammathur/php/php@7.4
```

5. 현재 PHP 언링크:
```bash
brew unlink php
```

6. PHP 7.4 링크:
```bash
brew link --force --overwrite php@7.4
```

7. 버전 확인:
```bash
php -v
```

## PHP 버전 전환 (나중에)

PHP 8.4로 다시 전환하려면:
```bash
brew unlink php@7.4
brew link php
```

PHP 7.4로 전환하려면:
```bash
brew unlink php
brew link php@7.4
```

## 참고사항

- 설치 스크립트(`install_php74.sh`)가 프로젝트 루트에 생성되었습니다.
- Xcode 라이선스 동의는 관리자 권한이 필요합니다.
- 설치 후 `php -v`로 버전을 확인하세요.



