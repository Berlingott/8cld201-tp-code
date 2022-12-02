
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
const router = require("./routes/postesroutes");
const Post = require("./models/postmodel")

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


app.get("/home", (req, res) => {

    Post.find().exec(function(err, docs){
        docs= docs.map(o => o.toObject())
        let tmpString = "";

        for(let i=0; i<docs.length;i++){
            tmpString+= "<h3>Titre:"+docs[i]["title"]+"</h3><br>body:"+docs[i]["body"]+"<br>----------<br>";
        }

        res.send (tmpString); 
    });
   


});


app.use("/api/postes", postRouter);
app.use("/api/utilisateurs", utilisateurRouter);
app.listen(port, () => console.log(`listening on port ${port}`)); 
