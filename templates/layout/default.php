<!DOCTYPE html>
<html lang="ko">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $this->fetch('title') ?> - 타투 스튜디오
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('style') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="logo">타투 스튜디오</h1>
            <ul class="nav-menu">
                <li><?= $this->Html->link('갤러리', ['controller' => 'Tattoos', 'action' => 'index']) ?></li>
                <?php 
                $user = $this->request->getSession()->read('Auth.User');
                if ($user && $user['role'] === 'admin'): 
                ?>
                    <li><?= $this->Html->link('업로드', ['controller' => 'Tattoos', 'action' => 'add']) ?></li>
                <?php endif; ?>
                <?php if ($user): ?>
                    <li><?= $this->Html->link('로그아웃', ['controller' => 'Users', 'action' => 'logout']) ?></li>
                <?php else: ?>
                    <li><?= $this->Html->link('로그인', ['controller' => 'Users', 'action' => 'login']) ?></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> 타투 스튜디오. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>


