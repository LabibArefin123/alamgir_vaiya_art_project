// detect_file.js
// Run with: node detect_file.js

const fs = require("fs");
const path = require("path");

const projectRoot = process.cwd();

function readFileSafe(filePath) {
    try {
        return fs.readFileSync(filePath, "utf8");
    } catch {
        return "";
    }
}

function checkFileExists(filePath) {
    return fs.existsSync(filePath);
}

function scanFolder(folder, keyword) {
    if (!checkFileExists(folder)) return false;

    const files = fs.readdirSync(folder);

    for (const file of files) {
        const fullPath = path.join(folder, file);

        if (fs.statSync(fullPath).isDirectory()) {
            if (scanFolder(fullPath, keyword)) return true;
        } else {
            const content = readFileSafe(fullPath);
            if (content.includes(keyword)) return true;
        }
    }

    return false;
}

function detectFrameworks() {
    console.log("🔍 Scanning Laravel project...\n");

    const packageJson = readFileSafe(path.join(projectRoot, "package.json"));
    const appJs = readFileSafe(path.join(projectRoot, "resources/js/app.js"));

    const results = {
        Vue: false,
        React: false,
        Alpine: false,
        Livewire: false,
    };

    // Vue detection
    if (
        packageJson.includes("vue") ||
        appJs.includes("vue") ||
        scanFolder("resources/views", "<template")
    ) {
        results.Vue = true;
    }

    // React detection
    if (
        packageJson.includes("react") ||
        appJs.includes("react") ||
        scanFolder("resources/js", "ReactDOM")
    ) {
        results.React = true;
    }

    // Alpine detection
    if (
        packageJson.includes("alpinejs") ||
        scanFolder("resources/views", "x-data")
    ) {
        results.Alpine = true;
    }

    // Livewire detection
    if (
        packageJson.includes("livewire") ||
        scanFolder("resources/views", "wire:")
    ) {
        results.Livewire = true;
    }

    console.log("📦 Framework Detection Result:\n");

    Object.entries(results).forEach(([framework, detected]) => {
        console.log(`${detected ? "✅" : "❌"} ${framework}`);
    });

    console.log("\nDone.");
}

detectFrameworks();
