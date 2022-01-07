const {createServer} = require("http");
let server = createServer((request, response) => {
	response.writeHead(200, {"Content-Type": "text/html"});
	response.write(`
		<h1>hello</h1>
		<p>you are looking<code>${request.url}</code></p>`);
	response.end();
});
server.listen(8080);
console.log('listen (port 8080)');