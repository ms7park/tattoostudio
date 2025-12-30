<?php
$this->assign('title', '타투 갤러리');
?>

<div class="gallery-header">
    <h2>타투 갤러리</h2>
    <p class="subtitle">작품을 감상해보세요</p>
</div>

<?php if (empty($tattoos)): ?>
    <div class="empty-state">
        <p>아직 등록된 타투 이미지가 없습니다.</p>
        <?= $this->Html->link('첫 이미지 업로드하기', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
    </div>
<?php else: ?>
    <div class="gallery-grid">
        <?php foreach ($tattoos as $tattoo): ?>
            <div class="gallery-item">
                <div class="gallery-image-wrapper">
                    <?= $this->Html->image($tattoo->image_path, [
                        'alt' => $tattoo->title ?? '타투 이미지',
                        'class' => 'gallery-image'
                    ]) ?>
                </div>
                <?php if (!empty($tattoo->title)): ?>
                    <h3 class="gallery-title"><?= h($tattoo->title) ?></h3>
                <?php endif; ?>
                <?php if (!empty($tattoo->description)): ?>
                    <p class="gallery-description"><?= h($tattoo->description) ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

