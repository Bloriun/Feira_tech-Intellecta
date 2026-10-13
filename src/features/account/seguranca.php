<?php declare(strict_types=1); ?>

<header class="page-header account-page-header"><div><span class="eyebrow">Proteção da conta</span><h1>Segurança</h1></div></header>
<div class="page-content settings-page">
  <section class="security-status card"><span class="security-status__icon"><?= icon('shield') ?></span><div><span class="eyebrow">Tudo certo</span><h2>Sua conta está protegida.</h2><p class="muted">Ative uma camada extra sempre que quiser.</p></div></section>
  <section class="settings-links card">
    <a href="?page=alterar-senha"><span><strong>Alterar senha</strong><small>Atualize sua senha de acesso.</small></span><?= icon('chevron') ?></a>
    <label class="setting-row"><span><strong>Verificação em duas etapas</strong><small>Peça um código além da senha.</small></span><input type="checkbox" data-toggle-setting="two-factor"></label>
    <label class="setting-row"><span><strong>Alertas de acesso</strong><small>Avise quando houver um novo acesso.</small></span><input type="checkbox" data-toggle-setting="login-alerts" checked></label>
  </section>
</div>
