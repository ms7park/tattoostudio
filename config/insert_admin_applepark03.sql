-- 관리자 계정 생성 SQL
-- 사용자명: applepark03
-- 비밀번호: math2014
-- 역할: admin

INSERT INTO users (username, password, role, created, modified) 
VALUES (
    'applepark03', 
    '$2y$10$FZkGcXeqQQqs81MtX1Pt7.FXH8Mc9D6/N83wMoWR./oaJG8BWwoXm',  -- 'math2014'의 해시
    'admin',
    NOW(),
    NOW()
)
ON DUPLICATE KEY UPDATE 
    password = '$2y$10$FZkGcXeqQQqs81MtX1Pt7.FXH8Mc9D6/N83wMoWR./oaJG8BWwoXm',
    role = 'admin',
    modified = NOW();

