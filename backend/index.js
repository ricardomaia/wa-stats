const express = require("express");
const http = require("http");
const path = require("path");
const reload = require("reload");
const bodyParser = require("body-parser");
const logger = require("morgan");
const fs = require("fs");
const cors = require("cors");

var app = express();
app.use(logger("dev"));
app.use(bodyParser.json());
var publicDir = path.join(__dirname, "public");

app.use(express.urlencoded({ extended: false }));

corsOptions = {
  origin: "*",
  optionsSuccessStatus: 200, // some legacy browsers (IE11, various SmartTVs) choke on 204
};
app.use(cors(corsOptions));
app.set("port", process.env.PORT || 3000);
app.use(express.static("public"));

// Reload code here
reload(app)
  .then(function (reloadReturned) {
    // reloadReturned is documented in the returns API in the README

    // Reload started, start web server
    server.listen(app.get("port"), function () {
      console.log("Web server listening on port " + app.get("port"));
    });
  })
  .catch(function (err) {
    console.error(
      "Reload could not start, could not start server/sample app",
      err
    );
  });
var server = http.createServer(app);

/**
 *
 */
app.get("/foo", (req, res) => {
  res.send("fgsfdgsdgsdfg");
});
