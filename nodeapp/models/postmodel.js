const mongoose = require("mongoose")
const { stringify } = require("querystring")

const posteSchema = new mongoose.Schema({
    title: {
        type: String,
        require: [true, "Les postes doivent avoir un titre!"]
    },
    body: {
        type: String,
        require: [true, "Un poste sans poste n'est pas un poste"]
    }
});


const Poste = mongoose.model("Poste", posteSchema)
module.exports = Poste;