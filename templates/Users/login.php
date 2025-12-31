<?php
$this->assign('title', '관리자 로그인');
?>

<div class="login-container">
    <div class="login-box">
        <h2>관리자 로그인</h2>
        <p class="login-subtitle">이미지 업로드를 위해 로그인이 필요합니다.</p>

        <?= $this->Form->create(null, ['class' => 'login-form']) ?>
        
        <div class="form-group">
            <?= $this->Form->label('username', '사용자명') ?>
            <?= $this->Form->text('username', [
                'class' => 'form-control',
                'required' => true,
                'placeholder' => '사용자명을 입력하세요',
                'autofocus' => true
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->label('password', '비밀번호') ?>
            <?= $this->Form->password('password', [
                'class' => 'form-control',
                'required' => true,
                'placeholder' => '비밀번호를 입력하세요'
            ]) ?>
        </div>

        <div class="form-actions">
            <?= $this->Form->button('로그인', ['class' => 'btn btn-primary btn-block']) ?>
        </div>

        <?= $this->Form->end() ?>
    </div>
</div>

<style>
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
    padding: 2rem;
}

.login-box {
    background: #fff;
    padding: 2.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}

.login-box h2 {
    margin-bottom: 0.5rem;
    color: #1a1a1a;
    text-align: center;
}

.login-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 2rem;
    font-size: 0.9rem;
}

.login-form .form-group {
    margin-bottom: 1.5rem;
}

.login-form .form-control {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.login-form .form-control:focus {
    outline: none;
    border-color: #ff6b6b;
    box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
}

.btn-block {
    width: 100%;
}
</style>


