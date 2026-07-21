import { spawnSync } from "node:child_process";
import fs from "node:fs";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");
const php = path.resolve(root, "..", "..", "..", "php", "php.exe");

function collectPhpFiles(dir, files = []) {
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    if (entry.name === "node_modules" || entry.name === ".git") continue;

    const fullPath = path.join(dir, entry.name);
    if (entry.isDirectory()) {
      collectPhpFiles(fullPath, files);
    } else if (entry.isFile() && entry.name.endsWith(".php")) {
      files.push(fullPath);
    }
  }

  return files;
}

if (!fs.existsSync(php)) {
  console.error(`PHP nao encontrado em: ${php}`);
  process.exit(1);
}

const files = collectPhpFiles(root);
let hasErrors = false;

for (const file of files) {
  const result = spawnSync(php, ["-l", file], { encoding: "utf8" });
  const output = `${result.stdout}${result.stderr}`.trim();

  if (result.status !== 0) {
    hasErrors = true;
    console.error(output);
  }
}

if (hasErrors) {
  process.exit(1);
}

console.log(`Sem erros de sintaxe em ${files.length} ficheiros PHP.`);
