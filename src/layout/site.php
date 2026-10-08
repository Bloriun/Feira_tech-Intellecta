<?php

declare(strict_types=1);

require_once __DIR__ . '/../utils/helpers.php';

function render_site(string $page, array $people, array $feed, array $notifications, array $messages): void
{
    render_page_head($page);

    if ($page === 'login') {
        include __DIR__ . '/../pages/login.php';
        render_page_footer();
        return;
    }

    if ($page === 'register') {
        include __DIR__ . '/../pages/register.php';
        render_page_footer();
        return;
    }

    render_app_shell($page);

    if ($page === 'home') {
        include __DIR__ . '/../pages/home.php';
    } elseif ($page === 'explore') {
        include __DIR__ . '/../pages/explore.php';
    } elseif ($page === 'notifications') {
        include __DIR__ . '/../pages/notifications.php';
    } elseif ($page === 'chat') {
        include __DIR__ . '/../pages/chat.php';
    } elseif ($page === 'profile') {
        include __DIR__ . '/../pages/profile.php';
    } else {
        echo '<div class="p-8">Página não encontrada.</div>';
    }

    render_rightbar();
    echo '</div>';
    render_page_footer();
}

function render_page_head(string $title): void
{
    ?>
    <!doctype html>
    <html lang="pt-BR">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title><?= e($title) ?> · Intellecta</title>
      <script src="https://cdn.tailwindcss.com"></script>
      <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: { ink:'#11140C', surface:'#171b13', line:'#383A33', sage:'#6B7968', cream:'#E9DDCA', olive:'#c7d36a' }
            }
          }
        }
      </script>
      <link rel="stylesheet" href="/assets/css/styles.css">
    </head>
    <body>
    <?php
}

function render_page_footer(): void
{
    ?>
    <script>
      document.querySelectorAll('[data-tab]').forEach(function(button) {
        button.addEventListener('click', function() {
          document.querySelectorAll('[data-tab-panel]').forEach(function(panel) {
            panel.classList.add('hidden');
          });
          var target = document.querySelector('[data-tab-panel="' + button.dataset.tab + '"]');
          if (target) {
            target.classList.remove('hidden');
          }
        });
      });
    </script>
    </body>
    </html>
    <?php
}

function render_app_shell(string $page): void
{
    ?>
    <div class="grid-shell min-h-screen">
      <?php render_sidebar($page); ?>
      <main class="min-w-0 border-r border-line">
    <?php
}

function render_sidebar(string $page): void
{
    ?>
    <aside class="sidebar hidden md:flex flex-col border-r border-line p-5 sticky top-0 h-screen">
      <div class="mb-10">
        <div class="text-4xl font-serif leading-none">ℐ</div>
        <div class="text-[10px] tracking-[.3em] mt-1">INTELLECTA</div>
      </div>
      <nav class="space-y-2 text-sm">
        <a class="nav-item <?= $page === 'home' ? 'active' : '' ?> flex items-center gap-3 px-3 py-2 rounded-lg" href="?page=home">⌂ Home</a>
        <a class="nav-item <?= $page === 'explore' ? 'active' : '' ?> flex items-center gap-3 px-3 py-2 rounded-lg" href="?page=explore">⌕ Explorar</a>
        <a class="nav-item <?= $page === 'notifications' ? 'active' : '' ?> flex items-center gap-3 px-3 py-2 rounded-lg" href="?page=notifications">♧ Notificações</a>
        <a class="nav-item <?= $page === 'chat' ? 'active' : '' ?> flex items-center gap-3 px-3 py-2 rounded-lg" href="?page=chat">□ Chat</a>
        <a class="nav-item <?= $page === 'profile' ? 'active' : '' ?> flex items-center gap-3 px-3 py-2 rounded-lg" href="?page=profile">♙ Perfil</a>
      </nav>
      <div class="mt-auto pt-4 border-t border-line flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-sage/40 flex items-center justify-center">M</div>
        <div class="min-w-0">
          <div class="text-sm truncate">miguel</div>
          <div class="text-xs soft">@miguel</div>
        </div>
        <div class="ml-auto soft">⋯</div>
      </div>
    </aside>
    <?php
}

function render_rightbar(): void
{
    ?>
    <aside class="rightbar hidden lg:block p-5">
      <input class="input mb-4" placeholder="⌕  Pesquisa">
      <div class="panel min-h-[330px] p-4 flex flex-col">
        <div class="flex items-center justify-between font-semibold">
          <span>Intellecta IA</span><span class="soft">◉</span>
        </div>
        <div class="mt-4 flex-1 rounded-2xl border border-line bg-[#11140C]/40 p-4 overflow-auto">
          <p class="text-sm soft">Assistente educacional</p>
          <p class="mt-3 text-sm leading-relaxed">Aqui a IA apareceria integrada ao layout. Neste protótipo, a área mostra somente a estrutura visual pedida.</p>
        </div>
        <div class="mt-4">
          <textarea class="input rounded-2xl resize-none" rows="3" placeholder="Qual sua dúvida?"></textarea>
          <button class="btn btn-secondary w-full mt-2 text-sm" type="button">Enviar pergunta ↗</button>
        </div>
      </div>
    </aside>
    <?php
}
