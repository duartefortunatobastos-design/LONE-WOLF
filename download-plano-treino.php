<?php
require_once "includes/init.php";

$conteudo = <<<TXT
LONE WOLF — Plano de Treino Semanal
Atleta: Rui Bastos
Preparação para Maratona

SEGUNDA-FEIRA — Recuperação
Treino de recuperação, 35 minutos de corrida leve/lenta e 30 minutos de alongamentos.

TERÇA-FEIRA — Pace
1h15m de corrida com Pace 4'35/km - 4'45/km. Alongamentos no final.

QUARTA-FEIRA — Pace
1h15m de corrida com Pace 4'35/km - 4'45/km. Alongamentos no final.

QUINTA-FEIRA — Descanso Total
Descanso total. Exercícios de mobilidade e fortalecimento. Sessão de massagem de recuperação muscular.

SEXTA-FEIRA — Pace
1h15m de corrida com Pace 4'35/km - 4'45/km. Alongamentos no final.

SÁBADO — Pace
50 minutos de corrida com Pace 4'35/km - 4'45/km. Alongamentos no final.

DOMINGO — Treino Longo
1h35m de corrida com Pace 4'35/km - 4'45/km. Alongamentos no final.

---
Semana anterior à competição: reduzir volume para 35 min/dia com pace 4'45/km - 5'05/km.
Domingo: Prova — arriscar tudo.

Pós-maratona: 4 dias de descanso total + massagem de recuperação.

Lone Wolf — ruimbb@gmail.com
TXT;

header("Content-Type: text/plain; charset=UTF-8");
header('Content-Disposition: attachment; filename="plano-treino-lone-wolf.txt"');
header("Content-Length: " . strlen($conteudo));
echo $conteudo;
exit;
