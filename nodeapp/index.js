const express = require("express");

const app = express();
const mongoose = require('mongoose');
const {MONGO_USER, MONGO_PASSWORD, MONGO_IP, MONGO_PORT} = require("./config/config")

mongoose
.connect(`mongodb://${MONGO_USER}:${MONGO_PASSWORD}@${MONGO_IP}:${MONGO_PORT}/?authSource=admin`)
.then(() => console.log("connexion à la database réussie"))
.catch((e) => console.log(e))

app.get("/", (req, res) => {
    res.send ("<h2> Voyons voyons</h2>")
});

const port = process.env.PORT || 3000;

app.listen(port, () => console.log('listening on port ${port}'));