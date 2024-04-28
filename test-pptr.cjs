const puppeteer = require('puppeteer');

async function checkChromiumPath() {
    const browser = await puppeteer.launch();
    console.log('Chromium path:', puppeteer.executablePath());
    await browser.close();
}

checkChromiumPath();

