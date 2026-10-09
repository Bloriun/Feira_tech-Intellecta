<?php declare(strict_types=1); ?>

<header class="page-header profile-page-header">
  <div>
    <span class="eyebrow">Sua presença no Intellecta</span>
    <h1>Meu perfil</h1>
  </div>
</header>

<div class="page-content profile-page">
  <section class="profile-identity" aria-labelledby="profile-name">
    <div class="profile-orbit">
      <span class="profile-orbit__ring"></span>
      <div class="avatar avatar--large">E</div>
      <span class="profile-status" aria-label="Online"></span>
    </div>

    <div class="profile-identity__main">
      <div class="profile-name-row">
        <div>
          <span class="eyebrow">Perfil público</span>
          <h2 id="profile-name">Enzo Diccini</h2>
          <p class="profile-handle">@enzo</p>
        </div>
        <span class="profile-presence"><i></i> online agora</span>
      </div>

      <p class="profile-bio">
        Aprendendo, criando e compartilhando descobertas todos os dias.
      </p>

      <div class="profile-details">
        <span><?= icon('spark') ?> Tecnologia &amp; design</span>
        <span>Intellecta desde 2024</span>
      </div>
    </div>
  </section>

  <section class="profile-metrics" aria-label="Resumo do perfil">
    <div><strong>24</strong><span>publicações</span></div>
    <div><strong>182</strong><span>seguidores</span></div>
    <div><strong>96</strong><span>seguindo</span></div>
  </section>

  <nav class="profile-tabs" aria-label="Conteúdo do perfil">
    <button class="profile-tab active" type="button" data-profile-tab="posts" aria-selected="true">
      Publicações <span>24</span>
    </button>
    <button class="profile-tab" type="button" data-profile-tab="likes" aria-selected="false">
      Curtidas <span>18</span>
    </button>
    <button class="profile-tab" type="button" data-profile-tab="reposts" aria-selected="false">
      Republicados <span>6</span>
    </button>
  </nav>

  <section class="profile-tab-panel active" data-profile-panel="posts" aria-label="Publicações">
    <div class="section-heading">
      <h2>O que você compartilhou</h2>
      <span class="eyebrow">Mais recentes</span>
    </div>

    <div class="list profile-posts">
      <article class="post">
        <div class="post__meta">
          <strong>Enzo Diccini</strong>
          <span>@enzo · ontem</span>
        </div>
        <p class="post__body">Primeira publicação de exemplo para mostrar a área de perfil.</p>
        <div class="post__footer">
          <span class="muted">♡ 18 curtidas</span>
          <span class="muted"><?= icon('message') ?> 4 comentários</span>
        </div>
      </article>

      <article class="post">
        <div class="post__meta">
          <strong>Enzo Diccini</strong>
          <span>@enzo · há 2 dias</span>
        </div>
        <p class="post__body">Outra publicação para repetir o padrão visual e destacar suas ideias.</p>
        <div class="post__footer">
          <span class="muted">♡ 9 curtidas</span>
          <span class="muted"><?= icon('message') ?> 2 comentários</span>
        </div>
      </article>
    </div>
  </section>

  <section class="profile-tab-panel" data-profile-panel="likes" aria-label="Publicações curtidas" hidden>
    <div class="section-heading">
      <h2>Ideias que você guardou</h2>
      <span class="eyebrow">Curtidas</span>
    </div>
    <article class="post">
      <div class="post__meta">
        <strong>Maria Souza</strong>
        <span>@maria · há 5 min</span>
      </div>
      <p class="post__body">Hoje tivemos uma aula incrível de biologia!</p>
      <div class="post__footer">
        <span class="muted">Você curtiu · 12 curtidas</span>
      </div>
    </article>
  </section>

  <section class="profile-tab-panel" data-profile-panel="reposts" aria-label="Publicações republicadas" hidden>
    <div class="section-heading">
      <h2>O que você levou adiante</h2>
      <span class="eyebrow">Republicados</span>
    </div>
    <article class="post">
      <div class="post__meta">
        <strong>Lucas Alves</strong>
        <span>@lucas · há 1 h</span>
      </div>
      <p class="post__body">Alguém tem resumo de matemática? Posso compartilhar o meu também.</p>
      <div class="post__footer">
        <span class="muted">Republicado por você · 7 curtidas</span>
      </div>
    </article>
  </section>
</div>
