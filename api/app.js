const port = 3000
const dataPath = "./data.json"
const testDataSize = 1000;

const express = require('express')
const app = express()
const fs = require('fs');


function generateTestData(count = testDataSize) {
    let randomNumbers = [];

    for (let i = 0; i < count; i++) {
        randomNumbers.push(getRandomNumberString(12))
    }
    fs.writeFileSync(dataPath, JSON.stringify(randomNumbers, null, 2));
}

function getRandomNumberString(length) {
    let num = "";

    for (let i = 0; i < length; i++) {
        num += Math.floor(Math.random() * 9)
    }

    return num;
}

generateTestData();

app.get('/', (req, res) => {
  res.send('Hello World!')
})

app.get('/getdata', (req, res) => {
    res.json(JSON.parse(fs.readFileSync(dataPath)));
});

app.get('/regenerate', (req, res) => {
    generateTestData();
    res.status(200).send("Generated new test data.");
});

app.listen(port, () => {
  console.log(`Example app listening on port ${port}`)
})
