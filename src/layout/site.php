<?php

declare(strict_types=1);

require_once __DIR__ . '/../utils/helpers.php';

function render_site(string $page, array $people, array $feed, array $notifications, array $messages): void
{
    $routes = require __DIR__ . '/../config/routes.php';
    $publicPages = $routes['public'];
    $appPages = $routes['app'];
    $page = in_array($page, array_merge($publicPages, $appPages), true) ? $page : '404';

    render_page_head($page);

    if (in_array($page, $publicPages, true)) {
        include __DIR__ . '/../pages/' . $page . '.php';
        render_page_footer();
        return;
    }

    if ($page === '404') {
        render_not_found();
        render_page_footer();
        return;
    }

    render_app_shell($page);
    include __DIR__ . '/../pages/' . $page . '.php';
    echo '</main>';
    render_rightbar();
    echo '</div>';
    render_mobile_nav($page);
    render_page_footer();
}

function render_page_head(string $title): void
{
    $basePath = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/');
    $assetPath = ($basePath === '' || $basePath === '/') ? '/assets' : $basePath . '/assets';
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="theme-color" content="#0d110f">
      <title><?= e(ucfirst($title)) ?> · Intellecta</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;600&family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="<?= e($assetPath) ?>/css/styles.css">
    </head>
    <body>
    <?php
}

function icon(string $name): string
{
    $paths = [
        'home' => '<path d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1Z"/>',
        'search' => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
        'bell' => '<path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/>',
        'message' => '<path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.5 9.5 0 0 1-4-.9L3 21l1.8-4A8.3 8.3 0 0 1 3 11.5 8.4 8.4 0 0 1 12 3a8.4 8.4 0 0 1 9 8.5Z"/>',
        'user' => '<circle cx="12" cy="8" r="3.5"/><path d="M5 21a7 7 0 0 1 14 0"/>',
        'spark' => '<path d="m12 2 1.6 6.4L20 10l-6.4 1.6L12 18l-1.6-6.4L4 10l6.4-1.6Z"/><path d="m19 16 .6 2.4L22 19l-2.4.6L19 22l-.6-2.4L16 19l2.4-.6Z"/>',
        'plus' => '<path d="M12 5v14M5 12h14"/>',
        'image' => '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9" r="1.5"/><path d="m21 15-4.5-4.5L7 20"/>',
        'send' => '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>',
    ];
    $path = $paths[$name] ?? $paths['spark'];
    return '<svg class="icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">' . $path . '</svg>';
}

function render_logo(string $href = '?page=home', bool $compact = false): void
{
    ?>
    <a class="brand <?= $compact ? 'brand--compact' : '' ?>" href="<?= e($href) ?>" aria-label="Intellecta">
      <span class="brand-mark" aria-hidden="true"><span>I</span></span>
      <?php if (!$compact): ?><span class="brand-name">INTELLECTA</span><?php endif; ?>
    </a>
    <?php
}

function render_page_footer(): void
{
    ?>
    <div class="toast" id="toast" role="status" aria-live="polite"></div>
    <script>
      (function () {
        var toast = document.getElementById('toast');
        window.notify = function (message) {
          if (!toast) return;
          toast.textContent = message;
          toast.classList.add('show');
          window.clearTimeout(window.__toastTimer);
          window.__toastTimer = window.setTimeout(function () { toast.classList.remove('show'); }, 2600);
        };
        document.querySelectorAll('[data-action="placeholder"]').forEach(function (button) {
          button.addEventListener('click', function () { window.notify(button.dataset.message || 'Disponível em breve.'); });
        });
        document.querySelectorAll('[data-like]').forEach(function (button) {
          button.addEventListener('click', function () {
            var count = button.querySelector('[data-count]');
            var active = button.classList.toggle('liked');
            if (count) count.textContent = String(Number(count.textContent) + (active ? 1 : -1));
            button.setAttribute('aria-pressed', active ? 'true' : 'false');
            button.classList.remove('like-pop');
            window.requestAnimationFrame(function () { button.classList.add('like-pop'); });
          });
        });
        document.querySelectorAll('[data-filter]').forEach(function (input) {
          input.addEventListener('input', function () {
            var query = input.value.toLowerCase();
            var field = input.closest('.search-field');
            if (field) field.classList.toggle('has-value', query !== '');
            document.querySelectorAll('[data-filter-item]').forEach(function (item) {
              item.hidden = query !== '' && !item.textContent.toLowerCase().includes(query);
            });
          });
        });
        document.querySelectorAll('[data-profile-tab]').forEach(function (tab) {
          tab.addEventListener('click', function () {
            var selected = tab.dataset.profileTab;
            document.querySelectorAll('[data-profile-tab]').forEach(function (item) {
              var active = item === tab;
              item.classList.toggle('active', active);
              item.setAttribute('aria-selected', active ? 'true' : 'false');
            });
            document.querySelectorAll('[data-profile-panel]').forEach(function (panel) {
              var active = panel.dataset.profilePanel === selected;
              panel.hidden = !active;
              panel.classList.toggle('active', active);
            });
          });
        });
        document.querySelectorAll('textarea, input').forEach(function (field) {
          field.addEventListener('input', function () {
            var wrapper = field.closest('.ai-card, .composer, .auth-card');
            if (wrapper) wrapper.classList.add('has-input');
          });
        });
        document.querySelectorAll('[data-demo-form]').forEach(function (form) {
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            var submit = form.querySelector('button[type="submit"]');
            var original = submit ? submit.innerHTML : '';
            if (submit) {
              submit.disabled = true;
              submit.classList.add('is-submitting');
              submit.innerHTML = '<span class="loading-dot" aria-hidden="true"></span> Processando';
            }
            window.setTimeout(function () {
              if (submit) {
                submit.disabled = false;
                submit.classList.remove('is-submitting');
                submit.innerHTML = original;
              }
              window.notify(form.dataset.success || 'Ação concluída com sucesso.');
            }, 520);
          });
        });
      }());
    </script>
    </body>
    </html>
    <?php
}

function render_app_shell(string $page): void
{
    ?>
    <div class="app-shell">
      <?php render_sidebar($page); ?>
      <main class="main-column">
    <?php
}

function render_sidebar(string $page): void
{
    $items = [
        'home' => ['home', 'Início'],
        'explore' => ['search', 'Explorar'],
        'notifications' => ['bell', 'Notificações'],
        'chat' => ['message', 'Conversas'],
    ];
    ?>
    <aside class="sidebar">
      <?php render_logo(); ?>
      <nav class="sidebar__nav" aria-label="Navegação principal">
        <span class="sidebar__nav-label">Navegar</span>
        <?php foreach ($items as $key => [$icon, $label]): ?>
          <a class="nav-item <?= $page === $key ? 'active' : '' ?>" href="?page=<?= e($key) ?>" <?= $page === $key ? 'aria-current="page"' : '' ?>>
            <span class="nav-icon"><?= icon($icon) ?></span><?= e($label) ?>
            <?php if ($key === 'notifications'): ?><span class="nav-item__count">3</span><?php endif; ?>
          </a>
        <?php endforeach; ?>
      </nav>
      <a class="sidebar-profile-link" href="?page=profile" aria-label="Abrir perfil de Enzo Diccini">
        <div class="avatar">E</div>
        <span class="sidebar-profile-link__copy"><strong>Enzo Diccini</strong><small>@enzo</small></span>
        <span class="sidebar-profile-link__status" aria-label="Online"></span>
      </a>
    </aside>
    <?php
}

function render_mobile_nav(string $page): void
{
    $items = [
        'home' => ['home', 'Início'],
        'explore' => ['search', 'Explorar'],
        'notifications' => ['bell', 'Avisos'],
        'chat' => ['message', 'Conversas'],
        'profile' => ['user', 'Perfil'],
    ];
    ?>
    <nav class="mobile-nav" aria-label="Navegação móvel">
      <?php foreach ($items as $key => [$icon, $label]): ?>
        <a class="<?= $page === $key ? 'active' : '' ?>" href="?page=<?= e($key) ?>" <?= $page === $key ? 'aria-current="page"' : '' ?>>
          <span><?= icon($icon) ?></span><span><?= e($label) ?></span>
        </a>
      <?php endforeach; ?>
    </nav>
    <?php
}

function render_rightbar(): void
{
    ?>
    <aside class="rightbar">
      <label class="eyebrow" for="global-search">Atalhos</label>
      <div class="search-field">
        <span><?= icon('search') ?></span>
        <input class="input" id="global-search" data-filter placeholder="Pesquisar no Intellecta">
      </div>
      <section class="panel ai-card" aria-labelledby="ai-title">
        <div class="ai-card__head">
          <strong id="ai-title">Intellecta IA</strong>
          <span class="ai-status">online</span>
        </div>
        <div class="ai-card__body">
          <p class="muted">Seu assistente de estudos</p>
          <p>Organize uma ideia, resuma um texto ou encontre um novo caminho para aprender.</p>
        </div>
        <form class="form-stack" data-demo-form data-success="Pergunta enviada para a Intellecta IA.">
          <label class="form-label" for="ai-question">Como posso ajudar?</label>
          <textarea class="input" id="ai-question" rows="3" placeholder="Escreva sua dúvida..."></textarea>
          <button class="btn btn-secondary" type="submit">Enviar pergunta ↗</button>
        </form>
      </section>
    </aside>
    <?php
}

function render_not_found(): void
{
    ?>
    <main class="auth-form-wrap not-found-page">
      <section class="auth-card card">
        <span class="eyebrow">404</span>
        <h2>Essa página se perdeu.</h2>
        <p>O endereço não existe ou ainda está sendo construído.</p>
        <a class="btn btn-primary not-found-page__link" href="?page=home">
          Voltar para o início
        </a>
      </section>
    </main>
    <?php
}
