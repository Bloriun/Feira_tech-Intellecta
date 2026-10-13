<?php declare(strict_types=1); ?>

<header class="page-header"><div><span class="eyebrow">Estamos aqui para ajudar</span><h1>Central de ajuda</h1></div></header>
<div class="page-content help-page">
  <section class="help-hero card"><span class="eyebrow">Encontre uma resposta</span><h2>Como podemos deixar sua experiência melhor?</h2><input class="input" data-help-search placeholder="Pesquisar na ajuda"></section>
  <div class="faq-list">
    <?php foreach ([['Como publicar uma ideia?', 'Use o campo no início para escrever e escolha Publicar. Sua publicação aparece no feed imediatamente nesta demonstração.'], ['Como salvo uma publicação?', 'Toque no marcador de qualquer publicação. Ela fica disponível na sua coleção Salvos.'], ['Meus dados ficam online?', 'Não. Esta versão usa dados demonstrativos e guarda apenas preferências no armazenamento local do navegador.'], ['Como falar com alguém?', 'Abra Conversas e escolha uma pessoa para iniciar uma troca de mensagens local.']] as [$question, $answer]): ?>
      <details class="faq-item card"><summary><?= e($question) ?><span><?= icon('chevron') ?></span></summary><p><?= e($answer) ?></p></details>
    <?php endforeach; ?>
  </div>
  <p class="help-contact">Não encontrou? <a class="text-link" href="mailto:oi@intellecta.local">Fale com a equipe →</a></p>
</div>
