<?php declare(strict_types=1); ?>

<div class="auth-page">
  <section class="auth-visual">
    <?php render_logo('?page=login'); ?>

    <div class="auth-visual__copy">
      <span class="eyebrow">Sua comunidade de aprendizado</span>
      <h1>Ideias que<br><span>movem</span> você.</h1>
      <p>
        Um espaço leve para estudar, trocar conhecimento e transformar
        curiosidade em descoberta.
      </p>

      <div class="auth-benefits">
        <div class="auth-benefit">
          <span class="benefit-icon"><?= icon('spark') ?></span>
          <div>
            <b>Aprenda em comunidade</b>
            <span>Conecte-se a pessoas que compartilham seus interesses.</span>
          </div>
        </div>
        <div class="auth-benefit">
          <span class="benefit-icon"><?= icon('message') ?></span>
          <div>
            <b>Tenha clareza para criar</b>
            <span>Organize suas conversas, projetos e próximos passos.</span>
          </div>
        </div>
      </div>
    </div>

    <small class="muted">© 2024 Intellecta · Feito para quem não para de aprender.</small>
  </section>

  <section class="auth-form-wrap">
    <div class="auth-card card">
      <span class="eyebrow">Bem-vindo de volta</span>
      <h2>Entre na sua conta</h2>
      <p>Continue de onde você parou.</p>

      <form class="form-stack" data-demo-form data-success="Login demonstrativo realizado. Bem-vindo de volta!">
        <label class="form-label" for="login-email">
          E-mail
          <input class="input" id="login-email" type="email" autocomplete="email" placeholder="voce@exemplo.com" required>
        </label>
        <label class="form-label" for="login-password">
          Senha
          <input class="input" id="login-password" type="password" autocomplete="current-password" placeholder="Sua senha" required>
        </label>
        <div class="form-row">
          <label><input type="checkbox"> Lembrar de mim</label>
          <a href="#" data-action="placeholder" data-message="A recuperação de senha será conectada em breve.">Esqueceu a senha?</a>
        </div>
        <button class="btn btn-primary" type="submit">Entrar <span aria-hidden="true">→</span></button>
      </form>

      <a class="btn btn-secondary auth-demo-link" href="?page=home">
        Explorar a demonstração <span aria-hidden="true">↗</span>
      </a>

      <div class="divider">ou continue com</div>
      <div class="social-grid">
        <button class="btn btn-secondary" type="button" data-action="placeholder" data-message="Login com Google será conectado em breve.">Google</button>
        <button class="btn btn-secondary" type="button" data-action="placeholder" data-message="Login com Microsoft será conectado em breve.">Microsoft</button>
      </div>

      <p class="auth-foot">Ainda não tem uma conta? <a href="?page=register">Criar conta</a></p>
    </div>
  </section>
</div>
