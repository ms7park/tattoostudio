-- 관리자 계정 생성 SQL
-- 사용자명: ms7park
-- 비밀번호: malsim
-- 역할: admin

-- 비밀번호를 해시화하여 삽입
-- PHP의 password_hash() 함수로 생성된 해시를 사용하거나
-- 아래 SQL을 실행하여 직접 삽입할 수 있습니다.

-- 방법 1: 비밀번호를 해시화하여 직접 삽입 (권장)
-- 먼저 PHP에서 해시를 생성: php -r "echo password_hash('malsim', PASSWORD_DEFAULT);"
-- 그 결과를 아래 INSERT 문의 password 필드에 사용하세요.

-- 방법 2: 임시로 평문 비밀번호를 저장하고, 로그인 시 자동으로 해시화됩니다.
-- 하지만 이 방법은 보안상 권장되지 않습니다.

-- 관리자 계정 삽입
-- 사용자명: ms7park
-- 비밀번호: malsim
-- 역할: admin

INSERT INTO users (username, password, role, created, modified) 
VALUES (
    'ms7park', 
    '$2y$10$JVLfoFxduzZSHHQs0KO0Pe/52jkjMrCYdUFHwq9V5lJls91a39ksW',  -- 'malsim'의 해시
    'admin',
    NOW(),
    NOW()
)
ON DUPLICATE KEY UPDATE 
    password = '$2y$10$JVLfoFxduzZSHHQs0KO0Pe/52jkjMrCYdUFHwq9V5lJls91a39ksW',
    role = 'admin',
    modified = NOW();

