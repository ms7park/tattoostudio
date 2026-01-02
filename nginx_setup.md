# Nginx 설정 가이드

## 1. Nginx 설정 파일 위치

### macOS (Homebrew 설치)
- 설정 파일: `/usr/local/etc/nginx/nginx.conf`
- 서버 블록: `/usr/local/etc/nginx/servers/` 또는 `nginx.conf`에 직접 추가

### Linux
- 설정 파일: `/etc/nginx/nginx.conf`
- 서버 블록: `/etc/nginx/sites-available/` 또는 `nginx.conf`에 직접 추가

## 2. 설정 방법

### 방법 1: nginx.conf에 직접 추가
`nginx.conf`의 `http` 블록 안에 `server` 블록을 추가하거나, `include` 지시어 사용:

```nginx
http {
    # ... 기존 설정 ...
    
    include /Users/user/CursorProjects/tattoostudio/nginx.conf;
}
```

### 방법 2: sites-available/sites-enabled 사용 (Linux)
```bash
sudo cp /Users/user/CursorProjects/tattoostudio/nginx.conf /etc/nginx/sites-available/tattoostudio
sudo ln -s /etc/nginx/sites-available/tattoostudio /etc/nginx/sites-enabled/
```

## 3. PHP-FPM 설정 확인

### PHP-FPM 소켓/포트 확인
```bash
# Unix 소켓 사용 시
ls -la /usr/local/var/run/php-fpm.sock
# 또는
ls -la /var/run/php-fpm/php-fpm.sock

# TCP 포트 사용 시 (기본: 127.0.0.1:9000)
netstat -an | grep 9000
```

### PHP-FPM 설정 파일 위치
- macOS (Homebrew): `/usr/local/etc/php/7.4/php-fpm.d/www.conf`
- Linux: `/etc/php/7.4/fpm/pool.d/www.conf`

### PHP-FPM 시작/재시작
```bash
# macOS (Homebrew)
brew services start php@7.4
# 또는
php-fpm

# Linux
sudo systemctl start php7.4-fpm
sudo systemctl restart php7.4-fpm
```

## 4. Nginx 설정 테스트 및 재시작

```bash
# 설정 파일 문법 검사
sudo nginx -t

# Nginx 재시작
sudo nginx -s reload
# 또는
sudo brew services restart nginx  # macOS Homebrew
sudo systemctl restart nginx      # Linux
```

## 5. 로그 디렉토리 생성

```bash
mkdir -p /Users/user/CursorProjects/tattoostudio/logs
chmod 755 /Users/user/CursorProjects/tattoostudio/logs
```

## 6. 권한 설정

```bash
# webroot 디렉토리 권한 확인
chmod -R 755 /Users/user/CursorProjects/tattoostudio/webroot
chmod -R 777 /Users/user/CursorProjects/tattoostudio/tmp
chmod -R 777 /Users/user/CursorProjects/tattoostudio/logs
```

## 7. 방화벽 확인 (필요한 경우)

포트 80이 열려있는지 확인:
```bash
# macOS
sudo pfctl -sr | grep 80

# Linux
sudo ufw status
```

## 8. 접속 테스트

브라우저에서 `http://localhost` 또는 `http://127.0.0.1`로 접속

## 문제 해결

### 502 Bad Gateway
- PHP-FPM이 실행 중인지 확인
- `fastcgi_pass` 설정이 올바른지 확인

### 403 Forbidden
- 파일 권한 확인
- `root` 디렉토리 경로 확인

### 404 Not Found
- `root` 디렉토리가 올바른지 확인
- `try_files` 지시어 확인

