const mongoose = require("mongoose")

const postSchema = new mongoose.Schema({
    title: {
        type: String,
        required: [true, "Les postes doivent avoir un titre!"]
    },
    body: {
        type: String,
        required: [true, "Un poste sans poste n'est pas un poste"]
    }
});

const Post = mongoose.model("Post", postSchema)
module.exports = Post;