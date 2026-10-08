<?php

declare(strict_types=1);
?>
<div class="min-h-screen grid lg:grid-cols-2">
  <section class="hidden lg:flex p-12 flex-col justify-between bg-gradient-to-br from-[#11140C] to-[#252b1d]">
    <div>
      <div class="text-4xl font-serif">ℐ</div>
      <div class="text-xs tracking-[.3em]">INTELLECTA</div>
    </div>
    <div class="max-w-md">
      <h1 class="text-5xl font-semibold leading-tight">Sua inteligência<br>em <span class="text-olive">um só lugar.</span></h1>
      <p class="mt-5 soft">Explore, crie e organize suas ideias com o poder da IA.</p>
      <div class="mt-10 space-y-5 text-sm">
        <p>⚡ <b>Mais produtividade</b><br><span class="ml-6 soft">Respostas rápidas e precisas</span></p>
        <p>▣ <b>Organização inteligente</b><br><span class="ml-6 soft">Suas conversas sempre acessíveis</span></p>
        <p>♢ <b>Segurança em primeiro lugar</b><br><span class="ml-6 soft">Seus dados protegidos</span></p>
      </div>
    </div>
  </section>

  <section class="flex items-center justify-center p-6">
    <div class="card p-7 w-full max-w-md">
      <div class="lg:hidden mb-8">
        <div class="text-3xl font-serif">ℐ</div>
        <div class="text-[10px] tracking-[.3em]">INTELLECTA</div>
      </div>
      <h2 class="text-2xl font-semibold">Entrar na sua conta</h2>
      <p class="soft mt-2">Acesse o Intellecta e continue de onde parou.</p>

      <form class="mt-6 space-y-4" onsubmit="return false;">
        <input class="input rounded-xl" type="email" placeholder="seu@email.com">
        <input class="input rounded-xl" type="password" placeholder="Digite sua senha">

        <div class="flex justify-between text-xs soft">
          <label><input type="checkbox"> Lembrar de mim</label>
          <a href="#" onclick="alert('Recuperação de senha será conectada depois.'); return false;">Esqueceu a senha?</a>
        </div>

        <button class="btn btn-primary w-full" type="button">Entrar →</button>
      </form>

      <div class="flex items-center gap-3 my-5 text-xs soft">
        <span class="h-px bg-line flex-1"></span>
        ou continue com
        <span class="h-px bg-line flex-1"></span>
      </div>

      <div class="grid grid-cols-2 gap-3">
        <button class="btn btn-secondary text-sm" type="button">Entrar com Google</button>
        <button class="btn btn-secondary text-sm" type="button">Entrar com Microsoft</button>
      </div>

      <p class="text-center text-sm soft mt-6">Ainda não tem uma conta? <a class="text-olive" href="?page=register">Criar conta</a></p>
    </div>
  </section>
</div>
