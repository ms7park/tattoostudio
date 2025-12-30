<?php
$this->assign('title', '이미지 업로드');
?>

<div class="upload-header">
    <h2>타투 이미지 업로드</h2>
</div>

<div class="upload-form-wrapper">
    <?= $this->Form->create($tattoo, ['type' => 'file', 'class' => 'upload-form']) ?>
    
    <div class="form-group">
        <?= $this->Form->label('title', '제목 (선택사항)') ?>
        <?= $this->Form->text('title', ['class' => 'form-control', 'placeholder' => '타투 제목을 입력하세요']) ?>
    </div>

    <div class="form-group">
        <?= $this->Form->label('description', '설명 (선택사항)') ?>
        <?= $this->Form->textarea('description', ['class' => 'form-control', 'rows' => 4, 'placeholder' => '타투에 대한 설명을 입력하세요']) ?>
    </div>

    <div class="form-group">
        <?= $this->Form->label('image', '이미지 파일') ?>
        <?= $this->Form->file('image', ['required' => true, 'accept' => 'image/*', 'class' => 'form-control']) ?>
        <small class="form-text">JPG, PNG, GIF 형식의 이미지를 업로드할 수 있습니다.</small>
    </div>

    <div class="form-actions">
        <?= $this->Form->button('업로드', ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('취소', ['action' => 'index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?= $this->Form->end() ?>
</div>

