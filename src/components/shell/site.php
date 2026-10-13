<?php

declare(strict_types=1);

require_once __DIR__ . '/../../utils/helpers.php';
require_once __DIR__ . '/icon.php';

function render_site(string $page, array $people, array $feed, array $notifications, array $messages, array $account): void
{
    $routes = require __DIR__ . '/../../config/routes.php';
    $publicPages = $routes['public'];
    $appPages = $routes['app'];
    $page = in_array($page, array_merge($publicPages, $appPages), true) ? $page : '404';

    render_page_head($page);

    if (in_array($page, $publicPages, true)) {
        include __DIR__ . '/../../' . $routes['views'][$page];
        render_page_footer();
        return;
    }

    if ($page === '404') {
        render_not_found();
        render_page_footer();
        return;
    }

    render_app_shell($page, $account);
    include __DIR__ . '/../../' . $routes['views'][$page];
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
      <script src="<?= e($assetPath) ?>/js/app.js" defer></script>
    </head>
    <body>
    <?php
}

function render_logo(string $href = '?page=home', bool $compact = false): void
{
    ?>
    <a class="brand <?= $compact ? 'brand--compact' : '' ?>" href="<?= e($href) ?>" aria-label="Intellecta">
      <img class="brand-mark" src="/assets/images/intellecta_icon_branco_vetor.svg" alt="" aria-hidden="true">
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
        window.intellectaState = {
          data: { settings: {}, saved: {}, messages: {}, profile: {} },
          read: function (key, fallback) {
            var parts = key.split(':');
            var bucket = parts[0];
            var name = parts.slice(1).join(':');
            return this.data[bucket] && Object.prototype.hasOwnProperty.call(this.data[bucket], name)
              ? this.data[bucket][name] : fallback;
          },
          write: function (key, value) {
            var parts = key.split(':');
            var bucket = parts[0];
            var name = parts.slice(1).join(':');
            if (!this.data[bucket]) this.data[bucket] = {};
            this.data[bucket][name] = value;
          }
        };
        document.querySelectorAll('[data-action="placeholder"]').forEach(function (button) {
          button.addEventListener('click', function () { window.notify(button.dataset.message || 'Disponível em breve.'); });
        });
        document.querySelectorAll('[data-focus]').forEach(function (button) {
          button.addEventListener('click', function () {
            var field = document.querySelector(button.dataset.focus);
            if (field) { field.focus(); field.scrollIntoView({ behavior: 'smooth', block: 'center' }); }
          });
        });
        document.querySelectorAll('[data-media]').forEach(function (button) {
          button.addEventListener('click', function () {
            var name = window.prompt('Qual mídia você quer anexar?', 'Imagem de estudo');
            if (name) window.notify('"' + name + '" foi anexada à publicação.');
          });
        });
        document.querySelectorAll('[data-poll]').forEach(function (button) {
          button.addEventListener('click', function () {
            var question = window.prompt('Escreva a pergunta da enquete:');
            if (!question) return;
            var options = window.prompt('Digite duas opções separadas por vírgula:', 'Sim, Ainda não');
            if (options) window.notify('Enquete criada: ' + question);
          });
        });
        document.querySelectorAll('[data-comments]').forEach(function (button) {
          button.addEventListener('click', function () {
            var comment = window.prompt('Escreva um comentário:');
            if (!comment) return;
            var count = button.textContent.match(/\d+/);
            if (count) button.innerHTML = '<?= icon('message') ?> ' + (Number(count[0]) + 1);
            window.notify('Comentário adicionado.');
          });
        });
        document.querySelectorAll('[data-post-menu]').forEach(function (button) {
          button.addEventListener('click', function () {
            var action = window.prompt('Digite uma ação: salvar, compartilhar ou silenciar', 'salvar');
            if (action === 'salvar') {
              var card = button.closest('[data-filter-item]');
              var save = card && card.querySelector('[data-save]');
              if (save) save.click();
            } else if (action === 'compartilhar') window.notify('Link da publicação copiado.');
            else if (action === 'silenciar') { var card = button.closest('[data-filter-item]'); if (card) card.remove(); window.notify('Publicação removida do seu feed.'); }
          });
        });
        document.querySelectorAll('[data-mark-read]').forEach(function (button) {
          button.addEventListener('click', function () {
            document.querySelectorAll('.notification-dot').forEach(function (dot) { dot.remove(); });
            window.notify('Todas as notificações foram marcadas como lidas.');
          });
        });
        document.querySelectorAll('[data-like]').forEach(function (button) {
          button.addEventListener('click', function () {
            var count = button.querySelector('[data-count]');
            var active = button.classList.toggle('liked');
            if (count) count.textContent = String(Number(count.textContent) + (active ? 1 : -1));
            button.setAttribute('aria-pressed', active ? 'true' : 'false');
            if (button.dataset.persistKey) window.intellectaState.write(button.dataset.persistKey, active);
            button.classList.remove('like-pop');
            window.requestAnimationFrame(function () { button.classList.add('like-pop'); });
          });
        });
        document.querySelectorAll('[data-save]').forEach(function (button) {
          var key = button.dataset.save;
          var saved = window.intellectaState.read('saved:' + key, false);
          button.classList.toggle('saved', saved);
          button.setAttribute('aria-pressed', saved ? 'true' : 'false');
          button.addEventListener('click', function () {
            var active = !button.classList.contains('saved');
            button.classList.toggle('saved', active);
            button.setAttribute('aria-pressed', active ? 'true' : 'false');
            window.intellectaState.write('saved:' + key, active);
            window.notify(active ? 'Salvo na sua coleção.' : 'Removido dos salvos.');
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
              if (form.dataset.persistKey) window.intellectaState.write(form.dataset.persistKey, { submittedAt: Date.now() });
            }, 520);
          });
        });
        var aiPanel = document.querySelector('#intellia-panel');
        var aiBackdrop = document.querySelector('[data-ai-backdrop]');
        var aiToggles = document.querySelectorAll('[data-ai-toggle]');
        function setAiOpen(open) {
          if (!aiPanel) return;
          aiPanel.hidden = !open;
          aiPanel.setAttribute('aria-hidden', open ? 'false' : 'true');
          if (aiBackdrop) aiBackdrop.hidden = !open;
          aiToggles.forEach(function (toggle) {
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? 'Fechar Intellia' : 'Abrir Intellia');
          });
          document.body.classList.toggle('ai-is-open', open);
          if (open) {
            var aiInput = aiPanel.querySelector('#ai-question');
            if (aiInput) window.setTimeout(function () { aiInput.focus(); }, 120);
          }
        }
        aiToggles.forEach(function (toggle) { toggle.addEventListener('click', function () { setAiOpen(aiPanel.hidden); }); });
        if (aiBackdrop) aiBackdrop.addEventListener('click', function () { setAiOpen(false); });
        document.addEventListener('keydown', function (event) {
          if (event.key === 'Escape' && aiPanel && !aiPanel.hidden) setAiOpen(false);
        });
        document.querySelectorAll('[data-ai-form]').forEach(function (form) {
          var panel = form.closest('.ai-card');
          var messages = panel.querySelector('[data-ai-messages]');
          var field = form.querySelector('textarea');
          var send = form.querySelector('button');
          function addMessage(text, type, label) {
            var item = document.createElement('div');
            item.className = 'ai-message ai-message--' + type;
            if (type === 'bot') item.innerHTML = '<span class="ai-message__avatar"><?= icon('spark') ?></span><div><p></p><small></small></div>';
            else item.innerHTML = '<p></p><small></small>';
            item.querySelector('p').textContent = text;
            item.querySelector('small').textContent = label || 'agora';
            messages.appendChild(item);
            messages.scrollTop = messages.scrollHeight;
          }
          function answerFor(question) {
            var text = question.toLowerCase();
            if (text.indexOf('plano') >= 0 || text.indexOf('estud') >= 0) return 'Divida seu objetivo em três passos: entender o tema, praticar com um exemplo e revisar amanhã. Quer que eu monte um roteiro com seu tempo disponível?';
            if (text.indexOf('resum') >= 0) return 'Envie o assunto principal e eu organizo em pontos-chave, conceitos essenciais e uma pergunta para revisar depois.';
            if (text.indexOf('design') >= 0 || text.indexOf('interface') >= 0) return 'Para uma interface clara, priorize contraste, espaçamento consistente e uma ação principal por bloco. Posso revisar uma tela específica com você.';
            return 'Boa pergunta. Vamos organizar isso juntos: qual é o resultado que você quer alcançar e o que já tentou até agora?';
          }
          function submitQuestion(question) {
            if (!question) return;
            addMessage(question, 'user', 'agora');
            field.value = '';
            field.disabled = true;
            send.disabled = true;
            panel.classList.add('ai-card--thinking');
            var typing = document.createElement('div');
            typing.className = 'ai-message ai-message--bot ai-message--typing';
            typing.innerHTML = '<span class="ai-message__avatar"><?= icon('spark') ?></span><div><p><i></i><i></i><i></i></p><small>INTELLIA está pensando</small></div>';
            messages.appendChild(typing);
            messages.scrollTop = messages.scrollHeight;
            window.setTimeout(function () {
              typing.remove();
              addMessage(answerFor(question), 'bot', 'INTELLIA · agora');
              field.disabled = false;
              send.disabled = false;
              panel.classList.remove('ai-card--thinking');
              field.focus();
            }, 650);
          }
          form.addEventListener('submit', function (event) { event.preventDefault(); submitQuestion(field.value.trim()); });
          panel.querySelectorAll('[data-ai-prompt]').forEach(function (button) {
            button.addEventListener('click', function () { field.value = button.dataset.aiPrompt; submitQuestion(field.value); });
          });
          field.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' && !event.shiftKey) { event.preventDefault(); form.requestSubmit(); }
          });
        });
        document.querySelectorAll('[data-toggle-setting]').forEach(function (control) {
          var key = control.dataset.toggleSetting;
          var value = window.intellectaState.read('setting:' + key, control.checked);
          control.checked = Boolean(value);
          control.addEventListener('change', function () {
            window.intellectaState.write('setting:' + key, control.checked);
            window.notify(control.checked ? 'Preferência ativada.' : 'Preferência desativada.');
          });
        });
        document.querySelectorAll('[data-follow]').forEach(function (button) {
          button.addEventListener('click', function () {
            var following = button.classList.toggle('is-following');
            button.textContent = following ? 'Seguindo' : 'Seguir';
            window.notify(following ? 'Você está seguindo este perfil.' : 'Você deixou de seguir este perfil.');
          });
          document.querySelectorAll('[data-profile-menu]').forEach(function (button) {
            button.addEventListener('click', function (event) {
              event.stopPropagation();
              var panel = button.parentElement.querySelector('[data-profile-menu-panel]');
              var open = panel.hidden;
              panel.hidden = !open;
              button.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
          });
          document.querySelectorAll('[data-profile-share]').forEach(function (button) {
            button.addEventListener('click', function () {
              var panel = button.closest('[data-profile-menu-panel]');
              if (panel) panel.hidden = true;
              window.notify('Link do perfil copiado para compartilhar.');
            });
          });
          document.querySelectorAll('[data-profile-block]').forEach(function (button) {
            button.addEventListener('click', function () {
              if (window.confirm('Bloquear este perfil nesta sessão?')) window.notify('Perfil bloqueado nesta sessão.');
            });
          });
          document.querySelectorAll('[data-profile-report]').forEach(function (button) {
            button.addEventListener('click', function () {
              var reason = window.prompt('Por que você quer denunciar este perfil?');
              if (reason) window.notify('Denúncia registrada para análise.');
            });
          });
          document.querySelectorAll('[data-profile-notify]').forEach(function (button) {
            button.addEventListener('click', function () {
              button.classList.toggle('is-active');
              window.notify(button.classList.contains('is-active') ? 'Notificações ativadas.' : 'Notificações desativadas.');
            });
          });
          document.addEventListener('click', function () {
            document.querySelectorAll('[data-profile-menu-panel]').forEach(function (panel) { panel.hidden = true; });
            document.querySelectorAll('[data-profile-menu]').forEach(function (button) { button.setAttribute('aria-expanded', 'false'); });
          });
        });
        document.querySelectorAll('[data-post-form]').forEach(function (form) {
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            var field = form.querySelector('textarea');
            var body = field ? field.value.trim() : '';
            if (!body) { window.notify('Escreva algo antes de publicar.'); return; }
            var feed = document.querySelector('.home-feed');
            if (feed) {
              var article = document.createElement('article');
              article.className = 'card post';
              article.dataset.filterItem = '';
              article.innerHTML = '<div class="post__head"><div class="avatar">M</div><div class="post__meta"><strong>Miguel Barbosa</strong><span>@otherdaujune · agora</span></div></div><p class="post__body"></p><div class="post__footer"><button class="btn btn-ghost" type="button" data-like aria-pressed="false">♡ <span data-count>0</span></button><span class="post__stats">agora</span></div>';
              article.querySelector('.post__body').textContent = body;
              feed.prepend(article);
              article.querySelector('[data-like]').addEventListener('click', function () {
                var button = this;
                var count = button.querySelector('[data-count]');
                var active = button.classList.toggle('liked');
                if (count) count.textContent = String(Number(count.textContent) + (active ? 1 : -1));
                button.setAttribute('aria-pressed', active ? 'true' : 'false');
              });
              field.value = '';
              window.notify('Sua publicação entrou no feed.');
            }
          });
        });
        document.querySelectorAll('[data-chat-app]').forEach(function (app) {
          var histories = {};
          var active = 'matheus';
          var messages = app.querySelector('[data-chat-messages]');
          var form = app.querySelector('[data-chat-form]');
          histories.matheus = Array.prototype.slice.call(messages.querySelectorAll('.message-row')).map(function (row) {
            return { text: row.querySelector('p').textContent, time: row.querySelector('small').textContent, mine: row.classList.contains('message-row--mine') };
          });
          function renderHistory(username) {
            active = username;
            var conversation = app.querySelector('[data-conversation="' + username + '"]');
            var name = conversation ? conversation.dataset.name : username;
            var avatar = conversation ? conversation.dataset.initials : name.slice(0, 1).toUpperCase();
            app.querySelectorAll('[data-conversation]').forEach(function (item) { item.classList.toggle('active', item.dataset.conversation === username); });
            app.querySelector('[data-chat-name]').textContent = name;
            app.querySelector('[data-chat-avatar]').textContent = avatar;
            messages.innerHTML = '<div class="chat-date"><span>Hoje</span></div>';
            (histories[username] || []).forEach(function (item) {
              var row = document.createElement('div');
              row.className = 'message-row' + (item.mine ? ' message-row--mine' : '');
              row.innerHTML = '<div class="message' + (item.mine ? ' message--mine' : '') + '"><p></p><small></small></div>';
              row.querySelector('p').textContent = item.text;
              row.querySelector('small').textContent = item.time;
              messages.appendChild(row);
            });
          }
          app.querySelectorAll('[data-conversation]').forEach(function (item) {
            item.addEventListener('click', function () { renderHistory(item.dataset.conversation); });
          });
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            var field = form.querySelector('input');
            var body = field.value.trim();
            if (!body) return;
            if (!histories[active]) histories[active] = [];
            histories[active].push({ text: body, time: 'agora', mine: true });
            renderHistory(active);
            field.value = '';
            window.notify('Mensagem enviada.');
          });
          document.querySelector('[data-new-conversation]').addEventListener('click', function () {
            var name = window.prompt('Nome da pessoa com quem você quer conversar:');
            if (!name) return;
            var username = name.toLowerCase().replace(/[^a-z0-9]+/g, '-');
            if (!app.querySelector('[data-conversation="' + username + '"]')) {
              var item = document.createElement('button');
              item.type = 'button'; item.className = 'conversation'; item.dataset.conversation = username; item.dataset.name = name; item.dataset.initials = name.slice(0, 1).toUpperCase(); item.dataset.filterItem = '';
              item.innerHTML = '<div class="avatar"></div><div class="conversation__copy"><div><strong></strong><time>agora</time></div><span>Nova conversa</span></div>';
              item.querySelector('.avatar').textContent = item.dataset.initials;
              item.querySelector('strong').textContent = name;
              item.addEventListener('click', function () { renderHistory(username); });
              app.querySelector('.conversation-list__items').prepend(item);
              histories[username] = [];
              app.querySelector('[data-conversation-count]').textContent = String(app.querySelectorAll('[data-conversation]').length);
            }
            renderHistory(username);
            window.notify('Nova conversa criada.');
          });
          app.querySelector('[data-chat-options]').addEventListener('click', function () { window.notify('Você pode silenciar ou arquivar esta conversa nesta sessão.'); });
        });
        document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
          button.addEventListener('click', function () {
            var input = button.parentElement.querySelector('input');
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
            button.setAttribute('aria-label', input.type === 'password' ? 'Mostrar senha' : 'Ocultar senha');
            button.classList.toggle('is-visible', input.type === 'text');
          });
        });
        document.querySelectorAll('[data-password-recovery]').forEach(function (button) {
          button.addEventListener('click', function () {
            var email = window.prompt('Digite o e-mail da conta para receber a recuperação:');
            if (email && email.indexOf('@') > 0) window.notify('Link de recuperação enviado para ' + email + '.');
            else if (email) window.notify('Digite um e-mail válido.');
          });
        });
        document.querySelectorAll('[data-password-form]').forEach(function (form) {
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            var current = form.querySelector('[name="current_password"]').value;
            var next = form.querySelector('[name="new_password"]').value;
            var confirm = form.querySelector('[name="confirm_password"]').value;
            if (!current || !next || !confirm) { window.notify('Preencha todos os campos.'); return; }
            if (next.length < 8) { window.notify('A nova senha precisa ter pelo menos 8 caracteres.'); return; }
            if (next !== confirm) { window.notify('As senhas novas não são iguais.'); return; }
            form.reset();
            window.notify('Senha alterada nesta sessão.');
          });
        });
        document.querySelectorAll('[data-profile-form]').forEach(function (form) {
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            var bio = form.querySelector('[name="bio"]');
            if (bio && !bio.value.trim()) { window.notify('Escreva uma bio antes de salvar.'); bio.focus(); return; }
            window.intellectaState.write('profile:bio', bio ? bio.value.trim() : '');
            window.notify('Perfil atualizado nesta sessão.');
          });
          form.querySelectorAll('[data-profile-field]').forEach(function (field) {
            field.addEventListener('input', function () {
              field.dataset.controlledValue = field.value;
            });
          });
        });
        document.querySelectorAll('[data-delete-account]').forEach(function (button) {
          button.addEventListener('click', function () {
            if (window.confirm('Excluir a conta desta demonstração? Esta ação apenas encerra a sessão atual.')) {
              document.body.classList.add('session-ended');
              window.notify('Sessão encerrada. Seus dados não foram apagados do servidor porque esta é uma demonstração.');
            }
          });
        });
        document.querySelectorAll('[data-logout]').forEach(function (button) {
          button.addEventListener('click', function () {
            if (window.confirm('Deseja sair da conta?')) window.location.href = '?page=login';
          });
        });
      }());
    </script>
    </body>
    </html>
    <?php
}

function render_app_shell(string $page, array $account): void
{
    ?>
    <div class="app-shell">
      <?php render_sidebar($page, $account); ?>
      <main class="main-column">
    <?php
}

function render_sidebar(string $page, array $account): void
{
    $items = [
        'home' => ['home', 'Início'],
        'explore' => ['search', 'Explorar'],
        'notifications' => ['bell', 'Notificações'],
        'chat' => ['message', 'Conversas'],
        'profile' => ['user', 'Perfil'],
        'saved' => ['bookmark', 'Salvos'],
        'topics' => ['spark', 'Tópicos'],
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
      <nav class="sidebar__nav sidebar__nav--secondary" aria-label="Recursos">
        <span class="sidebar__nav-label">Seu espaço</span>
        <a class="nav-item <?= in_array($page, ['preferencias', 'privacidade', 'seguranca'], true) ? 'active' : '' ?>" href="?page=preferencias">
          <span class="nav-icon"><?= icon('settings') ?></span>Preferências
        </a>
        <a class="nav-item <?= in_array($page, ['ajuda', 'termos', 'privacidade-legal'], true) ? 'active' : '' ?>" href="?page=ajuda">
          <span class="nav-icon"><?= icon('help') ?></span>Ajuda
        </a>
      </nav>
      <a class="sidebar-profile-link <?= in_array($page, ['profile', 'editar-perfil'], true) ? 'active' : '' ?>" href="?page=editar-perfil" aria-label="Abrir edição do perfil">
        <div class="avatar"><?= e(initials($account['name'])) ?></div>
        <span class="sidebar-profile-link__copy"><strong><?= e($account['name']) ?></strong><small>@<?= e($account['username']) ?></small></span>
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
        'saved' => ['bookmark', 'Salvos'],
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
      <label class="eyebrow" for="global-search">Pesquisa</label>
      <div class="search-field">
        <span><?= icon('search') ?></span>
        <input class="input" id="global-search" data-filter placeholder="Pesquisar no Intellecta">
      </div>
      <button class="ai-launcher" type="button" data-ai-toggle aria-expanded="false" aria-controls="intellia-panel" aria-label="Abrir Intellia">
        <img src="/assets/images/intellecta_icon_branco_vetor.svg" alt="" aria-hidden="true">
        <span class="ai-launcher__pulse"></span>
      </button>
      <div class="ai-backdrop" data-ai-backdrop hidden></div>
      <section class="panel ai-card" id="intellia-panel" aria-labelledby="ai-title" aria-hidden="true" hidden>
        <div class="ai-card__head">
          <div class="ai-brand">
            <span class="ai-brand__mark">I</span>
            <div><strong id="ai-title">INTELLIA</strong><small>assistente virtual</small></div>
          </div>
          <div class="ai-card__controls"><span class="ai-status">online</span><button class="ai-logo-close" type="button" data-ai-toggle aria-label="Fechar Intellia"><img src="/assets/images/intellecta_icon_branco_vetor.svg" alt="" aria-hidden="true"></button></div>
        </div>
        <div class="ai-orbit ai-orbit--one"></div><div class="ai-orbit ai-orbit--two"></div><div class="ai-orbit ai-orbit--three"></div>
        <div class="ai-intro">
          <span class="ai-intro__spark"><?= icon('spark') ?></span>
          <div><strong>Como posso ajudar?</strong><p>Organize uma ideia, estude melhor ou destrave seu próximo passo.</p></div>
        </div>
        <div class="ai-messages" data-ai-messages aria-live="polite">
          <div class="ai-message ai-message--user"><p>Como posso melhorar meus estudos?</p><small>agora</small></div>
          <div class="ai-message ai-message--bot"><span class="ai-message__avatar"><?= icon('spark') ?></span><div><p>Comece escolhendo uma meta pequena. Posso ajudar a montar um plano, resumir um texto ou explicar um conceito.</p><small>INTELLIA · agora</small></div></div>
        </div>
        <div class="ai-suggestions" aria-label="Sugestões rápidas">
          <button type="button" data-ai-prompt="Monte um plano de estudos">Plano de estudos</button>
          <button type="button" data-ai-prompt="Resuma este assunto">Resumir assunto</button>
          <button type="button" data-ai-prompt="Explique de forma simples">Explicar melhor</button>
        </div>
        <form class="ai-form" data-ai-form>
          <label class="sr-only" for="ai-question">Pergunte à Intellecta IA</label>
          <textarea class="input" id="ai-question" rows="1" placeholder="Pergunte qualquer coisa..." required></textarea>
          <button class="ai-send" type="submit" aria-label="Enviar pergunta"><?= icon('send') ?></button>
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
