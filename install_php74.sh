#!/bin/bash

# PHP 7.4 설치 및 전환 스크립트

echo "=========================================="
echo "PHP 7.4 설치 스크립트"
echo "=========================================="
echo ""

# Xcode 라이선스 확인
echo "1. Xcode 라이선스 확인 중..."
if ! xcodebuild -license check 2>/dev/null; then
    echo ""
    echo "⚠️  Xcode 라이선스 동의가 필요합니다."
    echo ""
    echo "터미널에서 다음 명령어를 실행하세요:"
    echo "   sudo xcodebuild -license accept"
    echo ""
    echo "비밀번호를 입력하고 라이선스에 동의한 후,"
    echo "이 스크립트를 다시 실행하세요."
    echo ""
    exit 1
fi

echo "✅ Xcode 라이선스 확인 완료"
echo ""

# Homebrew 업데이트
echo "Homebrew를 업데이트합니다..."
brew update

# PHP 7.4 저장소 추가
echo "PHP 7.4 저장소를 추가합니다..."
brew tap shivammathur/php

# PHP 7.4 설치
echo "PHP 7.4를 설치합니다..."
brew install shivammathur/php/php@7.4

# 현재 PHP 버전 언링크
echo "현재 PHP 버전을 언링크합니다..."
brew unlink php 2>/dev/null || true

# PHP 7.4 링크
echo "PHP 7.4를 링크합니다..."
brew link --force --overwrite php@7.4

# PHP 버전 확인
echo ""
echo "설치 완료! PHP 버전을 확인합니다:"
php -v

echo ""
echo "PHP 7.4 설치가 완료되었습니다!"

