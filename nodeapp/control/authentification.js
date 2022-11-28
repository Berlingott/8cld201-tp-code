const Utilisateur = require("../models/modelutilisateur");
const bcrypt = require("bcryptjs")

exports.enregistrerUtilisateur = async (req, res) => {
    const {pseudo, motdepasse} = req.body
    const hashmotdepasse = await bcrypt.hash(motdepasse, 15)
    try{
       const nouvelUtilisateur = await  Utilisateur.create({
        pseudo,
        motdepasse : hashmotdepasse
    });
       res.status(200).json({
        status: "success",
        data: {
            Utilisateur: nouvelUtilisateur
        }
       })
    }catch(e){
        res.status(500).json({
            status:"Erreur " + e
        })
        
    }
};

exports.connexion = async (req, res) => {
    const {pseudo, motdepasse} = req.body
    try{
     const utilisateur = await Utilisateur.findOne({pseudo});
     if(!utilisateur) {
        res.status(400).json({
            status: 'echec',
            message: "Il n'y a pas d'utilisateur avec ce pseudo",
        });
     }

     const bonMotdepasse= await bcrypt.compare(motdepasse, utilisateur.motdepasse)

     if(bonMotdepasse){
        //req.session.utilisateur = utilisateur;
        res.status(200).json({
            status:"success"
        });
     }else{
        res.status(400).json({
            status:"echec",
            message: "mauvais mot de passe"
        });
     }  } catch(e) {
        res.status(500).json({
            status:"Erreur " + e
        })
    }    
}