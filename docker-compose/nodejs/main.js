const {readFile} = require("fs").promises;
readFile("lol.txt", "utf-8").then(text => console.log(text));
