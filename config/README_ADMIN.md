# 관리자 계정 생성 가이드

## 관리자 계정 정보
- **사용자명**: ms7park
- **비밀번호**: malsim
- **역할**: admin

## 계정 생성 방법

### 방법 1: SQL 파일 실행 (권장)

MySQL에 접속하여 SQL 파일을 실행하세요:

```bash
mysql -h bunyang2.godohosting.com -u bunyang2 -p bunyang2_godohosting_com < config/insert_admin.sql
```

또는 MySQL 콘솔에서:

```sql
USE bunyang2_godohosting_com;
SOURCE /Users/user/CursorProjects/tattoostudio/config/insert_admin.sql;
```

### 방법 2: 직접 SQL 실행

MySQL 콘솔에서 다음 SQL을 실행하세요:

```sql
USE bunyang2_godohosting_com;

INSERT INTO users (username, password, role, created, modified) 
VALUES (
    'ms7park', 
    '$2y$10$JVLfoFxduzZSHHQs0KO0Pe/52jkjMrCYdUFHwq9V5lJls91a39ksW',
    'admin',
    NOW(),
    NOW()
)
ON DUPLICATE KEY UPDATE 
    password = '$2y$10$JVLfoFxduzZSHHQs0KO0Pe/52jkjMrCYdUFHwq9V5lJls91a39ksW',
    role = 'admin',
    modified = NOW();
```

### 방법 3: PHP 스크립트 사용 (로컬에서만 가능)

로컬 데이터베이스에 연결할 수 있는 경우:

```bash
php config/create_admin.php ms7park malsim
```

## 로그인

1. 브라우저에서 `http://localhost:8000/login` 접속
2. 사용자명: `ms7park`
3. 비밀번호: `malsim`
4. 로그인 후 "업로드" 메뉴가 표시됩니다.

## 참고사항

- 비밀번호는 `password_hash()` 함수로 해시화되어 저장됩니다.
- 기존 사용자가 있으면 비밀번호와 역할이 업데이트됩니다.
- `ON DUPLICATE KEY UPDATE`를 사용하여 중복 생성 시 업데이트됩니다.


