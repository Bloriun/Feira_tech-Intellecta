<?php declare(strict_types=1); ?>

<header class="page-header profile-page-header">
  <div>
    <span class="eyebrow">Seu espaço no Intellecta</span>
    <h1>Perfil</h1>
  </div>
  <a class="btn btn-secondary" href="?page=editar-perfil"><?= icon('edit') ?> Editar perfil</a>
</header>

<div class="page-content profile-page">
  <section class="profile-card card" aria-labelledby="profile-name">
    <div class="profile-card__cover">
      <span class="profile-card__cover-label">INTELLECTA / 2024</span>
      <span class="profile-card__cover-mark">✦</span>
    </div>

    <div class="profile-card__content">
      <div class="profile-card__top">
        <div class="profile-avatar-wrap">
          <div class="avatar avatar--large profile-avatar">E</div>
          <span class="profile-status" aria-label="Online"></span>
        </div>
        <div class="profile-card__actions">
          <a class="btn btn-secondary btn-icon-label" href="?page=sua-conta"><?= icon('settings') ?> Conta</a>
          <button class="btn btn-ghost" type="button" data-action="placeholder" data-message="Link do perfil copiado."><?= icon('send') ?> Compartilhar</button>
        </div>
      </div>

      <div class="profile-card__identity">
        <div>
          <span class="eyebrow">Perfil público</span>
          <h2 id="profile-name">Enzo Diccini</h2>
          <p class="profile-handle">@enzo <span class="profile-verified"><?= icon('check') ?></span></p>
        </div>
        <span class="profile-presence"><i></i> online agora</span>
      </div>

      <p class="profile-bio">Aprendendo, criando e compartilhando descobertas todos os dias.</p>

      <div class="profile-details">
        <span><?= icon('spark') ?> Tecnologia &amp; design</span>
        <span><?= icon('home') ?> Intellecta desde 2024</span>
      </div>

      <div class="profile-metrics" aria-label="Resumo do perfil">
        <a href="#profile-posts"><strong>24</strong><span>publicações</span></a>
        <button type="button" data-action="placeholder" data-message="Sua lista de seguidores está pronta para ser conectada."><strong>182</strong><span>seguidores</span></button>
        <button type="button" data-action="placeholder" data-message="Sua lista de perfis seguidos está pronta para ser conectada."><strong>96</strong><span>seguindo</span></button>
      </div>
    </div>
  </section>

  <nav class="profile-tabs" aria-label="Conteúdo do perfil" role="tablist">
    <button class="profile-tab active" type="button" data-profile-tab="posts" aria-selected="true" role="tab">
      <span><?= icon('edit') ?></span> Publicações <b>24</b>
    </button>
    <button class="profile-tab" type="button" data-profile-tab="likes" aria-selected="false" role="tab">
      <span>♡</span> Curtidas <b>18</b>
    </button>
    <button class="profile-tab" type="button" data-profile-tab="reposts" aria-selected="false" role="tab">
      <span>↗</span> Republicados <b>6</b>
    </button>
  </nav>

  <section class="profile-tab-panel active" id="profile-posts" data-profile-panel="posts" aria-label="Publicações" role="tabpanel">
    <div class="section-heading profile-section-heading">
      <div><span class="eyebrow">Sua biblioteca pública</span><h2>O que você compartilhou</h2></div>
      <span class="section-heading__meta">Mais recentes</span>
    </div>

    <div class="list profile-posts">
      <article class="post profile-post card">
        <div class="profile-post__marker">01</div>
        <div class="post__meta"><strong>Enzo Diccini</strong><span>@enzo · ontem</span></div>
        <p class="post__body">Primeira publicação de exemplo para mostrar a área de perfil.</p>
        <div class="post__footer"><span class="muted">♡ 18 curtidas</span><span class="muted"><?= icon('message') ?> 4 comentários</span><button class="btn btn-ghost" type="button" data-action="placeholder" data-message="Publicação compartilhada."><?= icon('send') ?></button></div>
      </article>
      <article class="post profile-post card">
        <div class="profile-post__marker">02</div>
        <div class="post__meta"><strong>Enzo Diccini</strong><span>@enzo · há 2 dias</span></div>
        <p class="post__body">Outra publicação para repetir o padrão visual e destacar suas ideias.</p>
        <div class="post__footer"><span class="muted">♡ 9 curtidas</span><span class="muted"><?= icon('message') ?> 2 comentários</span><button class="btn btn-ghost" type="button" data-action="placeholder" data-message="Publicação compartilhada."><?= icon('send') ?></button></div>
      </article>
    </div>
  </section>

  <section class="profile-tab-panel" data-profile-panel="likes" aria-label="Publicações curtidas" role="tabpanel" hidden>
    <div class="section-heading profile-section-heading"><div><span class="eyebrow">Sua curadoria</span><h2>Ideias que você guardou</h2></div><span class="section-heading__meta">Curtidas</span></div>
    <article class="post profile-post card"><div class="profile-post__marker">01</div><div class="post__meta"><strong>Maria Souza</strong><span>@maria · há 5 min</span></div><p class="post__body">Hoje tivemos uma aula incrível de biologia!</p><div class="post__footer"><span class="muted">Você curtiu · 12 curtidas</span></div></article>
  </section>

  <section class="profile-tab-panel" data-profile-panel="reposts" aria-label="Publicações republicadas" role="tabpanel" hidden>
    <div class="section-heading profile-section-heading"><div><span class="eyebrow">Sua rede</span><h2>O que você levou adiante</h2></div><span class="section-heading__meta">Republicados</span></div>
    <article class="post profile-post card"><div class="profile-post__marker">01</div><div class="post__meta"><strong>Lucas Alves</strong><span>@lucas · há 1 h</span></div><p class="post__body">Alguém tem resumo de matemática? Posso compartilhar o meu também.</p><div class="post__footer"><span class="muted">Republicado por você · 7 curtidas</span></div></article>
  </section>
</div>
