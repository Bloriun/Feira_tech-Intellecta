<?php

declare(strict_types=1);

return [
    'people' => [
        ['name' => 'enzo', 'username' => 'enzo', 'bio' => 'descrição de alguma coisa ai ele é gay'],
        ['name' => 'matheus', 'username' => 'matheus', 'bio' => 'Aluno interessado em tecnologia e design.'],
        ['name' => 'ana vicente', 'username' => 'anavicente', 'bio' => 'Compartilhando estudos e anotações.'],
        ['name' => 'ariadiny', 'username' => 'ariadiny', 'bio' => 'Criando e aprendendo todos os dias.'],
    ],
    'feed' => [
        ['name' => 'Maria Souza', 'username' => 'maria', 'time' => 'há 5 min', 'body' => 'Hoje tivemos uma aula incrível de biologia!', 'likes' => 12, 'comments' => 3],
        ['name' => 'Lucas Alves', 'username' => 'lucas', 'time' => 'há 1 h', 'body' => 'Alguém tem resumo de matemática? Posso compartilhar o meu também.', 'likes' => 7, 'comments' => 2],
    ],
    'notifications' => [
        ['actor' => 'Maria Souza', 'type' => 'curtiu sua publicação', 'time' => '10:20'],
        ['actor' => 'Lucas Alves', 'type' => 'começou a seguir você', 'time' => '09:45'],
        ['actor' => 'Ana Vicente', 'type' => 'comentou sua publicação', 'time' => 'Ontem'],
    ],
    'messages' => [
        ['side' => 'left', 'name' => 'matheus', 'time' => '10:12', 'text' => 'Oi, você viu o aviso da escola?'],
        ['side' => 'right', 'name' => 'você', 'time' => '10:13', 'text' => 'Vi sim, já estou organizando as tarefas.'],
        ['side' => 'left', 'name' => 'matheus', 'time' => '10:14', 'text' => 'Perfeito. Se precisar, eu mando o resumo depois.'],
    ],
];
