const mongoose = require("mongoose")

const utilisateurSchema = new mongoose.Schema({
    pseudo: {
        type: String,
        required:[true, "Un nom d'utilisateur est requis pour créer un utilisateur"],
        unique: true
    },
    motdepasse : {
        type: String,
        required:[true, "Un mot de passe est requis pour créer un utilisateur"]
    }
});

const Utilisateur = mongoose.model("Utilisateur", utilisateurSchema);
module.exports = Utilisateur;