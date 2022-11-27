const express = require("express");

const controlPoste = require("../control/controlPoste")

const router = express.Router()

router
    .route("/:id")
    .get(controlPoste.getOnePoste)
    .patch(controlPoste.createPoste)
    .delete(controlPoste.deletePoste)

router
    .route("/")
    .get(controlPoste.getAllPoste)
    .post(controlPoste.createPoste)

module.exports = router;




