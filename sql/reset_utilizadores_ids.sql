-- ============================================================
-- Lone Wolf — Renumerar IDs dos utilizadores
-- Admin = 1, restantes = 2, 3, 4, 5...
--
-- Como executar (phpMyAdmin):
--   1. Seleciona a base de dados "lonewolf_db"
--   2. Separador SQL → cola este ficheiro → Executar
--
-- IMPORTANTE: Faz backup antes (Exportar → utilizadores, conversas...)
-- ============================================================

USE lonewolf_db;

SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;

-- ------------------------------------------------------------
-- OPÇÃO A — Script genérico (funciona com qualquer nº de contas)
-- Admin fica sempre #1; os restantes ficam 2, 3, 4... por ordem de ID antigo
-- ------------------------------------------------------------

DROP TEMPORARY TABLE IF EXISTS tmp_user_remap;
CREATE TEMPORARY TABLE tmp_user_remap (
    old_id INT NOT NULL PRIMARY KEY,
    new_id INT NOT NULL
);

SET @ordem := 0;

INSERT INTO tmp_user_remap (old_id, new_id)
SELECT u.id,
       (@ordem := @ordem + 1) AS new_id
FROM utilizadores u
ORDER BY
    CASE WHEN u.tipo = 'admin' THEN 0 ELSE 1 END,
    u.id ASC;

-- Passo 1: IDs temporários altos (evita conflitos ao trocar)
UPDATE utilizadores u
INNER JOIN tmp_user_remap t ON t.old_id = u.id
SET u.id = t.old_id + 100000
WHERE t.old_id <> t.new_id;

UPDATE conversas c
INNER JOIN tmp_user_remap t ON c.user_id = t.old_id
SET c.user_id = t.old_id + 100000
WHERE c.user_id IS NOT NULL AND t.old_id <> t.new_id;

UPDATE encomendas e
INNER JOIN tmp_user_remap t ON e.user_id = t.old_id
SET e.user_id = t.old_id + 100000
WHERE t.old_id <> t.new_id;

UPDATE favoritos f
INNER JOIN tmp_user_remap t ON f.user_id = t.old_id
SET f.user_id = t.old_id + 100000
WHERE t.old_id <> t.new_id;

-- Passo 2: IDs finais
UPDATE utilizadores u
INNER JOIN tmp_user_remap t ON u.id = t.old_id + 100000
SET u.id = t.new_id
WHERE t.old_id <> t.new_id;

UPDATE conversas c
INNER JOIN tmp_user_remap t ON c.user_id = t.old_id + 100000
SET c.user_id = t.new_id
WHERE c.user_id IS NOT NULL AND t.old_id <> t.new_id;

UPDATE encomendas e
INNER JOIN tmp_user_remap t ON e.user_id = t.old_id + 100000
SET e.user_id = t.new_id
WHERE t.old_id <> t.new_id;

UPDATE favoritos f
INNER JOIN tmp_user_remap t ON f.user_id = t.old_id + 100000
SET f.user_id = t.new_id
WHERE t.old_id <> t.new_id;

-- Próximo registo novo = MAX(id) + 1
SET @proximo_id := (SELECT IFNULL(MAX(id), 0) + 1 FROM utilizadores);
SET @sql_ai := CONCAT('ALTER TABLE utilizadores AUTO_INCREMENT = ', @proximo_id);
PREPARE stmt FROM @sql_ai;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- Verificar resultado:
SELECT id, nome, email, tipo FROM utilizadores ORDER BY id ASC;
