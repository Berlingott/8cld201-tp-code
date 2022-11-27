const express = require("express")
const AuthenticatonControl = require("../control/authentification")
const router = express.Router()


router.post("/enregistrerUtilisateur", AuthenticatonControl.enregistrerUtilisateur)
router.post("/connexion", AuthenticatonControl.connexion)

module.exports = router