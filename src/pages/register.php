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
      <p class="mt-5 soft">Crie sua conta e comece a explorar a comunidade escolar.</p>
    </div>
  </section>

  <section class="flex items-center justify-center p-6">
    <div class="card p-7 w-full max-w-md">
      <h2 class="text-2xl font-semibold">Criar conta</h2>
      <p class="soft mt-2">Formulário visual seguindo a mesma identidade do login.</p>

      <form class="mt-6 space-y-4" onsubmit="return false;">
        <input class="input rounded-xl" placeholder="Nome completo">
        <input class="input rounded-xl" placeholder="Nome de usuário">
        <input class="input rounded-xl" type="email" placeholder="E-mail">
        <input class="input rounded-xl" type="password" placeholder="Senha">

        <div class="grid gap-2 text-xs soft">
          <span>• mínimo de 8 caracteres</span>
          <span>• uma letra maiúscula</span>
          <span>• um número</span>
          <span>• um caractere especial</span>
        </div>

        <label class="text-xs soft"><input type="checkbox"> Aceito os Termos de Uso e a Política de Privacidade.</label>
        <button class="btn btn-primary w-full" type="button">Criar conta</button>
      </form>

      <div class="grid grid-cols-2 gap-3 mt-4">
        <button class="btn btn-secondary text-sm" type="button">Google</button>
        <button class="btn btn-secondary text-sm" type="button">Microsoft</button>
      </div>

      <p class="text-center text-sm soft mt-6">Já tem uma conta? <a class="text-olive" href="?page=login">Entrar</a></p>
    </div>
  </section>
</div>
