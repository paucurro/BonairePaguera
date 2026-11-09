const vscode = require('vscode');
const fs = require('fs');
const path = require('path');
const cp = require('child_process');

let devItem;
let prodItem;
let watcher;
let output;

const DEV_COLOR = '#ff4d4f';
const PROD_COLOR = '#22c55e';
const SFTP_EXTENSION_ID = 'Natizyskunk.sftp';
const SFTP_REFRESH_COMMAND = 'sftp.remoteExplorer.refresh';

function activate(context) {
  output = vscode.window.createOutputChannel('SFTP Switcher by Polinetic');

  devItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 99);
  devItem.text = 'DEV';
  devItem.color = DEV_COLOR;
  devItem.command = 'covimaSftp.switchDev';
  devItem.tooltip = 'Cambiar SFTP a DEV';

  prodItem = vscode.window.createStatusBarItem(vscode.StatusBarAlignment.Left, 98);
  prodItem.text = 'PROD';
  prodItem.color = PROD_COLOR;
  prodItem.command = 'covimaSftp.switchProd';
  prodItem.tooltip = 'Cambiar SFTP a PROD';

  context.subscriptions.push(
    output,
    devItem,
    prodItem,
    vscode.commands.registerCommand('covimaSftp.switchDev', () => switchProfile('dev')),
    vscode.commands.registerCommand('covimaSftp.switchProd', () => switchProfile('prod'))
  );

  refresh();

  const folder = getWorkspaceFolder();
  if (folder) {
    const pattern = new vscode.RelativePattern(folder, '.vscode/sftp.json');
    watcher = vscode.workspace.createFileSystemWatcher(pattern);
    watcher.onDidChange(refresh);
    watcher.onDidCreate(refresh);
    watcher.onDidDelete(refresh);
    context.subscriptions.push(watcher);
  }
}

function deactivate() {}

function getWorkspaceFolder() {
  const folders = vscode.workspace.workspaceFolders || [];
  return folders.find((folder) => fs.existsSync(path.join(folder.uri.fsPath, '.vscode', 'sftp.json')));
}

function getPaths() {
  const folder = getWorkspaceFolder();
  if (!folder) {
    return null;
  }

  return {
    root: folder.uri.fsPath,
    sftp: path.join(folder.uri.fsPath, '.vscode', 'sftp.json'),
    script: path.join(folder.uri.fsPath, 'scripts', 'git', 'switch-sftp-profile.ps1')
  };
}

function readSftp() {
  const paths = getPaths();
  if (!paths || !fs.existsSync(paths.sftp)) {
    return null;
  }

  try {
    return JSON.parse(fs.readFileSync(paths.sftp, 'utf8'));
  } catch (error) {
    output.appendLine(`No se pudo leer sftp.json: ${error.message}`);
    return null;
  }
}

function getActiveProfile(config) {
  if (!config) {
    return null;
  }

  if (config.remotePath && config['prod-remotePath'] && config.remotePath === config['prod-remotePath']) {
    return 'prod';
  }

  if (config.remotePath && config['dev-remotePath'] && config.remotePath === config['dev-remotePath']) {
    return 'dev';
  }

  return null;
}

function refresh() {
  const active = getActiveProfile(readSftp());
  const paths = getPaths();

  if (!paths || !fs.existsSync(paths.sftp)) {
    devItem.hide();
    prodItem.hide();
    return;
  }

  devItem.text = 'DEV';
  prodItem.text = 'PROD';
  devItem.color = DEV_COLOR;
  prodItem.color = PROD_COLOR;
  devItem.tooltip = active === 'dev' ? 'SFTP activo: DEV' : 'Cambiar SFTP a DEV';
  prodItem.tooltip = active === 'prod' ? 'SFTP activo: PROD' : 'Cambiar SFTP a PROD';
  devItem.show();
  prodItem.show();
}

async function triggerSftpConfigReload(paths) {
  const uri = vscode.Uri.file(paths.sftp);
  const document = await vscode.workspace.openTextDocument(uri);

  if (document.isDirty) {
    output.appendLine('No se fuerza recarga SFTP porque sftp.json tiene cambios sin guardar.');
    return false;
  }

  const end = document.lineAt(document.lineCount - 1).range.end;
  const insertEdit = new vscode.WorkspaceEdit();
  insertEdit.insert(uri, end, ' ');

  if (!await vscode.workspace.applyEdit(insertEdit)) {
    return false;
  }

  await document.save();

  const removeEdit = new vscode.WorkspaceEdit();
  removeEdit.delete(uri, new vscode.Range(end, end.translate(0, 1)));

  if (!await vscode.workspace.applyEdit(removeEdit)) {
    return false;
  }

  await document.save();
  return true;
}

async function refreshSftpExtension() {
  const sftpExtension = vscode.extensions.getExtension(SFTP_EXTENSION_ID);

  if (sftpExtension && !sftpExtension.isActive) {
    await sftpExtension.activate();
  }

  await vscode.commands.executeCommand(SFTP_REFRESH_COMMAND);
  output.appendLine(`[sftp-switch] Ejecutado ${SFTP_REFRESH_COMMAND}`);
}

async function switchProfile(profile) {
  const paths = getPaths();
  if (!paths || !fs.existsSync(paths.script)) {
    vscode.window.showErrorMessage('No encuentro scripts/git/switch-sftp-profile.ps1 en este workspace.');
    return;
  }

  if (profile === 'prod') {
    const confirmed = await vscode.window.showWarningMessage(
      'Cambiar SFTP a PRODUCCION. A partir de ahora uploadOnSave subira a PROD.',
      { modal: true },
      'Cambiar a PROD'
    );

    if (confirmed !== 'Cambiar a PROD') {
      return;
    }
  }

  const args = [
    '-NoProfile',
    '-ExecutionPolicy',
    'Bypass',
    '-File',
    paths.script,
    '-Profile',
    profile
  ];

  cp.execFile('powershell.exe', args, { cwd: paths.root }, async (error, stdout, stderr) => {
    if (stdout) {
      output.appendLine(stdout.trim());
    }

    if (stderr) {
      output.appendLine(stderr.trim());
    }

    if (error) {
      vscode.window.showErrorMessage(`No se pudo cambiar SFTP a ${profile.toUpperCase()}. Mira "SFTP Switcher by Polinetic" en Output.`);
      return;
    }

    refresh();
    try {
      const reloadTriggered = await triggerSftpConfigReload(paths);
      if (!reloadTriggered) {
        vscode.window.showWarningMessage('SFTP cambiado, pero no pude forzar la recarga de la extension SFTP.');
      }

      await refreshSftpExtension();
    } catch (reloadError) {
      output.appendLine(`No se pudo forzar la recarga SFTP: ${reloadError.message}`);
      vscode.window.showWarningMessage('SFTP cambiado, pero no pude forzar la recarga de la extension SFTP.');
    }

    vscode.window.setStatusBarMessage(`SFTP cambiado a ${profile.toUpperCase()}`, 3000);
  });
}

module.exports = {
  activate,
  deactivate
};
