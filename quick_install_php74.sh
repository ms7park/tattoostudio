#!/bin/bash
# 빠른 PHP 7.4 설치 (Xcode 라이선스 동의 후 실행)

echo "PHP 7.4 설치를 시작합니다..."

# Homebrew 업데이트
brew update

# PHP 7.4 저장소 추가
brew tap shivammathur/php

# PHP 7.4 설치
brew install shivammathur/php/php@7.4

# 현재 PHP 언링크
brew unlink php 2>/dev/null || true

# PHP 7.4 링크
brew link --force --overwrite php@7.4

# 버전 확인
echo ""
echo "설치 완료! PHP 버전:"
php -v
