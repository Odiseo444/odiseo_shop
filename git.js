const readline = require("readline");
const { exec } = require("child_process");

// Preparamos la entrada por consola
const rl = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});

rl.question("📝 Escribe tu mensaje de commit: ", (mensaje) => {
  // Comando combinado
  const comando = `git add . && git commit -m "${mensaje}" && git push origin main`;

  console.log("\n🚀 Ejecutando comandos Git...\n");
  exec(comando, (error, stdout, stderr) => {
    if (error) {
      console.error(`❌ Error: ${error.message}`);
    } else if (stderr) {
      console.error(`⚠️ stderr: ${stderr}`);
    } else {
      console.log(`✅ Completado:\n${stdout}`);
    }
    rl.close();
  });
});
