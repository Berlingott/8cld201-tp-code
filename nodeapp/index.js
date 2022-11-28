
const express = require("express");
const mongoose = require("mongoose");
const postRouter = require("./routes/postesroutes");

const session = require("express-session");
const redis = require("redis");
let RedisStore = require("connect-redis")(session);
const utilisateurRouter = require("./routes/routeUtilisateur");
const app = express();
const port = process.env.PORT || 3000;
const {MONGO_USER, MONGO_PASSWORD, MONGO_IP, MONGO_PORT, REDIS_URL, REDIS_PORT, SECRET_SESSION} = require("./config/config");

let redisClient = redis.createClient({
    host: REDIS_URL,
    port: REDIS_PORT
});

 
mongoose
.connect(`mongodb://${MONGO_USER}:${MONGO_PASSWORD}@${MONGO_IP}:${MONGO_PORT}/?authSource=admin`)
.then(() => console.log("connexion à la database réussie"))
.catch((e) => console.log(e))

/*app.use(
    session({
        store: new RedisStore({client:redisClient}),
        secret: "SECRET_SESSION",
        cookie:{
            secure: false,
            resave: false,
            saveUninitialized:false,
            httpOnly:true,
            maxAge:15000000
        }
    })
);*/

app.use(express.json());
app.get("/", (req, res) => {
    res.send ("<h2> Voyons voyons</h2>");
});
app.use("/api/postes", postRouter);
app.use("/api/utilisateurs", utilisateurRouter);
app.listen(port, () => console.log(`listening on port ${port}`));