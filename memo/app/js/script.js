let counter = 0;
let firstSelection = "";
let secondSelection = "";

const cards = document.querySelectorAll(".cards .card");
cards.forEach((card) => {
  card.addEventListener("click", () => {
    card.classList.add("clicked");

    if(counter === 0){
      firstSelection = card.getAttribute("element");
      num = card.getAttribute("number");
      card.classList.add("found");
      counter++;
    }
    else{
      secondSelection = card.getAttribute("element");
      counter = 0;
      document.querySelector(".card[number='"+num+"']").classList.remove("found")
      console.log(".card[number'"+num+"']");
      if(firstSelection === secondSelection){
        const correctCards = document.querySelectorAll(".card[element='"+firstSelection+"']");
        correctCards[0].classList.add("checked");
        correctCards[0].classList.remove("clicked");
        correctCards[1].classList.add("checked");
        correctCards[1].classList.remove("clicked");
        correctCards[0].classList.add("found");
        correctCards[1].classList.add("found");
      }
      else{
        const incorrectCards = document.querySelectorAll(".card.clicked");

        incorrectCards[0].classList.add("shake");
        incorrectCards[1].classList.add("shake");

        setTimeout(() => {
          incorrectCards[0].classList.remove("shake");
          incorrectCards[0].classList.remove("clicked");
          incorrectCards[1].classList.remove("shake");
          incorrectCards[1].classList.remove("clicked");
        }, 800);
      }
    }
  });
});

/*var el = document.querySelectorAll(".case");

function flipCard(){
  this.classList.toggle('flip');
}

el.forEach(card => card.addEventListener('click', flipCard));*/