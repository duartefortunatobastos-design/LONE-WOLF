import { spawn } from "node:child_process";
import fs from "node:fs";
import net from "node:net";
import path from "node:path";
import { fileURLToPath } from "node:url";

const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), "..");

function encontrarPhp() {
  const candidatos = [
    process.env.PHP_PATH,
    process.env.PHP_BIN,
    path.resolve(root, "..", "..", "xampp", "php", "php.exe"),
    path.resolve(root, "..", "xampp", "php", "php.exe"),
    "C:\\xampp\\php\\php.exe",
    "C:\\Program Files\\PHP\\php.exe",
    "php",
  ].filter(Boolean);

  for (const candidato of candidatos) {
    if (candidato === "php" || fs.existsSync(candidato)) {
      return candidato;
    }
  }

  return candidatos[0] || "php";
}

const php = encontrarPhp();
const host = process.env.DEV_HOST || "localhost";
const port = process.env.DEV_PORT || "8000";
const url = `http://${host}:${port}`;

function portaAberta(porta, alvo = "127.0.0.1") {
  return new Promise((resolve) => {
    const socket = net.createConnection({ port: porta, host: alvo }, () => {
      socket.end();
      resolve(true);
    });

    socket.on("error", () => resolve(false));
    socket.setTimeout(1500, () => {
      socket.destroy();
      resolve(false);
    });
  });
}

function encontrarMysqlStart() {
  const candidatos = [
    path.resolve(root, "..", "..", "xampp", "mysql_start.bat"),
    path.resolve(root, "..", "xampp", "mysql_start.bat"),
    "C:\\xampp\\mysql_start.bat",
  ];

  return candidatos.find((candidato) => fs.existsSync(candidato));
}

async function garantirMysql() {
  if (await portaAberta(3306)) return;

  const mysqlStart = encontrarMysqlStart();
  if (!mysqlStart) {
    console.warn("\nAviso: MySQL nao esta a correr na porta 3306.");
    console.warn("Inicia o MySQL no XAMPP Control Panel para a base de dados funcionar.\n");
    return;
  }

  console.log("MySQL nao detectado. A iniciar via XAMPP...");
  spawn("cmd", ["/c", mysqlStart], { stdio: "ignore", shell: false });

  for (let tentativa = 0; tentativa < 10; tentativa += 1) {
    await new Promise((resolve) => setTimeout(resolve, 1000));
    if (await portaAberta(3306)) {
      console.log("MySQL iniciado com sucesso.\n");
      return;
    }
  }

  console.warn("\nAviso: Nao foi possivel confirmar que o MySQL arrancou.\n");
}

function abrirChrome() {
  if (process.env.DEV_OPEN_BROWSER === "false") return;

  const chromePaths = [
    process.env.CHROME_PATH,
    "C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe",
    "C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe",
    path.join(process.env.LOCALAPPDATA || "", "Google", "Chrome", "Application", "chrome.exe"),
  ].filter(Boolean);

  const chrome = chromePaths.find((chromePath) => fs.existsSync(chromePath));

  if (chrome) {
    spawn(chrome, [url], { detached: true, stdio: "ignore", shell: false }).unref();
    return;
  }

  if (process.platform === "win32") {
    spawn("cmd", ["/c", "start", "chrome", url], {
      detached: true,
      stdio: "ignore",
      shell: false,
    }).unref();
    return;
  }

  if (process.platform === "darwin") {
    spawn("open", ["-a", "Google Chrome", url], {
      detached: true,
      stdio: "ignore",
      shell: false,
    }).unref();
  }
}

async function iniciar() {
  await garantirMysql();

  const server = spawn(php, ["-S", `${host}:${port}`], {
    cwd: root,
    stdio: "inherit",
    shell: false,
  });

  server.on("spawn", () => {
    setTimeout(abrirChrome, 800);
  });

  server.on("error", (error) => {
    console.error("\nNao foi possivel iniciar o PHP.");
    console.error(`Caminho esperado: ${php}`);
    console.error(error.message);
    process.exit(1);
  });

  server.on("close", (code) => {
    process.exit(code ?? 0);
  });

  process.on("SIGINT", () => server.kill("SIGINT"));
  process.on("SIGTERM", () => server.kill("SIGTERM"));
}

iniciar();
